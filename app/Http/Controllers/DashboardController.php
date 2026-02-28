<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Plat;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acces reserve a un administrateur.');
        }

        $plats = Plat::query()
            ->latest()
            ->paginate(8, ['*'], 'plats_page');

        $commandes = Commande::query()
            ->with(['utilisateur', 'facture'])
            ->latest()
            ->paginate(8, ['*'], 'commandes_page');

        return view('dashboard', compact('plats', 'commandes'));
    }
}
