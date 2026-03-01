<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use App\Models\Commande;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PlatsController extends Controller
{
    public function dashboard(): View
    {
        $this->ensureAdmin();

        $plats = Plat::query()
            ->latest()
            ->paginate(8, ['*'], 'plats_page');

        $commandes = Commande::query()
            ->with(['utilisateur', 'facture'])
            ->latest()
            ->paginate(8, ['*'], 'commandes_page');

        return view('dashboard.index', compact('plats', 'commandes'));
    }

    public function index(): View
    {
        $this->ensureAdmin();

        $plats = Plat::query()->latest()->get();

        return view('plats.index', compact('plats'));
    }

    public function create(): View
    {
        $this->ensureAdmin();

        return view('dashboard.plats-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'thmbdail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'prix' => ['required', 'numeric', 'min:0'],
            'categorie' => ['nullable', 'string', 'max:255'],
            'est_disponible' => ['nullable', 'boolean'],
        ]);

        $thmbdailPath = null;

        // Traiter l'upload d'image
        if ($request->hasFile('thmbdail')) {
            $file = $request->file('thmbdail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $thmbdailPath = $file->storeAs('plats', $filename, 'public');
        }

        Plat::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'] ?? null,
            'thmbdail' => $thmbdailPath ?? null,
            'prix' => $validated['prix'],
            'categorie' => $validated['categorie'] ?? null,
            'est_disponible' => (bool) ($validated['est_disponible'] ?? true),
        ]);

        return back()->with('success', 'Plat ajoute.');
    }

    public function destroy(Plat $plat): RedirectResponse
    {
        $this->ensureAdmin();

        // Supprimer l'image si elle existe
        if ($plat->thmbdail) {
            Storage::disk('public')->delete($plat->thmbdail);
        }

        $plat->delete();

        return back()->with('success', 'Plat supprime.');
    }

    private function ensureAdmin(): void
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acces reserve a un administrateur.');
        }
    }
}
