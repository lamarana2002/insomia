<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::with('produit')->orderBy('categorie', 'asc')->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categorie' => 'required',
            'image' => 'nullable|image'
        ]);

        $file = $request->file('image');
        $imgName = time().'.png';
        $image = $file->storeAs('public/images/categories', $imgName);

        $newCategorie = new Categorie();
        $newCategorie->categorie = $request->categorie;
        $newCategorie->image = $image;
        $newCategorie->save();
        return response(['success' => 'Enregistrement effectué avec succés']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categorie = Categorie::where('id', $id)->first();
        if (!$categorie) {
           return response(['error' => 'Cette categorie n\'existe pas']);
        }
        return response($categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categorie = Categorie::where('id', $id)->first();
        return response($categorie);
        $request->validate([
            'categorie' => 'required',
            'image' => 'required|image'
        ]);


        if (!$categorie) {
            return response(['error' => 'Cette categorie n\'existe pas']);
        }

        if ($categorie->image != null && Storage::exists($categorie->image)) {
            Storage::delete($categorie->image);
        }

        $file = $request->file('image');
        $imgName = time().'.png';
        $image = $file->storeAs('public/images/categories', $imgName);

        $categorie->categorie = $request->categorie;
        $categorie->image = $image;
        $categorie->update();
        return response(['success' => 'Modification effectué avec succés']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = Categorie::where('id',$id)->first();
        $categorie->delete();
        return response(['success' => 'Suppression effectué avec succés']);
    }
}
