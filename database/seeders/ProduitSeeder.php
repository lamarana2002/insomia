<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produit::create([
            'designation' => 'Rolex R1',
            'categorie_id' => '1',
            'quantite_stock' => '100',
            'prix' => '400',
            'image' => 'rolex.png',
        ]);
        Produit::create([
            'designation' => 'Rolex R2',
            'categorie_id' => '1',
            'quantite_stock' => '300',
            'prix' => '450',
            'image' => 'rolex.png',
        ]);
        Produit::create([
            'designation' => 'Richard Mille RM1',
            'categorie_id' => '3',
            'quantite_stock' => '150',
            'prix' => '500',
            'image' => 'rmille.png',
        ]);
        Produit::create([
            'designation' => 'Richard Mille RM2',
            'categorie_id' => '3',
            'quantite_stock' => '100',
            'prix' => '400',
            'image' => 'rmille.png',
        ]);
        Produit::create([
            'designation' => 'Cartier C1',
            'categorie_id' => '2',
            'quantite_stock' => '500',
            'prix' => '200',
            'image' => 'cartier.png',
        ]);
        Produit::create([
            'designation' => 'Cartier C1',
            'categorie_id' => '2',
            'quantite_stock' => '500',
            'prix' => '200',
            'image' => 'cartier.png',
        ]);
        Produit::create([
            'designation' => 'Tag Heuer TH1',
            'categorie_id' => '4',
            'quantite_stock' => '100',
            'prix' => '100',
            'image' => 'theuer.png',
        ]);
        Produit::create([
            'designation' => 'Tag Heuer TH2',
            'categorie_id' => '4',
            'quantite_stock' => '100',
            'prix' => '100',
            'image' => 'theuer.png',
        ]);
    }
}
