<?php

namespace Database\Factories;

use App\Models\Plat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plat>
 */
class PlatFactory extends Factory
{
    protected $model = Plat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => ucfirst(fake()->words(2, true)),
            'description' => fake()->sentence(),
            'thmbdail' => fake()->imageUrl(640, 480, 'food', true, 'plat'),
            'prix' => fake()->randomFloat(2, 5, 80),
            'categorie' => fake()->randomElement(['entree', 'plat_principal', 'dessert', 'boisson']),
            'est_disponible' => fake()->boolean(90),
        ];
    }
}
