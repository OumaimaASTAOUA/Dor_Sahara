<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration - Restaurants</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <style>
         body {
            background-image: url('{{ asset('images/admin-background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        .error-message.show {
            display: block;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .btn-close {
            float: right;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
        }
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        .hotel-image, .apartment-image {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
        .no-image {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .truncate {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            vertical-align: middle;
        }
        .truncate-location {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            vertical-align: middle;
        }
        .truncate-location:hover {
            overflow: visible;
            white-space: normal;
            max-width: none;
            background: #f8f9fa;
            padding: 2px 4px;
            border-radius: 4px;
        }
        .table-toggle-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .table-toggle-btn {
            padding: 8px 16px;
            border: none;
            background: #e0e0e0;
            cursor: pointer;
            border-radius: 4px;
        }
        .table-toggle-btn.active {
            background: #3498db;
            color: white;
        }
    </style>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-landscape'></i>
            <span class="text">Dor Sahara</span>
        </a>
        <ul class="side-menu top">
            <li><a href="{{ route('admin.user.index') }}"><i class='bx bxs-user'></i><span class="text">Utilisateurs</span></a></li>
            <li><a href="{{ route('admin.hotels.index') }}"><i class='bx bxs-hotel'></i><span class="text">Hôtels et appartements</span></a></li>
            <li><a href="{{ route('admin.destinations.index') }}"><i class='bx bxs-map'></i><span class="text">Destinations</span></a></li>
            <li class="active"><a href="{{ route('admin.restaurant.index') }}"><i class='bx bx-restaurant'></i><span class="text">Restaurants</span></a></li>
            <li><a href="{{ route('admin.group_touristiques.index') }}"><i class='bx bxs-group'></i><span class="text">Groupes touristiques</span></a></li>
        </ul>
        <ul class="side-menu">
            <li><a href="#"><i class='bx bxs-cog'></i><span class="text">Paramètres</span></a></li>
            <li><a href="{{ route('login') }}" class="logout"><i class='bx bxs-log-out-circle'></i><span class="text">Déconnexion</span></a></li>
        </ul>
    </section>

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Tableau de bord</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" id="navSearch" placeholder="Rechercher..." aria-label="Rechercher des restaurants">
                    <button type="submit" class="search-btn" aria-label="Rechercher"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden aria-label="Activer le mode sombre">
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification" aria-label="Voir les notifications">
                <i class='bx bxs-bell'></i>
                <span class="num">5</span>
            </a>
            <div class="profile">
                <img src="{{ auth()->user() && auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/default.jpg') }}" alt="Photo de l'utilisateur">
                <div class="profile-popup" id="profilePopup">
                    <div class="popup-content">
                        <img src="{{ auth()->user() && auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/default.jpg') }}" alt="Photo de l'utilisateur">
                        <h3>{{ auth()->user() ? auth()->user()->name : 'Administrateur' }}</h3>
                        <p>Email : {{ auth()->user() ? auth()->user()->email : 'admin@example.com' }}</p>
                        <p>Rôle : {{ auth()->user() && auth()->user()->is_admin ? 'Administrateur' : 'Utilisateur' }}</p>
                        <button class="btn btn-logout" onclick="window.location.href='{{ route('login') }}'">Déconnexion</button>
                    </div>
                </div>
            </div>
            <div class="notification-popup" id="notificationPopup" role="dialog" aria-label="Notifications">
                <div class="popup-content">
                    <h3>Notifications</h3>
                    <ul class="notification-list">
                        <li>Nouvel utilisateur : Mohammed Ali</li>
                        <li>Abonnement de Fatima Zahra à l'hôtel Enchanté</li>
                        <li>Abonnement d'Ahmed Ben à la destination Marrakech</li>
                        <li>Inscription de Sarah Khan</li>
                        <li>Abonnement de Youssef Omar à l'hôtel Oasis</li>
                    </ul>
                    <button class="btn-clear">Tout effacer</button>
                </div>
            </div>
        </nav>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Tableau de bord</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Tableau de bord</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Restaurants</a></li>
                    </ul>
                </div>
                <a href="#" class="btn-download" onclick="downloadPDF()"><i class='bx bxs-cloud-download'></i><span class="text">Télécharger PDF</span></a>
            </div>

            <div class="table-toggle-buttons">
                <button class="table-toggle-btn active" id="btn-restaurants">Restaurants</button>
                <button class="table-toggle-btn" id="btn-menus">Menus</button>
            </div>

            <div class="table-data" id="restaurants-table">
                <div class="order">
                    <div class="head">
                        <h3>Liste des restaurants</h3>
                        <i class='bx bx-filter' data-filter="all" aria-label="Filtrer les restaurants"></i>
                    </div>
                    <table role="grid" aria-label="Tableau de gestion des restaurants">
                        <thead>
                            <tr>
                                <th colspan="8">
                                    <button class="btn btn-add-table" id="addRestaurantBtn" aria-label="Ajouter un restaurant">
                                        <i class='bx bx-plus'></i><span class="text">Ajouter</span>
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Description</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="restaurantTableBody">
                            @foreach ($restaurants as $restaurant)
                                <tr data-created-at="{{ $restaurant->created_at }}">
                                    <td data-label="Image">
                                        @php
                                            $imagePath = $restaurant->image ? 'restaurants/' . $restaurant->image : null;
                                            $imageExists = $imagePath && Storage::disk('public')->exists($imagePath);
                                            \Log::debug("Restaurant {$restaurant->id} image:", ['path' => $imagePath, 'exists' => $imageExists]);
                                        @endphp
                                        @if ($imageExists)
                                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Image du restaurant {{ $restaurant->name }}" class="restaurant-image" loading="lazy">
                                        @else
                                            <span class="no-image"> No image available</span>
                                        @endif
                                    </td>
                                    <td data-label="Nom"><p>{{ $restaurant->name }}</p></td>
                                    <td data-label="Catégorie">{{ $restaurant->category->name ?? 'Non spécifié' }}</td>
                                    <td data-label="Description" class="truncate">{{ $restaurant->description ?? 'Non disponible' }}</td>
                                    <td data-label="Adresse">
                                        <span class="truncate-address" title="{{ $restaurant->address ?? 'Non disponible' }}">{{ $restaurant->address ?? 'Non disponible' }}</span>
                                    </td>
                                    <td data-label="Téléphone">{{ $restaurant->phone ? e($restaurant->phone) : 'Non disponible' }}</td>
                                    <td data-label="Email">{{ $restaurant->email ?? 'Non disponible' }}</td>
                                    <td data-label="Actions">
                                        <button class="btn btn-edit restaurant-edit" aria-label="Modifier le restaurant"
                                            data-id="{{ $restaurant->id }}"
                                            data-name="{{ $restaurant->name }}"
                                            data-category-id="{{ $restaurant->category_id }}"
                                            data-description="{{ $restaurant->description ?? '' }}"
                                            data-address="{{ $restaurant->address ?? '' }}"
                                            data-phone="{{ $restaurant->phone ?? '' }}"
                                            data-email="{{ $restaurant->email ?? '' }}"
                                            data-image="{{ $imageExists ? asset('storage/' . $imagePath) : '' }}">
                                            <i class='bx bxs-pencil'></i>
                                        </button>
                                        <button class="btn btn-delete restaurant-delete" aria-label="Supprimer le restaurant"
                                            data-id="{{ $restaurant->id }}"
                                            data-name="{{ $restaurant->name }}">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-data" id="menus-table" style="display: none;">
                <div class="order">
                    <div class="head">
                        <h3>Liste des menus</h3>
                        <i class='bx bx-filter' data-filter="all" aria-label="Filtrer les menus"></i>
                    </div>
                    <table role="grid" aria-label="Tableau de gestion des menus">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    <button class="btn btn-add-table" id="addMenuBtn" aria-label="Ajouter un menu">
                                        <i class='bx bx-plus'></i><span class="text">Ajouter</span>
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <th>Restaurant</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="menuTableBody">
                            @foreach ($menus as $menu)
                                <tr data-created-at="{{ $menu->created_at }}">
                                    <td data-label="Image">
                                        @php
                                            $menuImagePath = $menu->image ? 'menus/' . $menu->image : null;
                                            $menuImageExists = $menuImagePath && Storage::disk('public')->exists($menuImagePath);
                                            \Log::debug("Menu {$menu->id} image:", ['path' => $menuImagePath, 'exists' => $menuImageExists]);
                                        @endphp
                                        @if ($menuImageExists)
                                            <img src="{{ asset('storage/' . $menuImagePath) }}" alt="Image du menu {{ $menu->name }}" class="menu-image" loading="lazy">
                                        @else
                                            <span class="no-image">لNo image available</span>
                                        @endif
                                    </td>
                                    <td data-label="Restaurant">
                                        <span class="truncate-address" title="{{ $menu->restaurant->name ?? 'erreur' }}">{{ $menu->restaurant->name ?? 'erreur' }}</span>
                                    </td>
                                    <td data-label="Nom"><p>{{ $menu->name }}</p></td>
                                    <td data-label="Description" class="truncate">{{ $menu->description ?? 'Non disponible' }}</td>
                                    <td data-label="Prix">{{ number_format($menu->price, 2) }} MAD</td>
                                    <td data-label="Actions">
                                        <button class="btn btn-edit menu-edit" aria-label="Modifier le menu"
                                            data-id="{{ $menu->id }}"
                                            data-restaurant-id="{{ $menu->restaurant_id }}"
                                            data-name="{{ $menu->name }}"
                                            data-description="{{ $menu->description ?? '' }}"
                                            data-price="{{ $menu->price }}"
                                            data-image="{{ $menuImageExists ? asset('storage/' . $menuImagePath) : '' }}">
                                            <i class='bx bxs-pencil'></i>
                                        </button>
                                        <button class="btn btn-delete menu-delete" aria-label="Supprimer le menu"
                                            data-id="{{ $menu->id }}"
                                            data-name="{{ $menu->name }}">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Update Restaurant Modal -->
            <div class="modal" id="updateModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('updateModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Modifier le restaurant</h2>
                    <form id="updateForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="restaurantId" name="id">
                        <label for="restaurantName">Nom</label>
                        <input type="text" id="restaurantName" name="name" required>
                        <span class="error-message" id="nameError"></span>
                        <label for="restaurantCategory">Catégorie</label>
                        <select id="restaurantCategory" name="category_id" required aria-label="Catégorie du restaurant">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="error-message" id="category_idError"></span>
                        <label for="restaurantDescription">Description</label>
                        <textarea id="restaurantDescription" name="description"></textarea>
                        <span class="error-message" id="descriptionError"></span>
                        <label for="restaurantAddress">Adresse</label>
                        <input type="text" id="restaurantAddress" name="address">
                        <span class="error-message" id="addressError"></span>
                        <label for="restaurantPhone">Téléphone</label>
                        <input type="tel" id="restaurantPhone" name="phone" placeholder="Exemple : +212 123 456 789">
                        <span class="error-message" id="phoneError"></span>
                        <label for="restaurantEmail">Email</label>
                        <input type="email" id="restaurantEmail" name="email">
                        <span class="error-message" id="emailError"></span>
                        <label for="restaurantImage">Image</label>
                        <input type="file" id="restaurantImage" name="image" accept="image/jpeg,image/png,image/gif">
                        <img id="imagePreview" src="" alt="Aperçu de l'image" style="display: none; max-width: 80px; margin-top: 10px;" loading="lazy">
                        <span class="error-message" id="imageError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Enregistrer les modifications">Enregistrer</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('updateModal')" aria-label="Annuler les modifications">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Restaurant Modal -->
            <div class="modal" id="addModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('addModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Ajouter un restaurant</h2>
                    <form id="addForm" enctype="multipart/form-data">
                        @csrf
                        <label for="addRestaurantName">Nom</label>
                        <input type="text" id="addRestaurantName" name="name" required>
                        <span class="error-message" id="addNameError"></span>
                        <label for="addRestaurantCategory">Catégorie</label>
                        <select id="addRestaurantCategory" name="category_id" required aria-label="Catégorie du restaurant">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="error-message" id="addCategory_idError"></span>
                        <label for="addRestaurantDescription">Description</label>
                        <textarea id="addRestaurantDescription" name="description"></textarea>
                        <span class="error-message" id="addDescriptionError"></span>
                        <label for="addRestaurantAddress">Adresse</label>
                        <input type="text" id="addRestaurantAddress" name="address">
                        <span class="error-message" id="addAddressError"></span>
                        <label for="addRestaurantPhone">Téléphone</label>
                        <input type="tel" id="addRestaurantPhone" name="phone" placeholder="Exemple : +212 123 456 789">
                        <span class="error-message" id="addPhoneError"></span>
                        <label for="addRestaurantEmail">Email</label>
                        <input type="email" id="addRestaurantEmail" name="email">
                        <span class="error-message" id="addEmailError"></span>
                        <label for="addRestaurantImage">Image</label>
                        <input type="file" id="addRestaurantImage" name="image" accept="image/jpeg,image/png,image/gif">
                        <img id="addImagePreview" src="" alt="Aperçu de l'image" style="display: none; max-width: 80px; margin-top: 10px;" loading="lazy">
                        <span class="error-message" id="addImageError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Ajouter le restaurant">Ajouter</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('addModal')" aria-label="Annuler l'ajout">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Menu Modal -->
            <div class="modal" id="updateMenuModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('updateMenuModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Modifier le menu</h2>
                    <form id="updateMenuForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="menuId" name="id">
                        <label for="menuRestaurant">Restaurant</label>
                        <select id="menuRestaurant" name="restaurant_id" required aria-label="Restaurant du menu">
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                            @endforeach
                        </select>
                        <span class="error-message" id="menuRestaurantError"></span>
                        <label for="menuName">Nom</label>
                        <input type="text" id="menuName" name="name" required>
                        <span class="error-message" id="menuNameError"></span>
                        <label for="menuDescription">Description</label>
                        <textarea id="menuDescription" name="description"></textarea>
                        <span class="error-message" id="menuDescriptionError"></span>
                        <label for="menuPrice">Prix (MAD)</label>
                        <input type="number" id="menuPrice" name="price" step="0.01" min="0" required>
                        <span class="error-message" id="menuPriceError"></span>
                        <label for="menuImage">Image</label>
                        <input type="file" id="menuImage" name="image" accept="image/jpeg,image/png,image/gif">
                        <img id="menuImagePreview" src="" alt="Aperçu de l'image" style="display: none; max-width: 80px; margin-top: 10px;" loading="lazy">
                        <span class="error-message" id="menuImageError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Enregistrer les modifications">Enregistrer</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('updateMenuModal')" aria-label="Annuler les modifications">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Menu Modal -->
            <div class="modal" id="addMenuModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('addMenuModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Ajouter un menu</h2>
                    <form id="addMenuForm" enctype="multipart/form-data">
                        @csrf
                        <label for="addMenuRestaurant">Restaurant</label>
                        <select id="addMenuRestaurant" name="restaurant_id" required aria-label="Restaurant du menu">
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                            @endforeach
                        </select>
                        <span class="error-message" id="addMenuRestaurantError"></span>
                        <label for="addMenuName">Nom</label>
                        <input type="text" id="addMenuName" name="name" required>
                        <span class="error-message" id="addMenuNameError"></span>
                        <label for="addMenuDescription">Description</label>
                        <textarea id="addMenuDescription" name="description"></textarea>
                        <span class="error-message" id="addMenuDescriptionError"></span>
                        <label for="addMenuPrice">Prix (MAD)</label>
                        <input type="number" id="addMenuPrice" name="price" step="0.01" min="0" required>
                        <span class="error-message" id="addMenuPriceError"></span>
                        <label for="addMenuImage">Image</label>
                        <input type="file" id="addMenuImage" name="image" accept="image/jpeg,image/png,image/gif">
                        <img id="addMenuImagePreview" src="" alt="Aperçu de l'image" style="display: none; max-width: 80px; margin-top: 10px;" loading="lazy">
                        <span class="error-message" id="addMenuImageError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Ajouter le menu">Ajouter</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('addMenuModal')" aria-label="Annuler l'ajout">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <script>
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                modal.style.display = 'none';
                const form = modal.querySelector('form');
                if (form) form.reset();
                clearErrorMessages(modalId);
                modal.querySelectorAll('img[id$="Preview"]').forEach(img => img.style.display = 'none');
            }

            function clearErrorMessages(modalId) {
                document.querySelectorAll(`#${modalId} .error-message`).forEach(error => {
                    error.textContent = '';
                    error.classList.remove('show');
                });
            }

            // Display Errors
            function displayErrors(errors, modalId) {
                clearErrorMessages(modalId);
                Object.keys(errors).forEach(key => {
                    const errorElement = document.getElementById(`${modalId === 'addModal' ? 'add' : modalId === 'updateModal' ? '' : 'menu'}${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                    if (errorElement) {
                        errorElement.textContent = errors[key][0];
                        errorElement.classList.add('show');
                    }
                });
            }

            // Table Toggle
            const btnRestaurants = document.getElementById('btn-restaurants');
            const btnMenus = document.getElementById('btn-menus');
            const restaurantsTable = document.getElementById('restaurants-table');
            const menusTable = document.getElementById('menus-table');

            btnRestaurants.addEventListener('click', () => {
                restaurantsTable.style.display = 'block';
                menusTable.style.display = 'none';
                btnRestaurants.classList.add('active');
                btnMenus.classList.remove('active');
            });

            btnMenus.addEventListener('click', () => {
                menusTable.style.display = 'block';
                restaurantsTable.style.display = 'none';
                btnMenus.classList.add('active');
                btnRestaurants.classList.remove('active');
            });

            // Search Functionality
            document.getElementById('navSearch')?.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const restaurantRows = document.querySelectorAll('#restaurantTableBody tr');
                const menuRows = document.querySelectorAll('#menuTableBody tr');

                restaurantRows.forEach(row => {
                    const name = row.querySelector('td[data-label="Nom"] p')?.textContent.toLowerCase() || '';
                    const category = row.querySelector('td[data-label="Catégorie"]')?.textContent.toLowerCase() || '';
                    const address = row.querySelector('td[data-label="Adresse"]')?.textContent.toLowerCase() || '';
                    row.style.display = name.includes(searchTerm) || category.includes(searchTerm) || address.includes(searchTerm) ? '' : 'none';
                });

                menuRows.forEach(row => {
                    const restaurant = row.querySelector('td[data-label="Restaurant"]')?.textContent.toLowerCase() || '';
                    const name = row.querySelector('td[data-label="Nom"] p')?.textContent.toLowerCase() || '';
                    row.style.display = restaurant.includes(searchTerm) || name.includes(searchTerm) ? '' : 'none';
                });
            });

            // Validate File
            function validateFile(file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const maxSizeMB = 2;
                if (!allowedTypes.includes(file.type)) {
                    return 'L\'image doit être au format JPEG, PNG ou GIF.';
                }
                if (file.size > maxSizeMB * 1024 * 1024) {
                    return `L'image ne doit pas dépasser ${maxSizeMB}MB.${maxSizeMB} `;
                }
                return null;
            }

            // Image Preview
            function handleImagePreview(inputId, previewId) {
                document.getElementById(inputId).addEventListener('change', function() {
                    const preview = document.getElementById(previewId);
                    const file = this.files[0];
                    if (file) {
                        const error = validateFile(file);
                        if (error) {
                            alert(error);
                            this.value = '';
                            preview.style.display = 'none';
                            return;
                        }
                        const reader = new FileReader();
                        reader.onload = e => {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                    }
                });
            }

            handleImagePreview('addRestaurantImage', 'addImagePreview');
            handleImagePreview('restaurantImage', 'imagePreview');
            handleImagePreview('addMenuImage', 'addMenuImagePreview');
            handleImagePreview('menuImage', 'menuImagePreview');

            // Open Add Restaurant Modal
            document.getElementById('addRestaurantBtn').addEventListener('click', () => {
                document.getElementById('addForm').reset();
                document.getElementById('addImagePreview').style.display = 'none';
                clearErrorMessages('addModal');
                document.getElementById('addModal').style.display = 'flex';
            });

            // Open Add Menu Modal
            document.getElementById('addMenuBtn').addEventListener('click', () => {
                document.getElementById('addMenuForm').reset();
                document.getElementById('addMenuImagePreview').style.display = 'none';
                clearErrorMessages('addMenuModal');
                document.getElementById('addMenuModal').style.display = 'flex';
            });

            // Open Update Restaurant Modal
            document.querySelectorAll('.restaurant-edit').forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById('restaurantId').value = button.dataset.id;
                    document.getElementById('restaurantName').value = button.dataset.name;
                    document.getElementById('restaurantCategory').value = button.dataset.categoryId;
                    document.getElementById('restaurantDescription').value = button.dataset.description;
                    document.getElementById('restaurantAddress').value = button.dataset.address;
                    document.getElementById('restaurantPhone').value = button.dataset.phone;
                    document.getElementById('restaurantEmail').value = button.dataset.email;
                    const preview = document.getElementById('imagePreview');
                    if (button.dataset.image) {
                        preview.src = button.dataset.image;
                        preview.style.display = 'block';
                    } else {
                        preview.style.display = 'none';
                    }
                    clearErrorMessages('updateModal');
                    document.getElementById('updateModal').style.display = 'flex';
                    restaurantsTable.style.display = 'block';
                    menusTable.style.display = 'none';
                    btnRestaurants.classList.add('active');
                    btnMenus.classList.remove('active');
                });
            });

            // Open Update Menu Modal
            document.querySelectorAll('.menu-edit').forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById('menuId').value = button.dataset.id;
                    document.getElementById('menuRestaurant').value = button.dataset.restaurantId;
                    document.getElementById('menuName').value = button.dataset.name;
                    document.getElementById('menuDescription').value = button.dataset.description;
                    document.getElementById('menuPrice').value = button.dataset.price;
                    const preview = document.getElementById('menuImagePreview');
                    if (button.dataset.image) {
                        preview.src = button.dataset.image;
                        preview.style.display = 'block';
                    } else {
                        preview.style.display = 'none';
                    }
                    clearErrorMessages('updateMenuModal');
                    document.getElementById('updateMenuModal').style.display = 'flex';
                    menusTable.style.display = 'block';
                    restaurantsTable.style.display = 'none';
                    btnMenus.classList.add('active');
                    btnRestaurants.classList.remove('active');
                });
            });

            // Add Restaurant
            document.getElementById('addForm').addEventListener('submit', async e => {
                e.preventDefault();
                const formData = new FormData(e.target);
                if (formData.get('image').size > 0) {
                    const error = validateFile(formData.get('image'));
                    if (error) {
                        document.getElementById('addImageError').textContent = error;
                        document.getElementById('addImageError').classList.add('show');
                        return;
                    }
                }
                try {
                    const response = await fetch("{{ route('admin.restaurant.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-CSRF-TOKEN': csrfToken }
                    });
                    const data = await response.json();
                    if (data.status) {
                        alert('Restaurant ajouté avec succès ! ');
                        location.reload();
                    } else {
                        displayErrors(data.errors || {}, 'addModal');
                        alert(data.message || 'Une erreur est survenue.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Erreur de connexion au serveur  ');
                }
            });

            // Update Restaurant
            document.getElementById('updateForm').addEventListener('submit', async e => {
                e.preventDefault();
                const formData = new FormData(e.target);
                const id = document.getElementById('restaurantId').value;
                if (formData.get('image').size > 0) {
                    const error = validateFile(formData.get('image'));
                    if (error) {
                        document.getElementById('imageError').textContent = error;
                        document.getElementById('imageError').classList.add('show');
                        return;
                    }
                }
                try {
                    const response = await fetch(`/admin/restaurants/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-HTTP-Method-Override': 'PUT'
                        }
                    });
                    const data = await response.json();
                    if (data.status) {
                        alert('Restaurant modifié avec succès ! ');
                        location.reload();
                    } else {
                        displayErrors(data.errors || {}, 'updateModal');
                        alert(data.message || 'Une erreur est survenue. ');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Erreur de connexion au serveur ');
                }
            });

            // Delete Restaurant
            document.querySelectorAll('.restaurant-delete').forEach(button => {
                button.addEventListener('click', async () => {
                    if (!confirm(`Voulez-vous supprimer le restaurant "${button.dataset.name}" ? "${button.dataset.name}"؟`)) return;
                    try {
                        const response = await fetch(`/admin/restaurants/${button.dataset.id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken }
                        });
                        const data = await response.json();
                        if (data.status) {
                            alert('Restaurant supprimé avec succès ! ');
                            location.reload();
                        } else {
                            alert(data.message || 'Erreur lors de la suppression.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Erreur de connexion au serveur ');
                    }
                });
            });

            // Add Menu
            document.getElementById('addMenuForm').addEventListener('submit', async e => {
                e.preventDefault();
                const formData = new FormData(e.target);
                if (formData.get('image').size > 0) {
                    const error = validateFile(formData.get('image'));
                    if (error) {
                        document.getElementById('addMenuImageError').textContent = error;
                        document.getElementById('addMenuImageError').classList.add('show');
                        return;
                    }
                }
                try {
                    const response = await fetch("{{ route('admin.menus.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-CSRF-TOKEN': csrfToken }
                    });
                    const data = await response.json();
                    if (data.status) {
                        alert('Menu ajouté avec succès ! ');
                        location.reload();
                    } else {
                        displayErrors(data.errors || {}, 'addMenuModal');
                        alert(data.message || 'Une erreur est survenue. ');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Erreur de connexion au serveur ');
                }
            });

            // Update Menu
            document.getElementById('updateMenuForm').addEventListener('submit', async e => {
                e.preventDefault();
                const formData = new FormData(e.target);
                const id = document.getElementById('menuId').value;
                if (formData.get('image').size > 0) {
                    const error = validateFile(formData.get('image'));
                    if (error) {
                        document.getElementById('menuImageError').textContent = error;
                        document.getElementById('menuImageError').classList.add('show');
                        return;
                    }
                }
                try {
                    const response = await fetch(`/admin/menus/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-HTTP-Method-Override': 'PUT'
                        }
                    });
                    const data = await response.json();
                    if (data.status) {
                        alert('Menu modifié avec succès ! ');
                        location.reload();
                    } else {
                        displayErrors(data.errors || {}, 'updateMenuModal');
                        alert(data.message || 'Une erreur est survenue. ');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Erreur de connexion au serveur ');
                }
            });

            // Delete Menu
            document.querySelectorAll('.menu-delete').forEach(button => {
                button.addEventListener('click', async () => {
                    if (!confirm(`Voulez-vous supprimer le menu "${button.dataset.name}" ? "${button.dataset.name}"؟`)) return;
                    try {
                        const response = await fetch(`/admin/menus/${button.dataset.id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken }
                        });
                        const data = await response.json();
                        if (data.status) {
                            alert('Menu supprimé avec succès !');
                            location.reload();
                        } else {
                            alert(data.message || 'Erreur lors de la suppression. ');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Erreur de connexion au serveur  ');
                    }
                });
            });

            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', e => {
                    if (e.target === modal) closeModal(modal.id);
                });
            });

        </script>
    </section>
        <script src="{{ asset('js/admin/main.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
</body>
</html>
