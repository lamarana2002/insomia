<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Album::create([
            'produit_id' => '1',
            'image' => 'rolex.png',
        ]);
        Album::create([
            'produit_id' => '1',
            'image' => 'rolex.png',
        ]);
        Album::create([
            'produit_id' => '2',
            'image' => 'rolex.png',
        ]);
        Album::create([
            'produit_id' => '2',
            'image' => 'rolex.png',
        ]);
        Album::create([
            'produit_id' => '3',
            'image' => 'rmille.png',
        ]);
        Album::create([
            'produit_id' => '3',
            'image' => 'rmille.png',
        ]);
        Album::create([
            'produit_id' => '4',
            'image' => 'rmille.png',
        ]);
        Album::create([
            'produit_id' => '4',
            'image' => 'rmille.png',
        ]);
        Album::create([
            'produit_id' => '5',
            'image' => 'cartier.png',
        ]);
        Album::create([
            'produit_id' => '5',
            'image' => 'cartier.png',
        ]);
        Album::create([
            'produit_id' => '6',
            'image' => 'cartier.png',
        ]);
        Album::create([
            'produit_id' => '6',
            'image' => 'cartier.png',
        ]);
        Album::create([
            'produit_id' => '7',
            'image' => 'theuer.png',
        ]);
        Album::create([
            'produit_id' => '7',
            'image' => 'theuer.png',
        ]);
        Album::create([
            'produit_id' => '8',
            'image' => 'theuer.png',
        ]);
        Album::create([
            'produit_id' => '8',
            'image' => 'theuer.png',
        ]);
    }
}
