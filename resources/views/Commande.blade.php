<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card-img { width: 100px; height: 100px; object-fit: cover; border-radius: 10px; }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Panier</h3>
        <a href="{{ route('menu') }}" class="btn btn-outline-secondary">Retour menu</a>
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

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-semibold">Votre commande</div>
                    <div class="card-body">
                        <div class="d-flex gap-3 align-items-start">
                            <img class="card-img" src="{{ $plat->thmbdail ?: 'https://via.placeholder.com/640x480?text=Plat' }}" alt="{{ $plat->nom }}">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">{{ $plat->nom }}</h5>
                                <p class="text-muted mb-2">{{ $plat->description ?: 'Aucune description disponible.' }}</p>
                                <div class="fw-semibold">{{ number_format((float) $plat->prix, 2, ',', ' ') }} EUR</div>
                            </div>
                            <div style="width: 140px;">
                                <label class="form-label">Quantite</label>
                                <input
                                    id="quantite"
                                    type="number"
                                    min="1"
                                    name="items[0][quantite]"
                                    value="{{ old('items.0.quantite', 1) }}"
                                    class="form-control"
                                    required
                                >
                            </div>
                        </div>

                        <input type="hidden" name="items[0][plat_id]" value="{{ $plat->id }}">
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white fw-semibold">Informations client</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nom client</label>
                            <input type="text" name="nom_client" value="{{ old('nom_client', auth()->user()->name) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Numero de table</label>
                            <input type="text" name="numero_table" value="{{ old('numero_table') }}" class="form-control">
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Mode de paiement</label>
                            <select name="mode_paiement" class="form-select">
                                <option value="">A definir</option>
                                <option value="especes" @selected(old('mode_paiement') === 'especes')>Especes</option>
                                <option value="carte" @selected(old('mode_paiement') === 'carte')>Carte</option>
                                <option value="autre" @selected(old('mode_paiement') === 'autre')>Autre</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-semibold">Total</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sous-total</span>
                            <strong id="sousTotal">0,00 EUR</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Taxe (18%)</span>
                            <strong id="taxe">0,00 EUR</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total TTC</span>
                            <strong id="totalTtc">0,00 EUR</strong>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Valider et generer la facture</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    (function () {
        const prix = {{ (float) $plat->prix }};
        const quantiteInput = document.getElementById('quantite');
        const sousTotalEl = document.getElementById('sousTotal');
        const taxeEl = document.getElementById('taxe');
        const totalTtcEl = document.getElementById('totalTtc');

        function formatEuro(value) {
            return new Intl.NumberFormat('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(value) + ' EUR';
        }

        function recalc() {
            const qte = Math.max(1, parseInt(quantiteInput.value || '1', 10));
            quantiteInput.value = qte;
            const sousTotal = +(prix * qte).toFixed(2);
            const taxe = +(sousTotal * 0.18).toFixed(2);
            const total = +(sousTotal + taxe).toFixed(2);
            sousTotalEl.textContent = formatEuro(sousTotal);
            taxeEl.textContent = formatEuro(taxe);
            totalTtcEl.textContent = formatEuro(total);
        }

        quantiteInput.addEventListener('input', recalc);
        recalc();
    })();
</script>
</body>
</html>
