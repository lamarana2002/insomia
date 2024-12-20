<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Panier_item;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Trait\apiResponse;

class PanierController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userPanier = Panier::where('user_id', Auth::user()->id)->first();
        // $panierItems = Panier_item::with('panier')->where('user_id', Auth::user()->id)->first();
        // $panierItems = Panier_item::whereHas('panier',function ($query) use ($user){
        //     $query->where('user_id', $user);
        // })->with('panier')->get();
        $panierItems = Panier_item::where('panier_id', $userPanier->id)->get();
        return $panierItems;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        return 'panier';
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produit = Produit::where('id', $id)->first();
        if (!$produit) {
            return $this->responseWithError('Ce produit n\'existe pas');
        }
        $panierId = Panier::where('user_id', Auth::user()->id)->first();

        // $panier = Panier_item::with('panier')->where('user_id', Auth::user()->id)->first();
        $produitExistInPanier = Panier_item::where('produit_id', $produit->id)->where('panier_id', $panierId->id)->first();

        // $panier = Panier_item::updateOrCreate(
        //     ['panier_id' => $panierId->id,
        //     'produit_id' => $produit->id],
        //    [ 'quantite' => DB::raw('quantite + 1'),
        //     'montant' => DB::raw('quantite * $produit->prix')],
        // );

        // if ($panier) {
        //     return $this->responseWithSuccess('Ce produit n\'existe pas', $panier);
        //     // return response(['success' => 'Enregistrement effectué avec succés']);
        // }

        if(!$produitExistInPanier){
            // return Auth::user();
            $newPanier = new Panier_item();
            $newPanier->panier_id = $panierId->id;
            $newPanier->produit_id = $produit->id;
            $newPanier->quantite = 1;
            $newPanier->montant = $produit->prix;
            $newPanier->save();
            $produit->quantite_stock --;
            $produit->update();
            return $this->responseWithSuccess('Enregistrement effectue avec succes');
        }
        // return response(['existe']);

        if ($produit->quantite_stock < 1 ) {

            return $this->availableStock();
        }

        $produitExistInPanier->quantite ++;
        $produitExistInPanier->montant =$produitExistInPanier->quantite * $produit->prix;
        $produitExistInPanier->update();

        $produit->quantite_stock --;
        $produit->update();
        return $this->responseWithSuccess('Modification effectue avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $panier_item = Panier_item::where('id', $id)->first();
        $produit = Produit::where('id', $panier_item->produit_id)->first();
        if (!$panier_item) {
            return $this->responseWithError('Ce panier item n\'existe pas ');
        }
        $produit->quantite_stock = $produit->quantite_stock + $panier_item->quantite;
        $produit->update();
        $panier_item->delete();
        return $this->responseWithSuccess('Suppression effectue avec succes');
    }
    public function incrementation($id)
    {

        $userId = Auth::user()->id;
        $userPanier = Panier::where('user_id', $userId)->first();
        $panierItem = Panier_item::where('panier_id', $userPanier->id)->where('produit_id', $id)->first();

        $produit = Produit::where('id', $id)->first();
        if ($produit->quantite_stock < 1) {
            return $this->availableStock();
        }

        $panierItem->quantite++;
        $panierItem->montant =$panierItem->quantite * $produit->prix;
        $panierItem->update();

        $produit->quantite_stock --;
        $produit->update();
    }
    public function decrementation($id)
    {
        $userId = Auth::user()->id;
        $userPanier = Panier::where('user_id', $userId)->first();
        $panierItem = Panier_item::where('panier_id', $userPanier->id)->where('produit_id', $id)->first();

        $produit = Produit::where('id', $id)->first();
        if ($panierItem->quantite > 1) {
            $panierItem->quantite--;
            $panierItem->montant =$panierItem->quantite * $produit->prix;
            $panierItem->update();

            $produit->quantite_stock ++;
            $produit->update();
        }
        if ($panierItem->quantite == 1) {
            $panierItem->delete();

            $produit->quantite_stock += 1;
            $produit->update();
        }
        
    }
}
