<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lignecommandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained();
            $table->foreignId('produit_id')->constrained();
            $table->integer('quantite');
            $table->double('montant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignecommandes');
    }
};
