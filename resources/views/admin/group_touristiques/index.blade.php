<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration - Groupes touristiques</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <!-- Ajout des scripts pour jsPDF et autoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
    <style>
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
        .group-image {
            width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            margin: 2px;
        }
        .image-gallery {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .view-all-icon {
            color: #3498db;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s, transform 0.3s;
        }
        .view-all-icon:hover {
            color: #2980b9;
            transform: scale(1.2);
        }
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 10px;
        }
        .image-preview {
            position: relative;
        }
        .image-preview img {
            width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        .image-preview-remove {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
        }
        .gallery-modal-content {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        .gallery-image {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }
        /* Style pour le bouton de téléchargement PDF */
        .btn-download {
            padding: 0.75rem 1.5rem;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.3s;
        }
        .btn-download:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-landscape'></i>
            <span class="text">Sahara Adventures</span>
        </a>
        <ul class="side-menu top">
            <li><a href="{{ route('admin.user.index') }}"><i class='bx bxs-user'></i><span class="text">Utilisateurs</span></a></li>
            <li><a href="{{ route('admin.hotels.index') }}"><i class='bx bxs-hotel'></i><span class="text">Hôtels et appartements</span></a></li>
            <li ><a href="{{ route('admin.destinations.index') }}"><i class='bx bxs-map'></i><span class="text">Destinations</span></a></li>
            <li><a href="{{ route('admin.restaurant.index') }}"><i class='bx bx-restaurant'></i><span class="text">Restaurants</span></a></li>
            <li class="active"><a href="{{ route('admin.group_touristiques.index') }}"><i class='bx bxs-group'></i><span class="text">Groupes touristiques</span></a></li>
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
                    <input type="search" id="navSearch" placeholder="Rechercher..." aria-label="Rechercher des groupes touristiques">
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
            <div class="notification-popup" id="notificationPopup" role="dialog" aria-label="Notifications">
                <div class="popup-content">
                    <h3>Notifications</h3>
                    <ul class="notification-list">
                        <li>Nouvel utilisateur : Mohammed Ali</li>
                        <li>Inscription à un groupe touristique : Fatima Zahra</li>
                        <li>Inscription à un groupe touristique : Ahmed Ben</li>
                        <li>Inscription de Sarah Khan</li>
                        <li>Inscription à un groupe touristique : Youssef Omar</li>
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
                        <li><a class="active" href="#">Groupes touristiques</a></li>
                    </ul>
                </div>
                <a href="#" class="btn-download" onclick="downloadPDF()"><i class='bx bxs-cloud-download'></i><span class="text">Télécharger PDF</span></a>
            </div>

            <div class="table-data" id="groups-table">
                <div class="order">
                    <div class="head">
                        <h3>Liste des groupes touristiques</h3>
                        <i class='bx bx-filter' data-filter="all" aria-label="Filtrer les groupes touristiques"></i>
                    </div>
                    <table role="grid" aria-label="Tableau de gestion des groupes touristiques">
                        <thead>
                            <tr>
                                <th colspan="9">
                                    <button class="btn btn-add-table" id="addGroupBtn" aria-label="Ajouter un groupe touristique">
                                        <i class='bx bx-plus'></i><span class="text">Ajouter</span>
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>Images</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Durée</th>
                                <th>NB personnes</th>
                                <th>Point de départ</th>
                                <th>Nom de la caravane</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="groupTableBody">
                            @foreach ($groups as $group)
                                <tr data-created-at="{{ $group->created_at }}">
                                    <td data-label="Images" class="image-gallery">
                                        @if ($group->images && is_array($group->images) && count($group->images) > 0)
                                            @if (Storage::disk('public')->exists($group->images[0]))
                                                <img src="{{ asset('storage/' . $group->images[0]) }}" alt="Image du groupe {{ $group->title }}" class="group-image" onerror="this.src='{{ asset('images/default-group.jpg') }}'" loading="lazy">
                                            @else
                                                <img src="{{ asset('images/default-group.jpg') }}" alt="Aucune image pour le groupe {{ $group->title }}" class="group-image" loading="lazy">
                                            @endif
                                            @if (count($group->images) > 1)
                                                <i class='bx bx-images view-all-icon' title="Voir toutes les images" data-images="{{ json_encode($group->images ? array_map(fn($img) => asset('storage/' . $img), $group->images) : [asset('images/default-group.jpg')]) }}" data-title="{{ $group->title }}"></i>
                                            @endif
                                        @else
                                            <img src="{{ asset('images/default-group.jpg') }}" alt="Aucune image pour le groupe {{ $group->title }}" class="group-image" loading="lazy">
                                        @endif
                                    </td>
                                    <td data-label="Titre"><p>{{ $group->title }}</p></td>
                                    <td data-label="Description" class="truncate">{{ $group->description ?? 'Non disponible' }}</td>
                                    <td data-label="Durée">{{ $group->duration ?? 'Non disponible' }}</td>
                                    <td data-label="Nombre max de personnes">{{ $group->max_people ?? 'Non disponible' }}</td>
                                    <td data-label="Point de départ">{{ $group->starting_point ?? 'Non disponible' }}</td>
                                    <td data-label="Nom de la caravane">{{ is_array($group->caravan_name) && count($group->caravan_name) > 0 ? $group->caravan_name[0] : 'Non disponible' }}</td>
                                    <td data-label="Prix">{{ number_format($group->price, 2) }} MAD</td>
                                    <td data-label="Actions">
                                        <button class="btn btn-edit group-edit" aria-label="Modifier le groupe touristique"
                                            data-id="{{ $group->id }}"
                                            data-title="{{ $group->title }}"
                                            data-description="{{ $group->description ?? '' }}"
                                            data-duration="{{ $group->duration ?? '' }}"
                                            data-max_people="{{ $group->max_people ?? '' }}"
                                            data-starting_point="{{ $group->starting_point ?? '' }}"
                                            data-caravan_name="{{ is_array($group->caravan_name) ? implode(', ', $group->caravan_name) : '' }}"
                                            data-registration_link="{{ $group->registration_link ?? '' }}"
                                            data-social_media_links="{{ is_array($group->social_media_links) ? implode(', ', $group->social_media_links) : '' }}"
                                            data-price="{{ $group->price }}"
                                            data-images="{{ json_encode($group->images ? array_map(fn($img) => asset('storage/' . $img), $group->images) : [asset('images/default-group.jpg')]) }}">
                                            <i class='bx bxs-pencil'></i>
                                        </button>
                                        <button class="btn btn-delete" aria-label="Supprimer le groupe touristique"
                                            data-id="{{ $group->id }}"
                                            data-title="{{ $group->title }}">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal" id="addGroupModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('addGroupModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Ajouter un groupe touristique</h2>
                    <form id="addGroupForm" enctype="multipart/form-data">
                        @csrf
                        <label for="addGroupTitle">Titre</label>
                        <input type="text" id="addGroupTitle" name="title" required>
                        <span class="error-message" id="titleError"></span>
                        <label for="addGroupDescription">Description</label>
                        <textarea id="addGroupDescription" name="description"></textarea>
                        <span class="error-message" id="descriptionError"></span>
                        <label for="addGroupDuration">Durée</label>
                        <input type="text" id="addGroupDuration" name="duration" required>
                        <span class="error-message" id="durationError"></span>
                        <label for="addGroupMaxPeople">Nombre max de personnes</label>
                        <input type="number" id="addGroupMaxPeople" name="max_people" min="1" required>
                        <span class="error-message" id="max_peopleError"></span>
                        <label for="addGroupStartingPoint">Point de départ</label>
                        <input type="text" id="addGroupStartingPoint" name="starting_point" required>
                        <span class="error-message" id="starting_pointError"></span>
                        <label for="addGroupCaravanName">Nom de la caravane</label>
                        <input type="text" id="addGroupCaravanName" name="caravan_name">
                        <span class="error-message" id="caravan_nameError"></span>
                        <label for="addGroupRegistrationLink">Lien d'inscription</label>
                        <input type="url" id="addGroupRegistrationLink" name="registration_link">
                        <span class="error-message" id="registration_linkError"></span>
                        <label for="addGroupSocialMediaLinks">Liens réseaux sociaux (séparés par des virgules)</label>
                        <input type="text" id="addGroupSocialMediaLinks" name="social_media_links">
                        <span class="error-message" id="social_media_linksError"></span>
                        <label for="addGroupPrice">Prix (MAD)</label>
                        <input type="number" id="addGroupPrice" name="price" step="0.01" min="0" required>
                        <span class="error-message" id="priceError"></span>
                        <label for="addGroupImages">Images</label>
                        <input type="file" id="addGroupImages" name="images[]" accept="image/jpeg,image/png,image/gif" multiple>
                        <div id="addGroupImagesPreview" class="image-preview-container"></div>
                        <span class="error-message" id="imagesError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Ajouter le groupe touristique">Ajouter</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('addGroupModal')" aria-label="Annuler l'ajout">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal" id="updateGroupModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('updateGroupModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Modifier un groupe touristique</h2>
                    <form id="updateGroupForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="groupId" name="id">
                        <label for="groupTitle">Titre</label>
                        <input type="text" id="groupTitle" name="title" required>
                        <span class="error-message" id="titleError"></span>
                        <label for="groupDescription">Description</label>
                        <textarea id="groupDescription" name="description"></textarea>
                        <span class="error-message" id="descriptionError"></span>
                        <label for="groupDuration">Durée</label>
                        <input type="text" id="groupDuration" name="duration" required>
                        <span class="error-message" id="durationError"></span>
                        <label for="groupMaxPeople">Nombre max de personnes</label>
                        <input type="number" id="groupMaxPeople" name="max_people" min="1" required>
                        <span class="error-message" id="max_peopleError"></span>
                        <label for="groupStartingPoint">Point de départ</label>
                        <input type="text" id="groupStartingPoint" name="starting_point" required>
                        <span class="error-message" id="starting_pointError"></span>
                        <label for="groupCaravanName">Nom de la caravane</label>
                        <input type="text" id="groupCaravanName" name="caravan_name">
                        <span class="error-message" id="caravan_nameError"></span>
                        <label for="groupRegistrationLink">Lien d'inscription</label>
                        <input type="url" id="groupRegistrationLink" name="registration_link">
                        <span class="error-message" id="registration_linkError"></span>
                        <label for="groupSocialMediaLinks">Liens réseaux sociaux (séparés par des virgules)</label>
                        <input type="text" id="groupSocialMediaLinks" name="social_media_links">
                        <span class="error-message" id="social_media_linksError"></span>
                        <label for="groupPrice">Prix (MAD)</label>
                        <input type="number" id="groupPrice" name="price" step="0.01" min="0" required>
                        <span class="error-message" id="priceError"></span>
                        <label for="groupImages">Images</label>
                        <input type="file" id="groupImages" name="images[]" accept="image/jpeg,image/png,image/gif" multiple>
                        <div id="groupImagesPreview" class="image-preview-container"></div>
                        <span class="error-message" id="imagesError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Enregistrer les modifications">Enregistrer</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('updateGroupModal')" aria-label="Annuler les modifications">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal" id="imageGalleryModal">
                <div class="modal-content gallery-modal-content">
                    <button class="btn-close" onclick="closeModal('imageGalleryModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2 id="galleryTitle">Galerie d'images</h2>
                    <div id="imageGalleryContent"></div>
                </div>
            </div>
        </main>
    </section>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Toggle Sidebar
        document.querySelector('.bx-menu').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('hide');
        });

        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            clearErrorMessages(modalId);
        }

        // Clear Error Messages
        function clearErrorMessages(modalId) {
            document.querySelectorAll(`#${modalId} .error-message`).forEach(error => {
                error.textContent = '';
                error.classList.remove('show');
            });
        }

        // Display Errors
        function displayErrors(errors, modalId) {
            clearErrorMessages(modalId);
            if (errors && typeof errors === 'object' && Object.keys(errors).length > 0) {
                Object.keys(errors).forEach(key => {
                    const errorElement = document.getElementById(`${key}Error`);
                    if (errorElement) {
                        errorElement.textContent = Array.isArray(errors[key]) ? errors[key][0] : errors[key];
                        errorElement.classList.add('show');
                    }
                });
            }
        }

        // Search Functionality
        document.getElementById('navSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#groupTableBody tr');

            rows.forEach(row => {
                const title = row.querySelector('td[data-label="Titre"] p')?.textContent.toLowerCase() || '';
                const description = row.querySelector('td[data-label="Description"]')?.textContent.toLowerCase() || '';
                const duration = row.querySelector('td[data-label="Durée"]')?.textContent.toLowerCase() || '';
                const startingPoint = row.querySelector('td[data-label="Point de départ"]')?.textContent.toLowerCase() || '';
                const caravanName = row.querySelector('td[data-label="Nom de la caravane"]')?.textContent.toLowerCase() || '';
                const price = row.querySelector('td[data-label="Prix"]')?.textContent.toLowerCase() || '';

                const isMatch = title.includes(searchTerm) ||
                               description.includes(searchTerm) ||
                               duration.includes(searchTerm) ||
                               startingPoint.includes(searchTerm) ||
                               caravanName.includes(searchTerm) ||
                               price.includes(searchTerm);

                row.style.display = isMatch ? '' : 'none';
            });
        });

        // Open Add Group Modal
        document.getElementById('addGroupBtn')?.addEventListener('click', () => {
            document.getElementById('addGroupForm').reset();
            document.getElementById('addGroupImagesPreview').innerHTML = '';
            document.getElementById('addGroupImages').value = '';
            clearErrorMessages('addGroupModal');
            document.getElementById('addGroupModal').style.display = 'flex';
        });

        // Open Edit Group Modal
        document.querySelectorAll('.group-edit').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('groupId').value = button.dataset.id;
                document.getElementById('groupTitle').value = button.dataset.title;
                document.getElementById('groupDescription').value = button.dataset.description;
                document.getElementById('groupDuration').value = button.dataset.duration;
                document.getElementById('groupMaxPeople').value = button.dataset.max_people;
                document.getElementById('groupStartingPoint').value = button.dataset.starting_point;
                document.getElementById('groupCaravanName').value = button.dataset.caravan_name;
                document.getElementById('groupRegistrationLink').value = button.dataset.registration_link;
                document.getElementById('groupSocialMediaLinks').value = button.dataset.social_media_links;
                document.getElementById('groupPrice').value = button.dataset.price;

                const images = JSON.parse(button.dataset.images);
                const previewContainer = document.getElementById('groupImagesPreview');
                previewContainer.innerHTML = '';
                images.forEach((src, index) => {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.className = 'image-preview';
                    imgWrapper.innerHTML = `
                        <img src="${src}" alt="Aperçu de l'image">
                        <span class="image-preview-remove" data-index="${index}">×</span>
                    `;
                    previewContainer.appendChild(imgWrapper);
                });

                document.getElementById('groupImages').value = '';
                clearErrorMessages('updateGroupModal');
                document.getElementById('updateGroupModal').style.display = 'flex';
            });
        });

        // Open Image Gallery Modal
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('view-all-icon')) {
                e.preventDefault();
                const images = JSON.parse(e.target.dataset.images);
                const title = e.target.dataset.title;
                const galleryContent = document.getElementById('imageGalleryContent');
                galleryContent.innerHTML = images.map(src => `
                    <img src="${src}" alt="Image du groupe ${title}" class="gallery-image" onerror="this.src='{{ asset('images/default-group.jpg') }}'" loading="lazy">
                `).join('');
                document.getElementById('galleryTitle').textContent = `Galerie d'images : ${title}`;
                document.getElementById('imageGalleryModal').style.display = 'flex';
            }
        });

        // Disable Context Menu in Add and Update Modals
        ['addGroupModal', 'updateGroupModal'].forEach(modalId => {
            document.getElementById(modalId).addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });
        });

        // Add Group Form Submission
        document.getElementById('addGroupForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            clearErrorMessages('addGroupModal');

            try {
                const response = await fetch("{{ route('admin.group_touristiques.store') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                });

                const data = await response.json();

                if (data.status) {
                    alert('Groupe ajouté avec succès');
                    location.reload();
                } else {
                    displayErrors(data.errors || {}, 'addGroupModal');
                    if (!data.errors) {
                        alert(data.message || 'Une erreur est survenue');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Erreur de connexion au serveur');
            }
        });

        // Update Group Form Submission
        document.getElementById('updateGroupForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('groupId').value;
            clearErrorMessages('updateGroupModal');

            try {
                const response = await fetch(`/admin/group_touristiques/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    credentials: 'same-origin'
                });

                const data = await response.json();

                if (data.status) {
                    alert('Groupe modifié avec succès');
                    location.reload();
                } else {
                    displayErrors(data.errors || {}, 'updateGroupModal');
                    if (!data.errors) {
                        alert(data.message || 'Une erreur est survenue');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Erreur de connexion au serveur');
            }
        });

        // Delete Group
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!confirm(`Êtes-vous sûr de vouloir supprimer le groupe "${this.dataset.title}" ?`)) return;

                try {
                    const response = await fetch(`/admin/group_touristiques/${this.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    });

                    const data = await response.json();

                    if (data.status) {
                        alert('Groupe supprimé avec succès');
                        location.reload();
                    } else {
                        alert('Erreur : ' + (data.message || 'Échec de la suppression'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Erreur de connexion au serveur');
                }
            });
        });

        // Image Preview for Add Form
        document.getElementById('addGroupImages').addEventListener('change', function() {
            const previewContainer = document.getElementById('addGroupImagesPreview');
            previewContainer.innerHTML = '';
            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.className = 'image-preview';
                    imgWrapper.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu de l'image">
                        <span class="image-preview-remove" data-index="${index}">×</span>
                    `;
                    previewContainer.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            });
        });

        // Image Preview for Update Form
        document.getElementById('groupImages').addEventListener('change', function() {
            const previewContainer = document.getElementById('groupImagesPreview');
            previewContainer.innerHTML = '';
            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.className = 'image-preview';
                    imgWrapper.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu de l'image">
                        <span class="image-preview-remove" data-index="${index}">×</span>
                    `;
                    previewContainer.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            });
        });

        // Remove Image from Preview
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('image-preview-remove')) {
                const index = parseInt(e.target.dataset.index);
                const modal = e.target.closest('.modal');
                const input = modal.querySelector('input[type="file"]');
                const previewContainer = modal.querySelector('.image-preview-container');
                const dt = new DataTransfer();

                Array.from(input.files).forEach((file, i) => {
                    if (i !== index) dt.items.add(file);
                });

                input.files = dt.files;
                previewContainer.children[index].remove();

                Array.from(previewContainer.querySelectorAll('.image-preview-remove')).forEach((btn, i) => {
                    btn.dataset.index = i;
                });
            }
        });

        // Close Modal on Outside Click
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('mousedown', function(e) {
                if (e.target === modal) {
                    closeModal(modal.id);
                }
            });
        });

        // Show Groups Table on Load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('groups-table').style.display = 'block';
        });

        // Fonction pour générer le PDF
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            // Titre du document
            doc.setFontSize(16);
            doc.setFont('helvetica', 'bold');
            doc.text('Liste des groupes touristiques', 14, 20);

            // Extraction des données du tableau
            const table = document.querySelector('#groupTableBody').closest('table');
            const rows = table.querySelectorAll('tbody tr');
            const data = [];
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const images = cells[0].querySelector('img') ? 'Image disponible' : 'Aucune image';
                const title = cells[1].textContent.trim();
                const description = cells[2].textContent.trim();
                const duration = cells[3].textContent.trim();
                const maxPeople = cells[4].textContent.trim();
                const startingPoint = cells[5].textContent.trim();
                const caravanName = cells[6].textContent.trim();
                const price = cells[7].textContent.trim();
                data.push([images, title, description, duration, maxPeople, startingPoint, caravanName, price]);
            });

            // Génération du tableau
            doc.autoTable({
                head: [['Images', 'Titre', 'Description', 'Durée', 'NB personnes', 'Point de départ', 'Nom de la caravane', 'Prix']],
                body: data,
                startY: 30,
                theme: 'grid',
                headStyles: {
                    fillColor: [41, 128, 185],
                    textColor: [255, 255, 255],
                    fontSize: 12,
                    fontStyle: 'bold'
                },
                bodyStyles: {
                    fontSize: 10,
                    cellPadding: 3,
                    textColor: [0, 0, 0]
                },
                columnStyles: {
                    0: { cellWidth: 30 },
                    1: { cellWidth: 30 },
                    2: { cellWidth: 40 },
                    3: { cellWidth: 20 },
                    4: { cellWidth: 20 },
                    5: { cellWidth: 30 },
                    6: { cellWidth: 30 },
                    7: { cellWidth: 20 }
                },
                margin: { top: 30, left: 14, right: 14 },
                styles: {
                    overflow: 'linebreak',
                    cellWidth: 'wrap'
                },
                didParseCell: function(data) {
                    if (data.cell.section === 'body') {
                        data.cell.styles.cellWidth = 'auto';
                    }
                }
            });

            doc.save('groupes_touristiques.pdf');
        }
    </script>
        <script src="{{ asset('js/admin/main.js') }}"></script>

</body>
</html>
