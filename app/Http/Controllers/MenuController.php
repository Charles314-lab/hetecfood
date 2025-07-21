<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Menu::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu créé avec succès');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $menu->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu mis à jour');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu supprimé');
    }
}
