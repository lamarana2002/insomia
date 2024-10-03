<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::create([
            'categorie' => 'Rolex',
            'image' => 'categorie.png',
        ]);
        Categorie::create([
            'categorie' => 'Cartier',
            'image' => 'categorie.png',
        ]);
        Categorie::create([
            'categorie' => 'Richard Mille',
            'image' => 'categorie.png',
        ]);
        Categorie::create([
            'categorie' => 'Tag Heuer',
            'image' => 'categorie.png',
        ]);
    }
}
