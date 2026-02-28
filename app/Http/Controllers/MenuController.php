<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $plats = Plat::query()
            ->where('est_disponible', true)
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->string('q')->toString();
                $query->where(function ($subQuery) use ($q) {
                    $subQuery
                        ->where('nom', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhere('categorie', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('categorie'), function ($query) use ($request) {
                $query->where('categorie', $request->string('categorie')->toString());
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Plat::query()
            ->whereNotNull('categorie')
            ->distinct()
            ->orderBy('categorie')
            ->pluck('categorie');

        return view('menu', compact('plats', 'categories'));
    }
}
