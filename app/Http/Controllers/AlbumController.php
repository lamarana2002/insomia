<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with('produit')->get();
        return $albums;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required',
            'image' => 'required',
        ]);

        // $file = $request->file('image');
        // $fileName = time().'.png';
        // $produitImage = $file->storeAs('public/images/produits', $fileName);

        $newAlbum = new Album();
        $newAlbum->produit_id = $request->produit_id;
        $newAlbum->image = $request->image;

        $newAlbum->save();

        return response(['success' => 'Enregistrement effectué avec succés']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::where('id', $id)->first();
        if (!$album) {
            return response(['error' => 'Cet album n\'existe pas']);
        }
        return $album;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'produit_id' => 'required',
            'image' => 'required',
        ]);
        
        $album = Album::where('id', $id)->first();

        if (!$album) {
            return response(['error' => 'Cet album n\'existe pas']);
        }

        // if ($album->image != null && Storage::exists($album->image)) {
        //     Storage::delete($album->image);
        // }


        // $file = $request->file('image');
        // $fileName = time().'.png';
        // $albumImage = $file->storeAs('public/images/produits', $fileName);

        $album->produit_id = $request->produit_id;
        $album->image = $request->image;

        $album->update();

        return response(['success' => 'Modification effectué avec succés']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::where('id', $id)->first();
        if (!$album) {
            return response(['error' => 'Cet album n\'existe pas']);
        }
        $album->delete();
        return response(['success' => 'Suppression effectué avec succés']);
    }
}
