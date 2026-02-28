<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<x-navbar active="commandes" />
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Creer une commande</h3>
        <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('commandes.store') }}">
        @csrf

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body row g-3">
                <div class="col-md-5">
                    <label class="form-label">Nom du client</label>
                    <input type="text" name="nom_client" value="{{ old('nom_client') }}" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Numero de table</label>
                    <input type="text" name="numero_table" value="{{ old('numero_table') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mode de paiement (optionnel)</label>
                    <select class="form-select" name="mode_paiement">
                        <option value="">A definir plus tard</option>
                        <option value="especes" @selected(old('mode_paiement') === 'especes')>Especes</option>
                        <option value="carte" @selected(old('mode_paiement') === 'carte')>Carte</option>
                        <option value="autre" @selected(old('mode_paiement') === 'autre')>Autre</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Selection des plats</div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach($plats as $plat)
                        <div class="col-md-6 col-lg-4">
                            <div class="border rounded p-3 h-100">
                                <div class="fw-semibold">{{ $plat->nom }}</div>
                                <div class="small text-muted mb-2">{{ $plat->description ?: 'Aucune description' }}</div>
                                <div class="mb-2">{{ number_format((float) $plat->prix, 2, ',', ' ') }} $</div>
                                <input type="hidden" name="items[{{ $loop->index }}][plat_id]" value="{{ $plat->id }}">
                                <label class="form-label small">Quantite</label>
                                <input
                                    type="number"
                                    min="0"
                                    name="items[{{ $loop->index }}][quantite]"
                                    value="{{ old('items.' . $loop->index . '.quantite', 0) }}"
                                    class="form-control"
                                >
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Valider la commande et generer la facture</button>
    </form>
</div>
</body>
</html>
