<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $plats = Plat::query()
            ->where('est_disponible', true)
            ->latest()
            ->paginate(8);

        return view('home', compact('plats'));
    }
}
