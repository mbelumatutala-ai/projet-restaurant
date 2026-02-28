<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Menu;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index() {
        $commandes = Commande::with('ligneCommandes.menu')->get();
        return view('commandes.index', compact('commandes'));
    }

    public function create() {
        $menus = Menu::all();
        return view('commandes.create', compact('menus'));
    }

    public function store(Request $request) {
        $commande = Commande::create([
            'user_id'=>auth()->id(),
            'statut'=>'en cours'
        ]);

        foreach($request->menus as $i=>$menu_id){
            LigneCommande::create([
                'commande_id'=>$commande->id,
                'menu_id'=>$menu_id,
                'quantite'=>$request->quantites[$i]
            ]);
        }

        return redirect()->route('commandes.index');
    }

    public function destroy(Commande $commande) {
        $commande->delete();
        return redirect()->route('commandes.index');
    }
}