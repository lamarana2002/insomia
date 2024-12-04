<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Lignecommande;
use App\Models\Panier;
use App\Models\Panier_item;
use App\Trait\apiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Meilleure vente de la semaine
        // $debutSemaine = Carbon::now()->startOfWeek();
        // $finSemaine = Carbon::now()->endOfWeek();
        // $meilleurVente = Lignecommande::select('produit_id',DB::raw('SUM(quantite) as total_quantite'))->whereBetween('created_at',[$debutSemaine,$finSemaine])->groupBy('produit_id')->orderBy('total_quantite', 'desc')->with('produit')->take(5)->get();
        // return response(['meilleur vente', $meilleurVente]);

        // Permettre au super admin de retracer l'historique de son admin

        $commandes = Commande::where('user_id', Auth::user()->id)->with('user')->get();
        return $commandes;
    }

    public function ligneCommandes()
    {
        $userCommande = Commande::where('user_id', Auth::user()->id)->first();
        $ligne = Lignecommande::where('commande_id', $userCommande->id)->with('produit','commande.user')->get();
        return $ligne;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userPanier = Panier::where('user_id', Auth::user()->id)->first();
        
        $panierItems = Panier_item::where('panier_id', $userPanier->id)->get();
        
        $commande = new Commande();
        $commande->user_id = Auth::user()->id;
        $commande->save();
        
        $montant_total = 0;
        
        foreach ($panierItems as $item) {
            $montant_total+=$item->montant;
            $ligneCommande = new Lignecommande();
            $ligneCommande->commande_id = $commande->id;
            $ligneCommande->produit_id = $item->produit_id;
            $ligneCommande->quantite = $item->quantite;
            $ligneCommande->montant = $item->montant;
            $ligneCommande->save();
            $item->delete();
        }
        
        $commande->montant_total = $montant_total;
        $commande->update();
        return $this->responseWithSuccess('Commande valide avec succes');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
