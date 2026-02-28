<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Restaurant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #333;
        }
        .navbar-brand i {
            color: #ff6b6b;
            margin-right: 8px;
        }
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }
        .search-bar {
            max-width: 400px;
            margin: 0 auto;
        }
        .category-pills {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            margin: 30px 0;
        }
        .category-pill {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
            color: #495057;
            transition: all 0.2s;
            cursor: default;
        }
        .category-pill.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        .category-pill i {
            margin-right: 6px;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
            height: 100%;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .card-img-top {
            height: 180px;
            object-fit: cover;
            background-color: #e9ecef;
        }
        .card-body {
            padding: 1.2rem;
        }
        .card-title {
            font-weight: 600;
            margin-bottom: 8px;
        }
        .card-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .price {
            font-weight: 700;
            font-size: 1.25rem;
            color: #28a745;
        }
        .btn-order {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-order:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }
        .btn-order i {
            margin-right: 5px;
        }
        .footer {
            background: white;
            padding: 20px 0;
            margin-top: 50px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <!-- Header avec utilisateur connecté -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-shop"></i> Le Gourmet
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu')}}">Menus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="user-dropdown dropdown">
                    <div class="avatar" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Mon profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-bag me-2"></i>Mes commandes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                    <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <!-- Barre de recherche -->
        <div class="search-bar mb-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Rechercher un plat...">
            </div>
        </div>

        <!-- Filtres par catégorie (simulés) -->
        <div class="category-pills">
            <span class="category-pill active"><i class="bi bi-grid"></i> Tous</span>
            <span class="category-pill"><i class="bi bi-egg-fried"></i> Entrées</span>
            <span class="category-pill"><i class="bi bi-basket"></i> Plats</span>
            <span class="category-pill"><i class="bi bi-cup-straw"></i> Desserts</span>
            <span class="category-pill"><i class="bi bi-cup-hot"></i> Boissons</span>
        </div>

        <!-- Grille des plats -->
        <h3 class="mb-4 fw-semibold">Nos plats populaires</h3>
        <div class="row g-4">
            <!-- Carte 1 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Plat">
                    <div class="card-body">
                        <h5 class="card-title">Bowl végétarien</h5>
                        <p class="card-text">Riz complet, légumes frais, avocat, graines de sésame et sauce soja.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">12,90 $</span>
                            <button class="btn btn-order btn-sm"><i class="bi bi-plus-circle"></i> Commander</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carte 2 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Plat">
                    <div class="card-body">
                        <h5 class="card-title">Pizza Margherita</h5>
                        <p class="card-text">Sauce tomate, mozzarella, basilic frais, huile d'olive.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">10,50 $</span>
                            <button class="btn btn-order btn-sm"><i class="bi bi-plus-circle"></i> Commander</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carte 3 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1551782450-a2132b4ba21d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Plat">
                    <div class="card-body">
                        <h5 class="card-title">Burger classique</h5>
                        <p class="card-text">Steak haché, cheddar, salade, tomate, oignon, sauce maison.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">14,90 $</span>
                            <button class="btn btn-order btn-sm"><i class="bi bi-plus-circle"></i> Commander</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carte 4 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Plat">
                    <div class="card-body">
                        <h5 class="card-title">Pâtes carbonara</h5>
                        <p class="card-text">Spaghetti, crème, lardons, parmesan, jaune d'œuf.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">13,50 $</span>
                            <button class="btn btn-order btn-sm"><i class="bi bi-plus-circle"></i> Commander</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carte 5 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Plat">
                    <div class="card-body">
                        <h5 class="card-title">Salade César</h5>
                        <p class="card-text">Laitue romaine, poulet grillé, parmesan, croûtons, sauce César.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">11,90 $</span>
                            <button class="btn btn-order btn-sm"><i class="bi bi-plus-circle"></i> Commander</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carte 6 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1574484287842-0b4032ad96ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Plat">
                    <div class="card-body">
                        <h5 class="card-title">Tartare de saumon</h5>
                        <p class="card-text">Saumon frais, avocat, mangue, coriandre, sauce yuzu.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">15,90 $</span>
                            <button class="btn btn-order btn-sm"><i class="bi bi-plus-circle"></i> Commander</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer simple -->
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Le Gourmet. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
