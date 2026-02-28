<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'nom_client',
        'numero_table',
        'statut',
        'montant_total',
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function lignesCommandes(): HasMany
    {
        return $this->hasMany(Ligne_commande::class, 'commande_id');
    }

    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class, 'commande_id');
    }
}
