<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'prenom' => 'Mamadou Lamarana',
            'nom' => 'Diallo',
            'telephone' => '624201651',
            'adresse' => 'Lamabanyi',
        ]);
    }
}
