<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function create() {
        return view('menus.create');
    }

    public function store(Request $request) {
        Menu::create($request->all());
        return redirect()->route('menus.index');
    }

    public function edit(Menu $menu) {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu) {
        $menu->update($request->all());
        return redirect()->route('menus.index');
    }

    public function destroy(Menu $menu) {
        $menu->delete();
        return redirect()->route('menus.index');
    }
}