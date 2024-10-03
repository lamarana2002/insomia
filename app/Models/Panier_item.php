<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'panier_id',
        'produit_id',
        'quantite',
        'montant',
    ];

    public function panier(){
        return $this->belongsTo(Panier::class);
    }
}
