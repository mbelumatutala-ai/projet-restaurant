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

    public function create(Request $request): View|RedirectResponse
    {
        $platId = $request->integer('plat');
        $plat = Plat::query()
            ->where('est_disponible', true)
            ->whereKey($platId)
            ->first();

        if (! $plat) {
            return redirect()
                ->route('menu')
                ->with('error', 'Selectionnez un plat avant de commander.');
        }

        return view('Commande', compact('plat'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_client' => ['required', 'string', 'max:255'],
            'numero_table' => ['nullable', 'string', 'max:50'],
            'mode_paiement' => ['nullable', 'in:especes,carte,autre'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.plat_id' => ['required', 'integer', 'exists:plats,id'],
            'items.*.quantite' => ['required', 'integer', 'min:0'],
        ]);

        $selectedItems = collect($validated['items'])
            ->filter(fn (array $item) => (int) $item['quantite'] > 0)
            ->values();

        if ($selectedItems->isEmpty()) {
            return back()
                ->withErrors(['items' => 'Selectionnez au moins un plat avec une quantite superieure a 0.'])
                ->withInput();
        }

        $commande = DB::transaction(function () use ($validated, $selectedItems) {
            $commande = Commande::create([
                'utilisateur_id' => auth()->id(),
                'nom_client' => $validated['nom_client'],
                'numero_table' => $validated['numero_table'] ?? null,
                'statut' => 'en_attente',
                'montant_total' => 0,
            ]);

            $platIds = $selectedItems->pluck('plat_id')->unique()->values();
            $plats = Plat::query()->whereIn('id', $platIds)->get()->keyBy('id');

            $montantTotal = 0;
            foreach ($selectedItems as $item) {
                $plat = $plats->get($item['plat_id']);
                if (! $plat) {
                    continue;
                }

                $prixUnitaire = (float) $plat->prix;
                $quantite = (int) $item['quantite'];
                $sousTotal = round($prixUnitaire * $quantite, 2);

                Ligne_commande::create([
                    'commande_id' => $commande->id,
                    'plat_id' => $plat->id,
                    'quantite' => $quantite,
                    'prix_unitaire' => $prixUnitaire,
                    'sous_total' => $sousTotal,
                ]);

                $montantTotal += $sousTotal;
            }

            $montantTotal = round($montantTotal, 2);
            $taxe = round($montantTotal * 0.18, 2);

            $commande->update([
                'montant_total' => $montantTotal,
            ]);

            Facture::create([
                'commande_id' => $commande->id,
                'numero_facture' => 'FAC-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
                'date_emission' => now()->toDateString(),
                'montant_total' => $montantTotal,
                'taxe' => $taxe,
                'mode_paiement' => $validated['mode_paiement'] ?? null,
                'statut_paiement' => ! empty($validated['mode_paiement']) ? 'paye' : 'impaye',
            ]);

            return $commande;
        });

        $commande->load('facture');

        return redirect()
            ->route('factures.show', $commande->facture)
            ->with('success', 'Commande validee et facture generee.');
    }

    public function show(Commande $commande): View
    {
        $commande->load(['utilisateur', 'lignesCommandes.plat', 'facture']);

        return view('commandes.show', compact('commande'));
    }
}
