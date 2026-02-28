<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Facture;
use App\Models\Ligne_commande;
use App\Models\Plat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CommandeController extends Controller
{
    public function index(): View
    {
        $commandes = Commande::query()
            ->with(['utilisateur', 'facture'])
            ->latest()
            ->paginate(10);

        return view('commandes.index', compact('commandes'));
    }

    public function create(): View
    {
        $cart = $this->getCart();
        $plats = empty($cart)
            ? collect()
            : Plat::query()->whereIn('id', array_keys($cart))->get()->keyBy('id');

        $items = collect($cart)
            ->map(function (int $quantite, int $platId) use ($plats) {
                $plat = $plats->get($platId);
                if (! $plat) {
                    return null;
                }

                $prixUnitaire = (float) $plat->prix;
                $sousTotal = round($prixUnitaire * $quantite, 2);

                return [
                    'plat' => $plat,
                    'quantite' => $quantite,
                    'prix_unitaire' => $prixUnitaire,
                    'sous_total' => $sousTotal,
                ];
            })
            ->filter()
            ->values();

        $montantTotal = round((float) $items->sum('sous_total'), 2);
        $taxe = round($montantTotal * 0.18, 2);
        $totalTtc = round($montantTotal + $taxe, 2);

        return view('Commande', compact('items', 'montantTotal', 'taxe', 'totalTtc'));
    }

    public function addToCart(Plat $plat): RedirectResponse
    {
        if (! $plat->est_disponible) {
            return back()->with('error', 'Ce plat est indisponible.');
        }

        $cart = $this->getCart();
        $cart[$plat->id] = ($cart[$plat->id] ?? 0) + 1;
        session(['cart' => $cart]);

        return back()->with('success', 'Plat ajoute au panier.');
    }

    public function updateCart(Request $request, Plat $plat): RedirectResponse
    {
        $validated = $request->validate([
            'quantite' => ['required', 'integer', 'min:0'],
        ]);

        $cart = $this->getCart();
        $quantite = (int) $validated['quantite'];

        if ($quantite === 0) {
            unset($cart[$plat->id]);
        } else {
            $cart[$plat->id] = $quantite;
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Panier mis a jour.');
    }

    public function removeFromCart(Plat $plat): RedirectResponse
    {
        $cart = $this->getCart();
        unset($cart[$plat->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Plat retire du panier.');
    }

    public function clearCart(): RedirectResponse
    {
        session()->forget('cart');

        return back()->with('success', 'Panier vide.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_client' => ['required', 'string', 'max:255'],
            'numero_table' => ['nullable', 'string', 'max:50'],
        ]);

        $cart = $this->getCart();
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Votre panier est vide.']);
        }

        $commande = DB::transaction(function () use ($validated, $cart) {
            $commande = Commande::create([
                'utilisateur_id' => auth()->id(),
                'nom_client' => $validated['nom_client'],
                'numero_table' => $validated['numero_table'] ?? null,
                'statut' => 'en_attente',
                'montant_total' => 0,
            ]);

            $plats = Plat::query()->whereIn('id', array_keys($cart))->get()->keyBy('id');

            $montantTotal = 0;
            foreach ($cart as $platId => $quantite) {
                $plat = $plats->get((int) $platId);
                if (! $plat || (int) $quantite <= 0) {
                    continue;
                }

                $prixUnitaire = (float) $plat->prix;
                $sousTotal = round($prixUnitaire * (int) $quantite, 2);

                Ligne_commande::create([
                    'commande_id' => $commande->id,
                    'plat_id' => $plat->id,
                    'quantite' => (int) $quantite,
                    'prix_unitaire' => $prixUnitaire,
                    'sous_total' => $sousTotal,
                ]);

                $montantTotal += $sousTotal;
            }

            $commande->update([
                'montant_total' => round($montantTotal, 2),
            ]);

            return $commande;
        });

        session()->forget('cart');

        return redirect()
            ->route('commandes.show', $commande)
            ->with('success', 'Commande envoyee. En attente de validation admin pour facturation.');
    }

    public function validateCommande(Request $request, Commande $commande): RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acces reserve a un administrateur.');
        }

        if ($commande->facture) {
            return redirect()
                ->route('factures.show', $commande->facture)
                ->with('success', 'Cette commande est deja facturee.');
        }

        $validated = $request->validate([
            'mode_paiement' => ['required', 'in:especes,carte,autre'],
        ]);

        $facture = DB::transaction(function () use ($commande, $validated) {
            $commande->refresh();

            $taxe = round((float) $commande->montant_total * 0.18, 2);

            $facture = Facture::create([
                'commande_id' => $commande->id,
                'numero_facture' => 'FAC-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
                'date_emission' => now()->toDateString(),
                'montant_total' => (float) $commande->montant_total,
                'taxe' => $taxe,
                'mode_paiement' => $validated['mode_paiement'],
                'statut_paiement' => 'paye',
            ]);

            $commande->update([
                'statut' => 'terminee',
            ]);

            return $facture;
        });

        return redirect()
            ->route('factures.show', $facture)
            ->with('success', 'Commande validee et facture generee par admin.');
    }

    public function show(Commande $commande): View
    {
        $commande->load(['utilisateur', 'lignesCommandes.plat', 'facture']);

        return view('commandes.show', compact('commande'));
    }

    /**
     * @return array<int, int>
     */
    private function getCart(): array
    {
        /** @var array<int, int> $cart */
        $cart = session('cart', []);

        return $cart;
    }
}
