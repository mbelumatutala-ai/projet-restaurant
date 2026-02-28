<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande #{{ $commande->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<x-navbar active="commandes" />
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Commande #{{ $commande->id }}</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary">Retour</a>
            @if($commande->facture)
                <a href="{{ route('factures.show', $commande->facture) }}" class="btn btn-primary">Voir facture</a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold">Lignes de commande</div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Plat</th>
                                <th>Prix unitaire</th>
                                <th>Quantite</th>
                                <th>Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commande->lignesCommandes as $ligne)
                                <tr>
                                    <td>{{ $ligne->plat->nom ?? 'Plat supprime' }}</td>
                                    <td>{{ number_format((float) $ligne->prix_unitaire, 2, ',', ' ') }} $</td>
                                    <td>{{ $ligne->quantite }}</td>
                                    <td>{{ number_format((float) $ligne->sous_total, 2, ',', ' ') }} $</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold">Resume</div>
                <div class="card-body">
                    <div class="mb-2"><strong>Client:</strong> {{ $commande->nom_client }}</div>
                    <div class="mb-2"><strong>Table:</strong> {{ $commande->numero_table ?: '-' }}</div>
                    <div class="mb-2"><strong>Statut:</strong> {{ $commande->statut }}</div>
                    <div class="mb-2"><strong>Total:</strong> {{ number_format((float) $commande->montant_total, 2, ',', ' ') }} $</div>
                    <div class="mb-0"><strong>Date:</strong> {{ $commande->created_at?->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            @if(!$commande->facture && auth()->user()->role === 'admin')
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-header bg-white fw-semibold">Validation admin</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('commandes.valider', $commande) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Mode de paiement</label>
                                <select name="mode_paiement" class="form-select" required>
                                    <option value="">Choisir</option>
                                    <option value="especes">Especes</option>
                                    <option value="carte">Carte</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Valider la commande et generer la facture</button>
                        </form>
                    </div>
                </div>
            @elseif(!$commande->facture)
                <div class="alert alert-warning mt-3 mb-0">En attente de validation par un administrateur.</div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
