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
       Schema::create('factures', function (Blueprint $table) {
    $table->id();
    $table->foreignId('commande_id')->unique()->constrained('commandes')->cascadeOnDelete();
    $table->string('numero_facture')->unique();
    $table->date('date_emission')->default(now());
    $table->decimal('montant_total', 10, 2);
    $table->decimal('taxe', 8, 2)->nullable();
    $table->enum('mode_paiement', ['especes', 'carte', 'autre'])->nullable();
    $table->enum('statut_paiement', ['paye', 'impaye', 'rembourse'])->default('impaye');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
