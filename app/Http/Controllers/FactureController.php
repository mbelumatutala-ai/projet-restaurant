<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Facture;

class FactureController extends Controller
{
    public function store($commande_id){
        $commande = Commande::with('ligneCommandes.menu')->find($commande_id);

        $total = 0;
        foreach($commande->ligneCommandes as $l){
            $total += $l->quantite * $l->menu->prix;
        }

        Facture::create([
            'commande_id'=>$commande->id,
            'montant_total'=>$total
        ]);

        $commande->update(['statut'=>'payée']);

        return redirect()->back();
    }
}