<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\Facture;
use App\Models\Ligne_commande;
use App\Models\Plat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(12)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);

        $plats = Plat::factory(25)->create();

        Commande::factory(40)->create([
            'utilisateur_id' => null,
        ])->each(function (Commande $commande) use ($users, $plats) {
            if (fake()->boolean(85)) {
                $commande->update([
                    'utilisateur_id' => $users->random()->id,
                ]);
            }

            $nombreLignes = fake()->numberBetween(1, 5);
            $montantTotal = 0;

            for ($i = 0; $i < $nombreLignes; $i++) {
                $plat = $plats->random();
                $quantite = fake()->numberBetween(1, 4);
                $prixUnitaire = (float) $plat->prix;
                $sousTotal = round($quantite * $prixUnitaire, 2);

                Ligne_commande::factory()->create([
                    'commande_id' => $commande->id,
                    'plat_id' => $plat->id,
                    'quantite' => $quantite,
                    'prix_unitaire' => $prixUnitaire,
                    'sous_total' => $sousTotal,
                ]);

                $montantTotal += $sousTotal;
            }

            $montantTotal = round($montantTotal, 2);
            $taxe = round($montantTotal * 0.18, 2);
            $isPaid = fake()->boolean(70);

            $commande->update([
                'montant_total' => $montantTotal,
            ]);

            Facture::factory()->create([
                'commande_id' => $commande->id,
                'montant_total' => $montantTotal,
                'taxe' => $taxe,
                'mode_paiement' => $isPaid ? fake()->randomElement(['especes', 'carte', 'autre']) : null,
                'statut_paiement' => $isPaid ? 'paye' : 'impaye',
            ]);
        });
    }
}
