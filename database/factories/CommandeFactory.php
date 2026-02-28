<?php

namespace Database\Factories;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    protected $model = Commande::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'utilisateur_id' => fake()->boolean(85) ? User::factory() : null,
            'nom_client' => fake()->name(),
            'numero_table' => fake()->optional(0.8)->numberBetween(1, 30),
            'statut' => fake()->randomElement(['en_attente', 'en_preparation', 'terminee', 'annulee']),
            'montant_total' => 0,
        ];
    }
}
