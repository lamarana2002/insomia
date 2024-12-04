<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Trait\apiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $produits = Produit::where('');
        $produits = Produit::with('categorie','album')->orderBy('designation', 'asc')->get();
        foreach ($produits as $key => $value) {
            $produits[$key]->image = asset('storage/'. $produits[$key]->image);
        }
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
            'image' => 'required | image',
        ]);

        $file = $request->file('image');
        $fileName = time().'.png';
        $produitImage = $file->storeAs('images/produits', $fileName, 'public');

        $newProduit = new Produit();
        $newProduit->designation = $request->designation;
        $newProduit->categorie_id = $request->categorie_id;
        $newProduit->quantite_stock = $request->quantite_stock;
        $newProduit->prix = $request->prix;
        $newProduit->image = $produitImage;
        $newProduit->save();

        return $this->responseWithSuccess('Enregistrement effectue avec succes');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produit = Produit::where('id', $id)->with('categorie','album')->first();
        if (!$produit) {
            return $this->responseWithError('Ce produit n\'existe pas');
        }
        
        $produit->image = asset('storage/'. $produit->image);
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
        ]);
        
        $produit = Produit::where('id', $id)->first();

        if (!$produit) {
            return $this->responseWithError('Ce produit n\'existe pas');
        }
        $image = $request->file('image');
        
        if ($image != null) {
            if ($produit->image != null && Storage::exists('public/'.$produit->image)) {
                Storage::delete('public/'.$produit->image);
            }
            $file = $request->file('image');
            $imgName = time().'.png';
            $image = $file->storeAs('images/produits', $imgName, 'public');
            $produit->image = $image;
        }

        $produit->designation = $request->designation;
        $produit->categorie_id = $request->categorie_id;
        $produit->quantite_stock = $request->quantite_stock;
        $produit->prix = $request->prix;
        $produit->update();

        return $this->responseWithSuccess('Modification effectue avec succes');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produit = Produit::where('id', $id)->first();
        if (!$produit) {
            return $this->responseWithError('Ce produit n\'existe pas');
        }
        $produit->delete();
        return $this->responseWithSuccess('Suppression effectue avec succes');
    }
}
