<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produit extends Model
{
    use HasFactory;
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function album(){
        return $this->hasMany(Album::class);
    }
}
