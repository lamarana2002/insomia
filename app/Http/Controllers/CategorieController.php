<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Trait\apiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategorieController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::orderBy('categorie', 'asc')->get();
        // return $categories->asset('storage/')
        foreach ($categories as $key=>$value) {
            $categories[$key]->image = asset('storage/' . $categories[$key]->image);
        }
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
        $image = $file->storeAs('images/categories', $imgName, 'public');

        $newCategorie = new Categorie();
        $newCategorie->categorie = $request->categorie;
        $newCategorie->image = $image;
        $newCategorie->save();
        return $this->responseWithSuccess('Enregistrement effectue avec succes');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categorie = Categorie::where('id', $id)->first();
        if (!$categorie) {
            return $this->responseWithError('Cette categorie n\'existe pas');
        }
        return response($categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'categorie' => 'required',
        ]);
        $cat = Categorie::where('id', $id)->first();
        
        if (!$cat) {
            return $this->responseWithError('Cette categorie n\'existe pas');
        }
        $image = $request->file('image');
        
        if ($image != null) {
            if ($cat->image != null && Storage::exists('public/'.$cat->image)) {
                Storage::delete('public/'.$cat->image);
            }
            $file = $request->file('image');
            $imgName = time().'.png';
            $image = $file->storeAs('images/categories', $imgName, 'public');
            $cat->image = $image;
        }


        $cat->categorie = $request->categorie;
        $cat->save();
        return $this->responseWithSuccess('Modification effectue avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = Categorie::where('id',$id)->first();
        if (!$categorie) {
            return $this->responseWithError('Cette categorie n\'existe pas');
        }
        $categorie->delete();
        return $this->responseWithSuccess('Suppression effectue avec succes');
    }
}
