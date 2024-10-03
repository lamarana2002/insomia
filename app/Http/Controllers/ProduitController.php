<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $produits = Produit::where('');
        $produits = Produit::with('album')->with('categorie')->orderBy('designation', 'asc')->get();
        // dd($produits);
        return $produits;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'designation' => 'required',
            'categorie_id' => 'required',
            'quantite_stock' => 'required',
            'prix' => 'required',
            'image' => 'required',
        ]);

        // $file = $request->file('image');
        // $fileName = time().'.png';
        // $produitImage = $file->storeAs('public/images/produits', $fileName);

        $newProduit = new Produit();
        $newProduit->designation = $request->designation;
        $newProduit->categorie_id = $request->categorie_id;
        $newProduit->quantite_stock = $request->quantite_stock;
        $newProduit->prix = $request->prix;
        $newProduit->image = $request->image;
        $newProduit->save();

        return response(['success' => 'Enregistrement effectué avec succés']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produit = Produit::where('id', $id)->first();
        if (!$produit) {
            return response(['error' => 'Ce produit n\'existe pas']);
        }
        return $produit;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'designation' => 'required',
            'categorie_id' => 'required',
            'quantite_stock' => 'required',
            'prix' => 'required',
            'image' => 'required',
        ]);
        
        $produit = Produit::where('id', $id)->first();

        if (!$produit) {
            return response(['error' => 'Ce produit n\'existe pas']);
        }

        // if ($produit->image != null && Storage::exists($produit->image)) {
        //     Storage::delete($produit->image);
        // }


        // $file = $request->file('image');
        // $fileName = time().'.png';
        // $produitImage = $file->storeAs('public/images/produits', $fileName);

        $produit->designation = $request->designation;
        $produit->categorie_id = $request->categorie_id;
        $produit->quantite_stock = $request->quantite_stock;
        $produit->prix = $request->prix;
        $produit->image = $request->image;
        $produit->update();

        return response(['success' => 'Modification effectué avec succés']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produit = Produit::where('id', $id)->first();
        if (!$produit) {
            return response(['error' => 'Ce produit n\'existe pas']);
        }
        $produit->delete();
        return response(['success' => 'Suppression effectué avec succés']);
    }
}
