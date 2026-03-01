<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --success-color: #48bb78;
            --danger-color: #f56565;
            --warning-color: #ed8936;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 0;
        }

        /* Custom Navbar */
        .dashboard-navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand-custom {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand-custom:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-middle {
            display: flex;
            gap: 30px;
            align-items: center;
            flex: 1;
            justify-content: center;
        }

        .navbar-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .navbar-link.active {
            background: rgba(255, 255, 255, 0.3);
        }

        .navbar-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .user-menu {
            position: relative;
        }

        .user-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .user-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .dropdown-menu-custom {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
            min-width: 200px;
            z-index: 1001;
        }

        .dropdown-menu-custom.active {
            display: block;
        }

        .dropdown-item-custom {
            padding: 12px 20px;
            color: #2d3748;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .dropdown-item-custom:hover {
            background: #f7fafc;
        }

        .dropdown-item-custom.danger {
            color: var(--danger-color);
        }

        .dropdown-item-custom.danger:hover {
            background: #fed7d7;
        }

        .dropdown-item-custom:first-child {
            border-radius: 8px 8px 0 0;
        }

        .dropdown-item-custom:last-child {
            border-radius: 0 0 8px 8px;
        }

        .container-fluid {
            padding: 40px 20px;
        }

        .dashboard-header {
            margin-bottom: 40px;
        }

        .dashboard-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .dashboard-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #718096;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title-custom {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0;
        }

        .btn-header {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-header:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .table-responsive {
            border: none;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            color: #4a5568;
            padding: 15px;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 15px;
            border-color: #e2e8f0;
        }

        .table tbody tr:hover {
            background-color: #f7fafc;
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge-available {
            background-color: #c6f6d5;
            color: #22543d;
        }

        .badge-unavailable {
            background-color: #fed7d7;
            color: #742a2a;
        }

        .badge-pending {
            background-color: #feebc8;
            color: #7c2d12;
        }

        .badge-completed {
            background-color: #bee3f8;
            color: #2c5282;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 0.85rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-delete {
            background-color: #fed7d7;
            color: #742a2a;
            border: none;
        }

        .btn-delete:hover {
            background-color: #fc8181;
            color: white;
        }

        .btn-view {
            background-color: #bee3f8;
            color: #2c5282;
            border: none;
        }

        .btn-view:hover {
            background-color: #90cdf4;
            color: white;
        }

        .pagination {
            margin: 20px 0;
            justify-content: center;
        }

        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
        }

        .alert-success-custom {
            background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
            color: #22543d;
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, #fed7d7 0%, #fc8181 100%);
            color: #742a2a;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #718096;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .navbar-middle {
                gap: 10px;
            }

            .navbar-link {
                padding: 6px 10px;
                font-size: 0.9rem;
            }

            .navbar-content {
                flex-direction: column;
                gap: 15px;
            }

            .navbar-middle {
                width: 100%;
                justify-content: flex-start;
            }

            .navbar-right {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
<!-- Custom Dashboard Navbar -->
<nav class="dashboard-navbar">
    <div class="container-fluid">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand-custom">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>

            <div class="navbar-middle">
                <a href="{{ route('commandes.index') }}" class="navbar-link">
                    <i class="fas fa-receipt"></i> Commandes
                </a>
            </div>

            <div class="navbar-right">
                <div class="user-menu">
                    <button class="user-btn" onclick="toggleUserMenu()">
                        <i class="fas fa-user-circle"></i>
                        {{ auth()->user()->name }}
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu-custom" id="userDropdown">
                        <a href="{{ route('home') }}" class="dropdown-item-custom">
                            <i class="fas fa-home"></i> Retour à l'accueil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                            @csrf
                            <button type="submit" class="dropdown-item-custom danger" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid py-5">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="fas fa-chart-line"></i> Dashboard Admin
        </h1>
        <p class="dashboard-subtitle">Gérez votre restaurant en un coup d'œil</p>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Row -->
    <div class="row mb-5">
        <div class="col-md-3 mb-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="stat-value">{{ $plats->total() ?? 0 }}</div>
                <div class="stat-label">Plats</div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-value">{{ $commandes->total() ?? 0 }}</div>
                <div class="stat-label">Commandes</div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="stat-value">{{ count($commandes->items() ?? []) }}</div>
                <div class="stat-label">Dernières commandes</div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white;">
                    <i class="fas fa-plus"></i>
                </div>
                <a href="{{ route('plats.create') }}" style="text-decoration: none; color: inherit;">
                    <div class="stat-value" style="font-size: 1.5rem; cursor: pointer; transition: all 0.3s;">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="stat-label">Ajouter un plat</div>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Plats Section -->
            <div class="content-card mb-5">
                <div class="card-header-custom">
                    <h2 class="card-title-custom">
                        <i class="fas fa-list"></i> Gestion des plats
                    </h2>
                    <div>
                        <a href="{{ route('menu') }}" class="btn-header me-2">
                            <i class="fas fa-eye"></i> Voir le menu
                        </a>
                        <a href="{{ route('plats.create') }}" class="btn-header">
                            <i class="fas fa-plus"></i> Ajouter
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-image"></i> Image</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Statut</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plats as $plat)
                                <tr>
                                    <td>
                                        @if($plat->image_url)
                                            <img src="{{ $plat->image_url }}" alt="{{ $plat->nom }}" style="width: 40px; height: 40px; border-radius: 6px; object-fit: cover;">
                                        @else
                                            <div style="width: 40px; height: 40px; background: #e2e8f0; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #a0aec0;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $plat->nom }}</strong>
                                        @if($plat->description)
                                            <br><small class="text-muted">{{ Str::limit($plat->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $plat->categorie ?: '-' }}</td>
                                    <td class="fw-bold">{{ number_format((float) $plat->prix, 2, ',', ' ') }} $</td>
                                    <td>
                                        @if($plat->est_disponible)
                                            <span class="badge badge-custom badge-available">Disponible</span>
                                        @else
                                            <span class="badge badge-custom badge-unavailable">Indisponible</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <form method="POST" action="{{ route('plats.destroy', $plat) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce plat?');">
                                            @csrf
                                            <button class="btn btn-sm btn-action btn-delete" type="submit">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                                            <p>Aucun plat pour le moment</p>
                                            <a href="{{ route('plats.create') }}" class="btn btn-sm btn-primary mt-3">
                                                <i class="fas fa-plus"></i> Créer un plat
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $plats->links() }}
                </div>
            </div>

            <!-- Commandes Section -->
            <div class="content-card">
                <div class="card-header-custom">
                    <h2 class="card-title-custom">
                        <i class="fas fa-receipt"></i> Dernières commandes
                    </h2>
                    <a href="{{ route('commandes.index') }}" class="btn-header">
                        <i class="fas fa-cog"></i> Gérer
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commandes as $commande)
                                <tr>
                                    <td><strong>#{{ $commande->id }}</strong></td>
                                    <td>{{ $commande->nom_client }}</td>
                                    <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="fw-bold">{{ number_format((float) $commande->montant_total, 2, ',', ' ') }} $</td>
                                    <td>
                                        @if($commande->facture)
                                            <span class="badge badge-custom badge-completed">Facturée</span>
                                        @else
                                            <span class="badge badge-custom badge-pending">{{ ucfirst($commande->statut) }}</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-sm btn-action btn-view" href="{{ route('commandes.show', $commande) }}">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <div class="empty-icon"><i class="fas fa-shopping-bag"></i></div>
                                            <p>Aucune commande pour le moment</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $commandes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('active');
    }

    // Fermer le menu en cliquant ailleurs
    document.addEventListener('click', function(event) {
        const userMenu = document.querySelector('.user-menu');
        if (!userMenu.contains(event.target)) {
            document.getElementById('userDropdown').classList.remove('active');
        }
    });
</script>
</body>
</html>
