<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use Illuminate\Http\Request;

class PlatsController extends Controller
{
    // Affiche tous les plats
    public function index()
    {
        $plats = Plat::all();
        return view('plats.index', compact('plats'));
    }

    // Ajoute un plat
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prix' => 'required|numeric|min:0',
        ]);

        Plat::create($request->all());
        return redirect()->back()->with('success', 'Plat ajouté !');
    }

    // Supprime un plat
    public function destroy($id)
    {
        $plat = Plat::findOrFail($id);
        $plat->delete();
        return redirect()->back()->with('success', 'Plat supprimé !');
    }
}