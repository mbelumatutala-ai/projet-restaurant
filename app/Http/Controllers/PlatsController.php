<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlatsController extends Controller
{
    public function index(): View
    {
        $this->ensureAdmin();

        $plats = Plat::query()->latest()->get();

        return view('plats.index', compact('plats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'thmbdail' => ['nullable', 'url'],
            'prix' => ['required', 'numeric', 'min:0'],
            'categorie' => ['nullable', 'string', 'max:255'],
            'est_disponible' => ['nullable', 'boolean'],
        ]);

        Plat::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'] ?? null,
            'thmbdail' => $validated['thmbdail'] ?? null,
            'prix' => $validated['prix'],
            'categorie' => $validated['categorie'] ?? null,
            'est_disponible' => (bool) ($validated['est_disponible'] ?? true),
        ]);

        return back()->with('success', 'Plat ajoute.');
    }

    public function destroy(Plat $plat): RedirectResponse
    {
        $this->ensureAdmin();

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
