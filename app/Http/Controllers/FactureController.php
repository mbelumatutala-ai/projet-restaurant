<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\View\View;

class FactureController extends Controller
{
    public function show(Facture $facture): View
    {
        $facture->load(['commande.utilisateur', 'commande.lignesCommandes.plat']);

        return view('factures.show', compact('facture'));
    }
}
