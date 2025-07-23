<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use App\Models\Menu;
use App\Models\Categorie;
use Illuminate\Http\Request;

class PlatController extends Controller
{
    public function index()
    {
         $plats = Plat::with(['menu', 'categorie'])->withTrashed()->get();
        return view('admin.plats.index', compact('plats'));
    }

    public function create()
    {
        $menus = Menu::all();
        $categories = Categorie::all();
        return view('admin.plats.create', compact('menus', 'categories'));
    }

   // Dans PlatController.php, modifiez la méthode store:

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:50',
        'origine' => 'nullable|string|max:50',
        'tps_cuisson' => 'nullable|string|max:10',
        'prix' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'menu_id' => 'nullable|integer|exists:menus,id',
        'categorie_id' => 'required|integer|exists:categories,id', // Changé en required
    ]);

    $plat = new Plat($request->except('image'));

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('assets/img/plats'), $imageName);
        $plat->image = $imageName;
    }

    $plat->save();

    return redirect()->route('plats.index')->with('success', 'Plat ajouté avec succès');
}
    public function edit(Plat $plat)
    {
        $menus = Menu::all();
        $categories = Categorie::all();
        return view('admin.plats.edit', compact('plat', 'menus', 'categories'));
    }

    public function update(Request $request, Plat $plat)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'origine' => 'nullable|string|max:50',
            'tps_cuisson' => 'nullable|string|max:10',
            'prix' => 'required|numeric',
            'image' => 'nullable|string',
            'menu_id' => 'nullable|integer|exists:menus,id',
            'categorie_id' => 'nullable|integer|exists:categories,id',
        ]);

        $plat->update($request->all());

        return redirect()->route('plats.index')->with('success', 'Plat mis à jour');
    }

    public function destroy(Plat $plat)
    {
        $plat->delete();
        return redirect()->route('plats.index')->with('success', 'Plat supprimé');
    }
}
