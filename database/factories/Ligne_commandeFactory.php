<?php

namespace Database\Factories;

use App\Models\Commande;
use App\Models\Ligne_commande;
use App\Models\Plat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ligne_commande>
 */
class Ligne_commandeFactory extends Factory
{
    protected $model = Ligne_commande::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prixUnitaire = fake()->randomFloat(2, 5, 80);
        $quantite = fake()->numberBetween(1, 4);

        return [
            'commande_id' => Commande::factory(),
            'plat_id' => Plat::factory(),
            'quantite' => $quantite,
            'prix_unitaire' => $prixUnitaire,
            'sous_total' => round($prixUnitaire * $quantite, 2),
        ];
    }
}
