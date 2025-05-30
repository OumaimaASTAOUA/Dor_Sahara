<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration - Hôtels et Appartements</title>
    <link href='https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css' rel='stylesheet'>
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
            <li class="active"><a href="{{ route('admin.hotels.index') }}"><i class='bx bxs-hotel'></i><span class="text">Hôtels et appartements</span></a></li>
            <li><a href="{{ route('admin.destinations.index') }}"><i class='bx bxs-map'></i><span class="text">Destinations</span></a></li>
            <li><a href="{{ route('admin.restaurant.index') }}"><i class='bx bx-restaurant'></i><span class="text">Restaurants</span></a></li>
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
                    <input type="search" id="navSearch" placeholder="Rechercher..." aria-label="Rechercher des hôtels ou appartements">
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
                        <li><a class="active" href="#">Hôtels et Appartements</a></li>
                    </ul>
                </div>
                <a href="#" class="btn-download" onclick="downloadPDF()"><i class='bx bxs-cloud-download'></i><span class="text">Télécharger PDF</span></a>
            </div>

            <div class="table-toggle-buttons">
                <button class="table-toggle-btn active" id="btn-hotels">Hôtels</button>
                <button class="table-toggle-btn" id="btn-apartments">Appartements</button>
            </div>

            <!-- Hotels Table -->
            <div class="table-data" id="hotels-table">
                <div class="order">
                    <div class="head">
                        <h3>Liste des hôtels</h3>
                        <i class='bx bx-filter' data-filter="all" aria-label="Filtrer les hôtels"></i>
                    </div>
                    <table role="grid" aria-label="Tableau de gestion des hôtels">
                        <thead>
                            <tr>
                                <th colspan="9">
                                    <button class="btn btn-add-table" id="addHotelBtn" aria-label="Ajouter un hôtel">
                                        <i class='bx bx-plus'></i><span class="text">Ajouter</span>
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Localisation</th>
                                <th>Prix (MAD)</th>
                                <th>Note</th>
                                <th>Disponibilité</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="hotelTableBody">
                            @foreach ($hotels as $hotel)
                                <tr data-created-at="{{ $hotel->created_at }}">
                                    <td data-label="Image">
                                        <img src="{{ $hotel->image ? asset('storage/hotels/' . $hotel->image) : asset('images/default.jpg') }}"
                                             alt="Image de l'hôtel {{ $hotel->name }}"
                                             class="hotel-image"
                                             loading="lazy"
                                             onerror="this.src='{{ asset('images/default.jpg') }}'">
                                    </td>
                                    <td data-label="Nom"><p>{{ $hotel->name }}</p></td>
                                    <td data-label="Description" class="truncate">{{ $hotel->description }}</td>
                                    <td data-label="Localisation">
                                        <span class="truncate-location" title="{{ $hotel->location }}">{{ $hotel->location }}</span>
                                    </td>
                                    <td data-label="Prix">{{ number_format($hotel->price, 2) }}</td>
                                    <td data-label="Note">{{ $hotel->rating ? number_format($hotel->rating, 2) : 'N/A' }}</td>
                                    <td data-label="Disponibilité">{{ $hotel->availability ? 'Oui' : 'Non' }}</td>
                                    <td data-label="Statut">{{ $hotel->status }}</td>
                                    <td data-label="Actions">
                                        <button class="btn btn-edit hotel-edit" aria-label="Modifier l'hôtel"
                                            data-id="{{ $hotel->id }}"
                                            data-name="{{ $hotel->name }}"
                                            data-description="{{ $hotel->description }}"
                                            data-location="{{ $hotel->location }}"
                                            data-price="{{ $hotel->price }}"
                                            data-rating="{{ $hotel->rating }}"
                                            data-availability="{{ $hotel->availability ? '1' : '0' }}"
                                            data-status="{{ $hotel->status }}"
                                            data-link="{{ $hotel->link }}"
                                            data-image="{{ $hotel->image ? asset('storage/hotels/' . $hotel->image) : '' }}">
                                            <i class='bx bxs-pencil'></i>
                                        </button>
                                        <button class="btn btn-delete hotel-delete" aria-label="Supprimer l'hôtel"
                                            data-id="{{ $hotel->id }}"
                                            data-name="{{ $hotel->name }}">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Apartments Table -->
            <div class="table-data" id="apartments-table" style="display: none;">
                <div class="order">
                    <div class="head">
                        <h3>Liste des appartements</h3>
                        <i class='bx bx-filter' data-filter="all" aria-label="Filtrer les appartements"></i>
                    </div>
                    <table role="grid" aria-label="Tableau de gestion des appartements">
                        <thead>
                            <tr>
                                <th colspan="9">
                                    <button class="btn btn-add-table" id="addApartmentBtn" aria-label="Ajouter un appartement">
                                        <i class='bx bx-plus'></i><span class="text">Ajouter</span>
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Localisation</th>
                                <th>Prix (MAD)</th>
                                <th>Note</th>
                                <th>Disponibilité</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="apartmentTableBody">
                            @foreach ($apartments as $apartment)
                                <tr data-created-at="{{ $apartment->created_at }}">
                                    <td data-label="Image">
                                        <img src="{{ $apartment->image ? asset('storage/apartments/' . $apartment->image) : asset('images/default.jpg') }}"
                                             alt="Image de l'appartement {{ $apartment->name }}"
                                             class="apartment-image"
                                             loading="lazy"
                                             onerror="this.src='{{ asset('images/default.jpg') }}'">
                                    </td>
                                    <td data-label="Nom"><p>{{ $apartment->name }}</p></td>
                                    <td data-label="Description" class="truncate">{{ $apartment->description }}</td>
                                    <td data-label="Localisation">
                                        <span class="truncate-location" title="{{ $apartment->location }}">{{ $apartment->location }}</span>
                                    </td>
                                    <td data-label="Prix">{{ number_format($apartment->price, 2) }}</td>
                                    <td data-label="Note">{{ $apartment->rating ? number_format($apartment->rating, 2) : 'N/A' }}</td>
                                    <td data-label="Disponibilité">{{ $apartment->availability ? 'Oui' : 'Non' }}</td>
                                    <td data-label="Statut">{{ $apartment->status }}</td>
                                    <td data-label="Actions">
                                        <button class="btn btn-edit apartment-edit" aria-label="Modifier l'appartement"
                                            data-id="{{ $apartment->id }}"
                                            data-name="{{ $apartment->name }}"
                                            data-description="{{ $apartment->description }}"
                                            data-location="{{ $apartment->location }}"
                                            data-price="{{ $apartment->price }}"
                                            data-rating="{{ $apartment->rating }}"
                                            data-availability="{{ $apartment->availability ? '1' : '0' }}"
                                            data-status="{{ $apartment->status }}"
                                            data-link="{{ $apartment->link }}"
                                            data-image="{{ $apartment->image ? asset('storage/apartments/' . $apartment->image) : '' }}">
                                            <i class='bx bxs-pencil'></i>
                                        </button>
                                        <button class="btn btn-delete apartment-delete" aria-label="Supprimer l'appartement"
                                            data-id="{{ $apartment->id }}"
                                            data-name="{{ $apartment->name }}">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Hotel Modal -->
            <div class="modal" id="addHotelModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('addHotelModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Ajouter un hôtel</h2>
                    <form id="addHotelForm" enctype="multipart/form-data">
                        @csrf
                        <label for="addHotelName">Nom</label>
                        <input type="text" id="addHotelName" name="name" required>
                        <span class="error-message" id="addHotelNameError"></span>
                        <label for="addHotelDescription">Description</label>
                        <textarea id="addHotelDescription" name="description" required></textarea>
                        <span class="error-message" id="addHotelDescriptionError"></span>
                        <label for="addHotelLocation">Localisation</label>
                        <input type="text" id="addHotelLocation" name="location" required>
                        <span class="error-message" id="addHotelLocationError"></span>
                        <label for="addHotelPrice">Prix (MAD)</label>
                        <input type="number" id="addHotelPrice" name="price" step="0.01" min="0" required>
                        <span class="error-message" id="addHotelPriceError"></span>
                        <label for="addHotelRating">Note (0-5)</label>
                        <input type="number" id="addHotelRating" name="rating" step="0.1" min="0" max="5">
                        <span class="error-message" id="addHotelRatingError"></span>
                        <label for="addHotelAvailability">Disponibilité</label>
                        <select id="addHotelAvailability" name="availability" required>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        <span class="error-message" id="addHotelAvailabilityError"></span>
                        <label for="addHotelStatus">Statut</label>
                        <select id="addHotelStatus" name="status" required>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                        <span class="error-message" id="addHotelStatusError"></span>
                        <label for="addHotelLink">Lien</label>
                        <input type="url" id="addHotelLink" name="link" required>
                        <span class="error-message" id="addHotelLinkError"></span>
                        <label for="addHotelImage">Image</label>
                        <input type="file" id="addHotelImage" name="image" accept="image/jpeg,image/png,image/gif">
                        <img id="addHotelImagePreview" src="" alt="Aperçu de l'image" style="display: none; max-width: 100px; margin-top: 10px;" loading="lazy">
                        <span class="error-message" id="addHotelImageError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Ajouter l'hôtel">Ajouter</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('addHotelModal')" aria-label="Annuler l'ajout">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Hotel Modal -->
            <div class="modal" id="updateHotelModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('updateHotelModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Modifier l'hôtel</h2>
                    <form id="updateHotelForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="hotelId" name="id">
                        <label for="hotelName">Nom</label>
                        <input type="text" id="hotelName" name="name" required>
                        <span class="error-message" id="hotelNameError"></span>
                        <label for="hotelDescription">Description</label>
                        <textarea id="hotelDescription" name="description" required></textarea>
                        <span class="error-message" id="hotelDescriptionError"></span>
                        <label for="hotelLocation">Localisation</label>
                        <input type="text" id="hotelLocation" name="location" required>
                        <span class="error-message" id="hotelLocationError"></span>
                        <label for="hotelPrice">Prix (MAD)</label>
                        <input type="number" id="hotelPrice" name="price" step="0.01" min="0" required>
                        <span class="error-message" id="hotelPriceError"></span>
                        <label for="hotelRating">Note (0-5)</label>
                        <input type="number" id="hotelRating" name="rating" step="0.1" min="0" max="5">
                        <span class="error-message" id="hotelRatingError"></span>
                        <label for="hotelAvailability">Disponibilité</label>
                        <select id="hotelAvailability" name="availability" required>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        <span class="error-message" id="hotelAvailabilityError"></span>
                        <label for="hotelStatus">Statut</label>
                        <select id="hotelStatus" name="status" required>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                        <span class="error-message" id="hotelStatusError"></span>
                        <label for="hotelLink">Lien</label>
                        <input type="url" id="hotelLink" name="link" required>
                        <span class="error-message" id="hotelLinkError"></span>
                        <label for="hotelImage">Image</label>
                        <input type="file" id="hotelImage" name="image" accept="image/jpeg,image/png,image/gif">
                        <img id="hotelImagePreview" src="" alt="Aperçu de l'image" style="display: none; max-width: 100px; margin-top: 10px;" loading="lazy">
                        <span class="error-message" id="hotelImageError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Enregistrer les modifications">Enregistrer</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('updateHotelModal')" aria-label="Annuler les modifications">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Apartment Modal -->
            <div class="modal" id="addApartmentModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('addApartmentModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Ajouter un appartement</h2>
                    <form id="addApartmentForm" enctype="multipart/form-data">
                        @csrf
                        <label for="addApartmentName">Nom</label>
                        <input type="text" id="addApartmentName" name="name" required>
                        <span class="error-message" id="addApartmentNameError"></span>
                        <label for="addApartmentDescription">Description</label>
                        <textarea id="addApartmentDescription" name="description" required></textarea>
                        <span class="error-message" id="addApartmentDescriptionError"></span>
                        <label for="addApartmentLocation">Localisation</label>
                        <input type="text" id="addApartmentLocation" name="location" required>
                        <span class="error-message" id="addApartmentLocationError"></span>
                        <label for="addApartmentPrice">Prix (MAD)</label>
                        <input type="number" id="addApartmentPrice" name="price" step="0.01" min="0" required>
                        <span class="error-message" id="addApartmentPriceError"></span>
                        <label for="addApartmentRating">Note (0-5)</label>
                        <input type="number" id="addApartmentRating" name="rating" step="0.1" min="0" max="5">
                        <span class="error-message" id="addApartmentRatingError"></span>
                        <label for="addApartmentAvailability">Disponibilité</label>
                        <select id="addApartmentAvailability" name="availability" required>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        <span class="error-message" id="addApartmentAvailabilityError"></span>
                        <label for="addApartmentStatus">Statut</label>
                        <select id="addApartmentStatus" name="status" required>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                        <span class="error-message" id="addApartmentStatusError"></span>
                        <label for="addApartmentLink">Lien</label>
                        <input type="url" id="addApartmentLink" name="link" required>
                        <span class="error-message" id="addApartmentLinkError"></span>
                        <label for="addApartmentImage">Image</label>
                        <input type="file" id="addApartmentImage" name="image" accept="image/jpeg,image/png,image/gif">
                        <img id="addApartmentImagePreview" src="" alt="Aperçu de l'image" style="display: none; max-width: 100px; margin-top: 10px;" loading="lazy">
                        <span class="error-message" id="addApartmentImageError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Ajouter l'appartement">Ajouter</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('addApartmentModal')" aria-label="Annuler l'ajout">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Apartment Modal -->
            <div class="modal" id="updateApartmentModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('updateApartmentModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Modifier l'appartement</h2>
                    <form id="updateApartmentForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="apartmentId" name="id">
                        <label for="apartmentName">Nom</label>
                        <input type="text" id="apartmentName" name="name" required>
                        <span class="error-message" id="apartmentNameError"></span>
                        <label for="apartmentDescription">Description</label>
                        <textarea id="apartmentDescription" name="description" required></textarea>
                        <span class="error-message" id="apartmentDescriptionError"></span>
                        <label for="apartmentLocation">Localisation</label>
                        <input type="text" id="apartmentLocation" name="location" required>
                        <span class="error-message" id="apartmentLocationError"></span>
                        <label for="apartmentPrice">Prix (MAD)</label>
                        <input type="number" id="apartmentPrice" name="price" step="0.01" min="0" required>
                        <span class="error-message" id="apartmentPriceError"></span>
                        <label for="apartmentRating">Note (0-5)</label>
                        <input type="number" id="apartmentRating" name="rating" step="0.1" min="0" max="5">
                        <span class="error-message" id="apartmentRatingError"></span>
                        <label for="apartmentAvailability">Disponibilité</label>
                        <select id="apartmentAvailability" name="availability" required>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        <span class="error-message" id="apartmentAvailabilityError"></span>
                        <label for="apartmentStatus">Statut</label>
                        <select id="apartmentStatus" name="status" required>
                            <option value="Actif">Actif</option>
                            <option value="Inactif">Inactif</option>
                        </select>
                        <span class="error-message" id="apartmentStatusError"></span>
                        <label for="apartmentLink">Lien</label>
                        <input type="url" id="apartmentLink" name="link" required>
                        <span class="error-message" id="apartmentLinkError"></span>
                        <label for="apartmentImage">Image</label>
                        <input type="file" id="apartmentImage" name="image" accept="image/jpeg,image/png,image/gif">
                        <img id="apartmentImagePreview" src="" alt="Aperçu de l'image" style="display: none; max-width: 100px; margin-top: 10px;" loading="lazy">
                        <span class="error-message" id="apartmentImageError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Enregistrer les modifications">Enregistrer</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('updateApartmentModal')" aria-label="Annuler les modifications">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

            <script>

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                function closeModal(modalId) {
                    const modal = document.getElementById(modalId);
                    modal.style.display = 'none';
                    const form = modal.querySelector('form');
                    if (form) form.reset();
                    clearErrorMessages(modalId);
                    modal.querySelectorAll('img[id$="ImagePreview"]').forEach(img => img.style.display = 'none');
                }

                function clearErrorMessages(modalId) {
                    document.querySelectorAll(`#${modalId} .error-message`).forEach(error => {
                        error.textContent = '';
                        error.classList.remove('show');
                    });
                }

                function displayErrors(errors, modalId) {
                    clearErrorMessages(modalId);
                    Object.keys(errors).forEach(key => {
                        const errorElement = document.getElementById(`${modalId.includes('add') ? 'add' : ''}${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                        if (errorElement) {
                            errorElement.textContent = errors[key][0];
                            errorElement.classList.add('show');
                        }
                    });
                }

                const btnHotels = document.getElementById('btn-hotels');
                const btnApartments = document.getElementById('btn-apartments');
                const hotelsTable = document.getElementById('hotels-table');
                const apartmentsTable = document.getElementById('apartments-table');

                btnHotels.addEventListener('click', () => {
                    hotelsTable.style.display = 'block';
                    apartmentsTable.style.display = 'none';
                    btnHotels.classList.add('active');
                    btnApartments.classList.remove('active');
                });

                btnApartments.addEventListener('click', () => {
                    apartmentsTable.style.display = 'block';
                    hotelsTable.style.display = 'none';
                    btnApartments.classList.add('active');
                    btnHotels.classList.remove('active');
                });

                document.getElementById('navSearch').addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const hotelRows = document.querySelectorAll('#hotelTableBody tr');
                    const apartmentRows = document.querySelectorAll('#apartmentTableBody tr');

                    hotelRows.forEach(row => {
                        const name = row.querySelector('td[data-label="Nom"] p')?.textContent.toLowerCase() || '';
                        const location = row.querySelector('td[data-label="Localisation"] span')?.textContent.toLowerCase() || '';
                        row.style.display = name.includes(searchTerm) || location.includes(searchTerm) ? '' : 'none';
                    });

                    apartmentRows.forEach(row => {
                        const name = row.querySelector('td[data-label="Nom"] p')?.textContent.toLowerCase() || '';
                        const location = row.querySelector('td[data-label="Localisation"] span')?.textContent.toLowerCase() || '';
                        row.style.display = name.includes(searchTerm) || location.includes(searchTerm) ? '' : 'none';
                    });
                });

                function validateFile(file) {
                    if (!file) return null;
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    const maxSizeMB = 2;
                    if (!allowedTypes.includes(file.type)) {
                        return 'L\'image doit être au format JPEG, PNG ou GIF.';
                    }
                    if (file.size > maxSizeMB * 1024 * 1024) {
                        return `L'image ne doit pas dépasser ${maxSizeMB}MB.`;
                    }
                    return null;
                }

                function handleImagePreview(inputId, previewId, errorId) {
                    const input = document.getElementById(inputId);
                    const preview = document.getElementById(previewId);
                    const errorElement = document.getElementById(errorId);

                    input.addEventListener('change', function() {
                        errorElement.textContent = '';
                        errorElement.classList.remove('show');
                        preview.style.display = 'none';

                        const file = this.files[0];
                        if (file) {
                            const error = validateFile(file);
                            if (error) {
                                errorElement.textContent = error;
                                errorElement.classList.add('show');
                                this.value = '';
                                return;
                            }
                            const reader = new FileReader();
                            reader.onload = e => {
                                preview.src = e.target.result;
                                preview.style.display = 'block';
                            };
                            reader.onerror = () => {
                                errorElement.textContent = 'Erreur lors de la lecture de l\'image.';
                                errorElement.classList.add('show');
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }

                handleImagePreview('addHotelImage', 'addHotelImagePreview', 'addHotelImageError');
                handleImagePreview('hotelImage', 'hotelImagePreview', 'hotelImageError');
                handleImagePreview('addApartmentImage', 'addApartmentImagePreview', 'addApartmentImageError');
                handleImagePreview('apartmentImage', 'apartmentImagePreview', 'apartmentImageError');

                document.querySelectorAll('.apartment-image, .hotel-image').forEach(img => {
                    img.addEventListener('error', () => {
                        console.error('Échec du chargement de l\'image:', img.src);
                        img.src = '{{ asset('images/default.jpg') }}';
                    });
                    img.addEventListener('load', () => {
                        console.log('Image chargée avec succès:', img.src);
                    });
                });

                document.getElementById('addHotelBtn').addEventListener('click', () => {
                    document.getElementById('addHotelForm').reset();
                    document.getElementById('addHotelImagePreview').style.display = 'none';
                    clearErrorMessages('addHotelModal');
                    document.getElementById('addHotelModal').style.display = 'flex';
                });

                document.getElementById('addApartmentBtn').addEventListener('click', () => {
                    document.getElementById('addApartmentForm').reset();
                    document.getElementById('addApartmentImagePreview').style.display = 'none';
                    clearErrorMessages('addApartmentModal');
                    document.getElementById('addApartmentModal').style.display = 'flex';
                });

                document.querySelectorAll('.hotel-edit').forEach(button => {
                    button.addEventListener('click', () => {
                        document.getElementById('hotelId').value = button.dataset.id;
                        document.getElementById('hotelName').value = button.dataset.name;
                        document.getElementById('hotelDescription').value = button.dataset.description;
                        document.getElementById('hotelLocation').value = button.dataset.location;
                        document.getElementById('hotelPrice').value = button.dataset.price;
                        document.getElementById('hotelRating').value = button.dataset.rating;
                        document.getElementById('hotelAvailability').value = button.dataset.availability;
                        document.getElementById('hotelStatus').value = button.dataset.status;
                        document.getElementById('hotelLink').value = button.dataset.link;
                        const preview = document.getElementById('hotelImagePreview');
                        if (button.dataset.image) {
                            preview.src = button.dataset.image;
                            preview.style.display = 'block';
                        } else {
                            preview.style.display = 'none';
                        }
                        clearErrorMessages('updateHotelModal');
                        document.getElementById('updateHotelModal').style.display = 'flex';
                    });
                });

                document.querySelectorAll('.apartment-edit').forEach(button => {
                    button.addEventListener('click', () => {
                        document.getElementById('apartmentId').value = button.dataset.id;
                        document.getElementById('apartmentName').value = button.dataset.name;
                        document.getElementById('apartmentDescription').value = button.dataset.description;
                        document.getElementById('apartmentLocation').value = button.dataset.location;
                        document.getElementById('apartmentPrice').value = button.dataset.price;
                        document.getElementById('apartmentRating').value = button.dataset.rating;
                        document.getElementById('apartmentAvailability').value = button.dataset.availability;
                        document.getElementById('apartmentStatus').value = button.dataset.status;
                        document.getElementById('apartmentLink').value = button.dataset.link;
                        const preview = document.getElementById('apartmentImagePreview');
                        if (button.dataset.image) {
                            preview.src = button.dataset.image;
                            preview.style.display = 'block';
                        } else {
                            preview.style.display = 'none';
                        }
                        clearErrorMessages('updateApartmentModal');
                        document.getElementById('updateApartmentModal').style.display = 'flex';
                    });
                });

                document.getElementById('addHotelForm').addEventListener('submit', async e => {
                    e.preventDefault();
                    const formData = new FormData(e.target);
                    const imageFile = formData.get('image');
                    if (imageFile && imageFile.size > 0) {
                        const error = validateFile(imageFile);
                        if (error) {
                            document.getElementById('addHotelImageError').textContent = error;
                            document.getElementById('addHotelImageError').classList.add('show');
                            return;
                        }
                    }
                    try {
                        const response = await fetch("{{ route('admin.hotels.store') }}", {
                            method: 'POST',
                            body: formData,
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                        });
                        const data = await response.json();
                        if (data.status) {
                            alert('Hôtel ajouté avec succès !');
                            location.reload();
                        } else {
                            displayErrors(data.errors || {}, 'addHotelModal');
                            alert(data.message || 'Une erreur est survenue.');
                        }
                    } catch (error) {
                        console.error('Erreur AJAX:', error);
                        alert('Erreur de connexion au serveur');
                    }
                });

                document.getElementById('updateHotelForm').addEventListener('submit', async e => {
                    e.preventDefault();
                    const formData = new FormData(e.target);
                    const id = document.getElementById('hotelId').value;
                    if (formData.get('image').size > 0) {
                        const error = validateFile(formData.get('image'));
                        if (error) {
                            document.getElementById('hotelImageError').textContent = error;
                            document.getElementById('hotelImageError').classList.add('show');
                            return;
                        }
                    }
                    try {
                        const response = await fetch(`/admin/hotels/${id}`, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-Token': csrfToken,
                                'X-HTTP-Method-Override': 'PUT',
                                'Accept': 'application/json'
                            }
                        });
                        const data = await response.json();
                        if (data.status) {
                            alert('Hôtel modifié avec succès !');
                            location.reload();
                        } else {
                            displayErrors(data.errors || {}, 'updateHotelModal');
                            alert(data.message || 'Une erreur est survenue.');
                        }
                    } catch (error) {
                        console.error('Erreur AJAX:', error);
                        alert('Erreur de connexion au serveur');
                    }
                });

                document.querySelectorAll('.hotel-delete').forEach(button => {
                    button.addEventListener('click', async () => {
                        if (!confirm(`Voulez-vous supprimer l'hôtel "${button.dataset.name}" ?`)) return;
                        try {
                            const response = await fetch(`/admin/hotels/${button.dataset.id}`, {
                                method: 'DELETE',
                                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                            });
                            const data = await response.json();
                            if (data.status) {
                                alert('Hôtel supprimé avec succès !');
                                location.reload();
                            } else {
                                alert(data.message || 'Erreur lors de la suppression.');
                            }
                        } catch (error) {
                            console.error('Erreur AJAX:', error);
                            alert('Erreur de connexion au serveur');
                        }
                    });
                });

                document.getElementById('addApartmentForm').addEventListener('submit', async e => {
                    e.preventDefault();
                    const formData = new FormData(e.target);
                    const imageFile = formData.get('image');
                    if (imageFile && imageFile.size > 0) {
                        const error = validateFile(imageFile);
                        if (error) {
                            document.getElementById('addApartmentImageError').textContent = error;
                            document.getElementById('addApartmentImageError').classList.add('show');
                            return;
                        }
                    }
                    try {
                        const response = await fetch("{{ route('admin.apartments.store') }}", {
                            method: 'POST',
                            body: formData,
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                        });
                        const data = await response.json();
                        if (data.status) {
                            alert('Appartement créé avec succès !');
                            location.reload();
                        } else {
                            displayErrors(data.errors || {}, 'addApartmentModal');
                            alert(data.message || 'Une erreur est survenue.');
                        }
                    } catch (error) {
                        console.error('Erreur AJAX:', error);
                        alert('Erreur de connexion au serveur');
                    }
                });

                document.getElementById('updateApartmentForm').addEventListener('submit', async e => {
                    e.preventDefault();
                    const formData = new FormData(e.target);
                    const id = document.getElementById('apartmentId').value;
                    if (formData.get('image').size > 0) {
                        const error = validateFile(formData.get('image'));
                        if (error) {
                            document.getElementById('apartmentImageError').textContent = error;
                            document.getElementById('apartmentImageError').classList.add('show');
                            return;
                        }
                    }
                    try {
                        const response = await fetch(`/admin/apartments/${id}`, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-Token': csrfToken,
                                'X-HTTP-Method-Override': 'PUT',
                                'Accept': 'application/json'
                            }
                        });
                        const data = await response.json();
                        if (data.status) {
                            alert('Appartement modifié avec succès !');
                            location.reload();
                        } else {
                            displayErrors(data.errors || {}, 'updateApartmentModal');
                            alert(data.message || 'Une erreur est survenue.');
                        }
                    } catch (error) {
                        console.error('Erreur AJAX:', error);
                        alert('Erreur de connexion au serveur');
                    }
                });

                document.querySelectorAll('.apartment-delete').forEach(button => {
                    button.addEventListener('click', async () => {
                        if (!confirm(`Voulez-vous supprimer l'appartement "${button.dataset.name}" ?`)) return;
                        try {
                            const response = await fetch(`/admin/apartments/${button.dataset.id}`, {
                                method: 'DELETE',
                                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                            });
                            const data = await response.json();
                            if (data.status) {
                                alert('Appartement supprimé avec succès !');
                                location.reload();
                            } else {
                                alert(data.message || 'Erreur lors de la suppression.');
                            }
                        } catch (error) {
                            console.error('Erreur AJAX:', error);
                            alert('Erreur de connexion au serveur');
                        }
                    });
                });

                document.querySelectorAll('.modal').forEach(modal => {
                    modal.addEventListener('click', e => {
                        if (e.target === modal) closeModal(modal.id);
                    });
                });
            </script>
        </main>
    </section>
    <script src="{{ asset('js/admin/main.js') }}"></script>

</body>
</html>


