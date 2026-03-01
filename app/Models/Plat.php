<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'thmbdail',
        'prix',
        'categorie',
        'est_disponible',
    ];

    public function lignesCommandes(): HasMany
    {
        return $this->hasMany(Ligne_commande::class, 'plat_id');
    }

    /**
     * Obtenir l'URL complète de l'image du plat
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->thmbdail) {
            return null;
        }

        return asset('storage/' . $this->thmbdail);
    }
}
