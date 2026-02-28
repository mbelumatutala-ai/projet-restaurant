<?php

namespace Database\Factories;

use App\Models\Commande;
use App\Models\Facture;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facture>
 */
class FactureFactory extends Factory
{
    protected $model = Facture::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commande_id' => Commande::factory(),
            'numero_facture' => 'FAC-' . fake()->unique()->numerify('######'),
            'date_emission' => fake()->date(),
            'montant_total' => fake()->randomFloat(2, 10, 400),
            'taxe' => fake()->optional()->randomFloat(2, 1, 50),
            'mode_paiement' => fake()->optional()->randomElement(['especes', 'carte', 'autre']),
            'statut_paiement' => fake()->randomElement(['paye', 'impaye', 'rembourse']),
        ];
    }
}
