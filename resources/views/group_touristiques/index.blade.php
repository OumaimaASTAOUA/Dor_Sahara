<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration - Groupes Touristiques</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <style>
        .image-container, .links-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .group-image {
            max-width: 30px;
            height: auto;
            border-radius: 4px;
            object-fit: cover;
        }
        .view-images, .view-links {
            cursor: pointer;
            font-size: 20px;
            color: var(--blue);
            transition: color 0.2s ease;
        }
        .view-images:hover, .view-links:hover {
            color: #2a6bb3;
        }
        #imagesContainer, #linksContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 16px;
        }
        #imagesContainer img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
        }
        #imagesContainer .no-images, #linksContainer .no-links {
            color: var(--dark-grey);
            font-size: 14px;
            font-style: italic;
        }
        #viewImagesModal .modal-content, #viewLinksModal .modal-content {
            width: 90%;
            max-width: 400px;
            padding: 16px;
            background: var(--light);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .error-message {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }
        .error-message.show {
            display: block;
        }
        @media screen and (max-width: 576px) {
            .group-image {
                max-width: 25px;
            }
            .view-images, .view-links {
                font-size: 18px;
            }
            #imagesContainer img {
                max-width: 80px;
            }
            #imagesContainer .no-images, #linksContainer .no-links {
                font-size: 13px;
            }
            #viewImagesModal .modal-content, #viewLinksModal .modal-content {
                max-width: 350px;
                padding: 12px;
            }
        }
        @media screen and (max-width: 400px) {
            .group-image {
                max-width: 22px;
            }
            .view-images, .view-links {
                font-size: 16px;
            }
            #viewImagesModal .modal-content, #viewLinksModal .modal-content {
                max-width: 320px;
            }
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
            <li><a href="{{ route('admin.hotel.index') }}"><i class='bx bxs-hotel'></i><span class="text">Hôtels</span></a></li>
            <li><a href="{{ route('admin.destinations.index') }}"><i class='bx bxs-map'></i><span class="text">Destinations</span></a></li>
            <li><a href="{{ route('admin.restaurant.index') }}"><i class='bx bx-restaurant'></i><span class="text">Restaurants</span></a></li>
            <li><a href="{{ route('admin.review.index') }}"><i class='bx bxs-comment-detail'></i><span class="text">Avis</span></a></li>
            <li class="active"><a href="{{ route('admin.tourist_group.index') }}"><i class='bx bxs-group'></i><span class="text">Groupes touristiques</span></a></li>
        </ul>
        <ul class="side-menu">
            <li><a href="#"><i class='bx bxs-cog'></i><span class="text">Paramètres</span></a></li>
            <li><a href="#" class="logout"><i class='bx bxs-log-out-circle'></i><span class="text">Déconnexion</span></a></li>
        </ul>
    </section>

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <a href="{{ route('admin.tourist_group.index') }}" class="nav-link">Groupes Touristiques</a>
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
                <img src="https://via.placeholder.com/36" alt="Image de l'utilisateur">
                <div class="profile-popup" id="profilePopup">
                    <div class="popup-content">
                        <img src="https://via.placeholder.com/80" alt="Image de l'utilisateur">
                        <h3>{{ auth()->user() ? auth()->user()->name : 'Administration' }}</h3>
                        <p>Email : {{ auth()->user() ? auth()->user()->email : 'admin@example.com' }}</p>
                        <p>Rôle : {{ auth()->user() && auth()->user()->is_admin ? 'Administrateur' : 'Administrateur' }}</p>
                        <button class="btn btn-logout">Déconnexion</button>
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
                    <h1>Groupes Touristiques</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('admin.tourist_group.index') }}">Groupes Touristiques</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Liste</a></li>
                    </ul>
                </div>
                <a href="#" class="btn-download"><i class='bx bxs-cloud-download'></i><span class="text">Télécharger PDF</span></a>
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
                                <th colspan="10">
                                    <button class="btn btn-add-table" id="addGroupBtn" aria-label="Ajouter un groupe touristique">
                                        <i class='bx bx-plus'></i><span class="text">Ajouter</span>
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Durée</th>
                                <th>Max Personnes</th>
                                <th>Point de départ</th>
                                <th>Nom de la caravane</th>
                                <th>Lien d'inscription</th>
                                <th>Réseaux sociaux</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="groupTableBody">
                            @foreach ($groups as $group)
                                <tr>
                                    <td data-label="Image">
                                        <div class="image-container">
                                            @php
                                                $images = json_decode($group->images, true);
                                                $imagePath = $images && count($images) > 0 ? 'storage/group_touristiques/' . $images[0] : 'images/default-group.jpg';
                                            @endphp
                                            <img src="{{ asset($imagePath) }}" alt="Image du groupe {{ $group->title }}" class="group-image" onerror="this.src='{{ asset('images/default-group.jpg') }}'" loading="lazy">
                                            <i class='bx bx-images view-images' data-images="{{ $group->images ?? '[]' }}" aria-label="Voir toutes les images"></i>
                                        </div>
                                    </td>
                                    <td data-label="Titre"><p>{{ $group->title }}</p></td>
                                    <td data-label="Description" class="truncate">{{ $group->description ?? 'Non disponible' }}</td>
                                    <td data-label="Durée">{{ $group->duration }}</td>
                                    <td data-label="Max Personnes">{{ $group->max_people }}</td>
                                    <td data-label="Point de départ">{{ $group->starting_point }}</td>
                                    <td data-label="Nom de la caravane">
                                        @php
                                            $caravans = json_decode($group->caravan_name, true);
                                        @endphp
                                        {{ is_array($caravans) ? implode(', ', $caravans) : $group->caravan_name }}
                                    </td>
                                    <td data-label="Lien d'inscription">
                                        <a href="{{ $group->registration_link }}" target="_blank">{{ Str::limit($group->registration_link, 20) }}</a>
                                    </td>
                                    <td data-label="Réseaux sociaux">
                                        <div class="links-container">
                                            <i class='bx bx-link view-links' data-links="{{ $group->social_media_links ?? '[]' }}" aria-label="Voir les liens des réseaux sociaux"></i>
                                        </div>
                                    </td>
                                    <td data-label="Prix">{{ number_format($group->price, 2) }} MAD</td>
                                    <td data-label="Actions">
                                        <button class="btn btn-edit group-edit" aria-label="Modifier le groupe touristique"
                                            data-id="{{ $group->id }}"
                                            data-title="{{ $group->title }}"
                                            data-description="{{ $group->description ?? '' }}"
                                            data-duration="{{ $group->duration }}"
                                            data-max_people="{{ $group->max_people }}"
                                            data-starting_point="{{ $group->starting_point }}"
                                            data-caravan_name="{{ $group->caravan_name ?? '[]' }}"
                                            data-registration_link="{{ $group->registration_link }}"
                                            data-social_media_links="{{ $group->social_media_links ?? '[]' }}"
                                            data-price="{{ $group->price }}"
                                            data-images="{{ $group->images ?? '[]' }}">
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

            <!-- Add Group Modal -->
            <div class="modal" id="addGroupModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="document.getElementById('addGroupModal').style.display='none'" aria-label="Fermer la fenêtre">×</button>
                    <h2>Ajouter un groupe touristique</h2>
                    <form id="addGroupForm" enctype="multipart/form-data">
                        @csrf
                        <label for="addGroupTitle">Titre</label>
                        <input type="text" id="addGroupTitle" name="title" required>
                        <span class="error-message" id="addTitleError"></span>
                        <label for="addGroupDescription">Description</label>
                        <textarea id="addGroupDescription" name="description"></textarea>
                        <span class="error-message" id="addDescriptionError"></span>
                        <label for="addGroupDuration">Durée</label>
                        <input type="text" id="addGroupDuration" name="duration" required>
                        <span class="error-message" id="addDurationError"></span>
                        <label for="addGroupMaxPeople">Nombre maximum de personnes</label>
                        <input type="number" id="addGroupMaxPeople" name="max_people" required min="1">
                        <span class="error-message" id="addMaxPeopleError"></span>
                        <label for="addGroupStartingPoint">Point de départ</label>
                        <input type="text" id="addGroupStartingPoint" name="starting_point" required>
                        <span class="error-message" id="addStartingPointError"></span>
                        <label for="addGroupCaravanName">Nom de la caravane (séparé par des virgules)</label>
                        <input type="text" id="addGroupCaravanName" name="caravan_name">
                        <span class="error-message" id="addCaravanNameError"></span>
                        <label for="addGroupRegistrationLink">Lien d'inscription</label>
                        <input type="url" id="addGroupRegistrationLink" name="registration_link" required>
                        <span class="error-message" id="addRegistrationLinkError"></span>
                        <label for="addGroupSocialMediaLinks">Liens des réseaux sociaux (séparés par des virgules)</label>
                        <input type="text" id="addGroupSocialMediaLinks" name="social_media_links">
                        <span class="error-message" id="addSocialMediaLinksError"></span>
                        <label for="addGroupPrice">Prix (MAD)</label>
                        <input type="number" id="addGroupPrice" name="price" required step="0.01" min="0">
                        <span class="error-message" id="addPriceError"></span>
                        <label for="addGroupImages">Images (JPEG, PNG, GIF, max 2MB)</label>
                        <input type="file" id="addGroupImages" name="images[]" multiple accept="image/jpeg,image/png,image/gif">
                        <span class="error-message" id="addImagesError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Ajouter le groupe touristique">Ajouter</button>
                            <button type="button" class="btn btn-cancel" aria-label="Annuler l'ajout">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Group Modal -->
            <div class="modal" id="updateGroupModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="document.getElementById('updateGroupModal').style.display='none'" aria-label="Fermer la fenêtre">×</button>
                    <h2>Modifier le groupe touristique</h2>
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
                        <label for="groupMaxPeople">Nombre maximum de personnes</label>
                        <input type="number" id="groupMaxPeople" name="max_people" required min="1">
                        <span class="error-message" id="maxPeopleError"></span>
                        <label for="groupStartingPoint">Point de départ</label>
                        <input type="text" id="groupStartingPoint" name="starting_point" required>
                        <span class="error-message" id="startingPointError"></span>
                        <label for="groupCaravanName">Nom de la caravane (séparé par des virgules)</label>
                        <input type="text" id="groupCaravanName" name="caravan_name">
                        <span class="error-message" id="caravanNameError"></span>
                        <label for="groupRegistrationLink">Lien d'inscription</label>
                        <input type="url" id="groupRegistrationLink" name="registration_link" required>
                        <span class="error-message" id="registrationLinkError"></span>
                        <label for="groupSocialMediaLinks">Liens des réseaux sociaux (سéparés par des virgules)</label>
                        <input type="text" id="groupSocialMediaLinks" name="social_media_links">
                        <span class="error-message" id="socialMediaLinksError"></span>
                        <label for="groupPrice">Prix (MAD)</label>
                        <input type="number" id="groupPrice" name="price" required step="0.01" min="0">
                        <span class="error-message" id="priceError"></span>
                        <label for="groupImages">Images (JPEG, PNG, GIF, max 2MB)</label>
                        <input type="file" id="groupImages" name="images[]" multiple accept="image/jpeg,image/png,image/gif">
                        <span class="error-message" id="imagesError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Enregistrer les modifications">Enregistrer</button>
                            <button type="button" class="btn btn-cancel" aria-label="Annuler les modifications">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- View Images Modal -->
            <div class="modal" id="viewImagesModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="document.getElementById('viewImagesModal').style.display='none'" aria-label="Fermer la fenêtre">×</button>
                    <h2>Images du groupe touristique</h2>
                    <div id="imagesContainer"></div>
                </div>
            </div>

            <!-- View Social Media Links Modal -->
            <div class="modal" id="viewLinksModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="document.getElementById('viewLinksModal').style.display='none'" aria-label="Fermer la fenêtre">×</button>
                    <h2>Liens des réseaux sociaux</h2>
                    <div id="linksContainer"></div>
                </div>
            </div>
        </main>

        <script src="{{ asset('js/admin/main.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const viewImagesModal = document.getElementById('viewImagesModal');
                const viewLinksModal = document.getElementById('viewLinksModal');
                if (viewImagesModal) viewImagesModal.style.display = 'none';
                if (viewLinksModal) viewLinksModal.style.display = 'none';

                // Validate files
                const validateFiles = (files, maxSizeMB = 2, allowedTypes = ['image/jpeg', 'image/png', 'image/gif']) => {
                    for (let file of files) {
                        if (!allowedTypes.includes(file.type)) {
                            return `Le fichier ${file.name} doit être un JPEG, PNG ou GIF.`;
                        }
                        if (file.size > maxSizeMB * 1024 * 1024) {
                            return `Le fichier ${file.name} dépasse la taille maximale de ${maxSizeMB}MB.`;
                        }
                    }
                    return null;
                };

                // Add Group Form
                const addForm = document.getElementById('addGroupForm');
                addForm.addEventListener('submit', (e) => {
                    const fileInput = document.getElementById('addGroupImages');
                    const errorElement = document.getElementById('addImagesError');
                    if (fileInput.files.length > 0) {
                        const error = validateFiles(fileInput.files);
                        if (error) {
                            e.preventDefault();
                            errorElement.textContent = error;
                            errorElement.classList.add('show');
                            return;
                        }
                    }
                    errorElement.classList.remove('show');
                });

                // Update Group Form
                const updateForm = document.getElementById('updateGroupForm');
                updateForm.addEventListener('submit', (e) => {
                    const fileInput = document.getElementById('groupImages');
                    const errorElement = document.getElementById('imagesError');
                    if (fileInput.files.length > 0) {
                        const error = validateFiles(fileInput.files);
                        if (error) {
                            e.preventDefault();
                            errorElement.textContent = error;
                            errorElement.classList.add('show');
                            return;
                        }
                    }
                    errorElement.classList.remove('show');
                });

                // View Images
                document.querySelectorAll('.view-images').forEach(icon => {
                    icon.addEventListener('click', (event) => {
                        event.preventDefault();
                        event.stopPropagation();
                        const images = JSON.parse(icon.dataset.images || '[]');
                        const imagesContainer = document.getElementById('imagesContainer');
                        const modal = document.getElementById('viewImagesModal');

                        imagesContainer.innerHTML = '';
                        if (images.length > 0) {
                            images.forEach(image => {
                                const img = document.createElement('img');
                                img.src = '{{ asset("storage/group_touristiques/") }}/' + image;
                                img.alt = 'Image du groupe touristique';
                                img.onerror = () => { img.src = '{{ asset("images/default-group.jpg") }}'; };
                                imagesContainer.appendChild(img);
                            });
                        } else {
                            const noImages = document.createElement('p');
                            noImages.className = 'no-images';
                            noImages.textContent = 'Aucune image disponible';
                            imagesContainer.appendChild(noImages);
                        }
                        modal.style.display = 'block';
                    });
                });

                // View Social Media Links
                document.querySelectorAll('.view-links').forEach(icon => {
                    icon.addEventListener('click', (event) => {
                        event.preventDefault();
                        event.stopPropagation();
                        const links = JSON.parse(icon.dataset.links || '[]');
                        const linksContainer = document.getElementById('linksContainer');
                        const modal = document.getElementById('viewLinksModal');

                        linksContainer.innerHTML = '';
                        if (links.length > 0) {
                            links.forEach(link => {
                                const a = document.createElement('a');
                                a.href = link;
                                a.textContent = link;
                                a.target = '_blank';
                                a.style.display = 'block';
                                linksContainer.appendChild(a);
                            });
                        } else {
                            const noLinks = document.createElement('p');
                            noLinks.className = 'no-links';
                            noLinks.textContent = 'Aucun lien disponible';
                            linksContainer.appendChild(noLinks);
                        }
                        modal.style.display = 'block';
                    });
                });
            });
        </script>
</body>
</html>
