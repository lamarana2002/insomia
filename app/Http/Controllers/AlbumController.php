<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Trait\apiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with('produit')->get();
        foreach ($albums as $key=>$value) {
            $albums[$key]->image = asset('storage/' . $albums[$key]->image);
        }
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

        $file = $request->file('image');
        $fileName = time().'.png';
        $produitImage = $file->storeAs('images/produits', $fileName, 'public');

        $newAlbum = new Album();
        $newAlbum->produit_id = $request->produit_id;
        $newAlbum->image = $produitImage;

        $newAlbum->save();

        return $this->responseWithSuccess('Enregistrement effectue avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::where('id', $id)->first();
        if (!$album) {
            return $this->responseWithError('Cet album n\'existe pas');
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
        ]);
        
        $album = Album::where('id', $id)->first();

        if (!$album) {
            return $this->responseWithError('Cet album n\'existe pas');
        }

        $image = $request->file('image');
        
        if ($image != null) {
            if ($album->image != null && Storage::exists('public/'.$album->image)) {
                Storage::delete('public/'.$album->image);
            }
            $fileName = time().'.png';
            $albumImage = $image->storeAs('images/produitsAlbum', $fileName, 'public');
            $album->image = $albumImage;
        }

        $album->produit_id = $request->produit_id;
        $album->update();

        return $this->responseWithSuccess('Modification effectue avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::where('id', $id)->first();
        if (!$album) {
            return $this->responseWithError('Cet album n\'existe pas');
        }
        $album->delete();
        return $this->responseWithSuccess('Suppression effectue avec succes');
    }
}
