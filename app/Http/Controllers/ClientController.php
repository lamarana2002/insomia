<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return $clients;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $client->prenom = $request->prenom;
        $client->nom = $request->nom;
        $client->telephone = $request->telephone;
        $client->adresse = $request->adresse;
        $client->save();

        return response(['message' => 'Enregistrement effectué avec succés']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::where('id', $id)->first();
        if ($client) {
            return $client;
        } else {
            return response(['message' => 'Ce client n\'existe pas'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::where('id', $id)->first();
        if ($client) {
            $client->prenom = $request->prenom;
            $client->nom = $request->nom;
            $client->telephone = $request->telephone;
            $client->adresse = $request->adresse;
            $client->update();

            return response(['message' => 'Modification effectué avec succés']);
        } else {
            return response(['message' => 'Ce client n\'existe pas'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::where('id', $id)->first();
        if ($client) {
            return $client->delete($id);
            return response(['message' => 'Suppression effectué avec succés']);
        } else {
            return response(['message' => 'Ce client n\'existe pas'], 404);
        }
    }
}
