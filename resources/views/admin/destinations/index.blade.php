<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration - Destinations</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

</head>
<body>
    <!-- Barre latérale -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-landscape'></i>
            <span class="text">Dor Sahara</span>
        </a>
        <ul class="side-menu top">
            <li><a href="{{ route('admin.user.index') }}"><i class='bx bxs-user'></i><span class="text">Utilisateurs</span></a></li>
            <li><a href="{{ route('admin.hotels.index') }}"><i class='bx bxs-hotel'></i><span class="text">Hôtels et appartements</span></a></li>
            <li class="active"><a href="{{ route('admin.destinations.index') }}"><i class='bx bxs-map'></i><span class="text">Destinations</span></a></li>
            <li><a href="{{ route('admin.restaurant.index') }}"><i class='bx bx-restaurant'></i><span class="text">Restaurants</span></a></li>
            <li><a href="{{ route('admin.group_touristiques.index') }}"><i class='bx bxs-group'></i><span class="text">Groupes touristiques</span></a></li>
        </ul>
        <ul class="side-menu">
            <li><a href="#"><i class='bx bxs-cog'></i><span class="text">Paramètres</span></a></li>
            <li><a href="{{ route('login') }}" class="logout"><i class='bx bxs-log-out-circle'></i><span class="text">Déconnexion</span></a></li>
        </ul>
    </section>

    <!-- Barre de navigation -->
    <section id="content">
        <nav>
            <i class='bx bx-menu' id="menuIcon"></i>
            <a href="{{ route('admin.destinations.index') }}" class="nav-link">Destinations</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" id="navSearch" placeholder="Rechercher..." aria-label="Rechercher des destinations">
                    <button type="submit" class="search-btn" aria-label="Rechercher"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden aria-label="Activer le mode sombre">
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification" id="notificationTrigger" aria-label="Voir les notifications">
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
                        <li>Aucun abonnement de Fatima Zahra à l'hôtel Enchanté</li>
                        <li>Abonnement d'Ahmed Ben à la destination Marrakech</li>
                        <li>Inscription de Sarah Khan</li>
                        <li>Aucun abonnement de Youssef Omar à l'hôtel Oasis</li>
                    </ul>
                    <button class="btn-clear" onclick="clearNotifications()">Tout effacer</button>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Destinations</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('admin.destinations.index') }}">Destinations</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Liste</a></li>
                    </ul>
                </div>
                <a href="#" class="btn-download" onclick="downloadPDF()"><i class='bx bxs-cloud-download'></i><span class="text">Télécharger PDF</span></a>
            </div>

            <!-- Tableau des destinations -->
            <div class="table-data" id="destinations-table">
                <div class="order">
                    <div class="head">
                        <h3>Liste des destinations</h3>
                        <i class='bx bx-filter' data-filter="all" aria-label="Filtrer les destinations"></i>
                    </div>
                    <table role="grid" aria-label="Tableau de gestion des destinations">
                        <thead>
                            <tr>
                                <th colspan="5">
                                    <button class="btn btn-add-table" id="addDestinationBtn" aria-label="Ajouter une destination">
                                        <i class='bx bx-plus'></i><span class="text">Ajouter</span>
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>Images</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="destinationTableBody">
                            @foreach ($destinations as $destination)
                                <tr data-created-at="{{ $destination->created_at }}">
                                    <td data-label="Images" class="image-gallery">
                                        @php
                                            $images = is_string($destination->images) ? json_decode($destination->images, true) : $destination->images;
                                            $images = is_array($images) ? array_filter($images) : [];
                                            $images = array_map(function($img) {
                                                return str_replace('destinations/', '', $img);
                                            }, $images);
                                        @endphp
                                        @if (!empty($images))
                                            @php
                                                $firstImage = 'destinations/' . $images[0];
                                                $imageExists = Storage::disk('public')->exists($firstImage);
                                            @endphp
                                            @if ($imageExists)
                                                <img src="{{ asset('storage/' . $firstImage) }}" alt="Image de la destination {{ $destination->title }}" class="destination-image" loading="lazy">
                                            @else
                                                <span class="no-images">Aucune image disponible</span>
                                            @endif
                                            @if (count($images) > 1)
                                                <i class='bx bx-images view-all-icon' title="Voir toutes les images" data-images="{{ json_encode(array_map(fn($img) => asset('storage/destinations/' . $img), $images)) }}" data-title="{{ $destination->title }}"></i>
                                            @endif
                                        @else
                                            <span class="no-images">Aucune image disponible</span>
                                        @endif
                                    </td>
                                    <td data-label="Titre"><p>{{ $destination->title }}</p></td>
                                    <td data-label="Description" class="truncate">{{ $destination->description ?? 'Non disponible' }}</td>
                                    <td data-label="Location">
                                        <div class="location-container">
                                            <span class="truncate-location" title="{{ $destination->location ?? 'Non spécifié' }}">{{ $destination->location ?? 'Non spécifié' }}</span>
                                            @if ($destination->location)
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($destination->location) }}" target="_blank" class="map-link" aria-label="Ouvrir {{ $destination->location }} dans Google Maps">
                                                    <i class='bx bxs-map'></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td data-label="Actions">
                                        <button class="btn btn-edit destination-edit" aria-label="Modifier la destination"
                                            data-id="{{ $destination->id }}"
                                            data-title="{{ $destination->title }}"
                                            data-description="{{ $destination->description ?? '' }}"
                                            data-location="{{ $destination->location ?? '' }}"
                                            data-images="{{ json_encode(array_map(fn($img) => asset('storage/destinations/' . $img), $images)) }}">
                                            <i class='bx bxs-pencil'></i>
                                        </button>
                                        <button class="btn btn-delete" aria-label="Supprimer la destination"
                                            data-id="{{ $destination->id }}"
                                            data-title="{{ $destination->title }}">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Ajouter Destination -->
            <div class="modal" id="addDestinationModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('addDestinationModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Ajouter une destination</h2>
                    <form id="addDestinationForm" enctype="multipart/form-data">
                        @csrf
                        <label for="addDestinationTitle">Titre</label>
                        <input type="text" id="addDestinationTitle" name="title" required>
                        <span class="error-message" id="titleError"></span>
                        <label for="addDestinationDescription">Description</label>
                        <textarea id="addDestinationDescription" name="description"></textarea>
                        <span class="error-message" id="descriptionError"></span>
                        <label for="addDestinationLocation">Localisation</label>
                        <input type="text" id="addDestinationLocation" name="location" required>
                        <span class="error-message" id="locationError"></span>
                        <label for="addDestinationImages">Images (JPEG, PNG, GIF, max 2MB)</label>
                        <input type="file" id="addDestinationImages" name="images[]" accept="image/jpeg,image/png,image/gif" multiple>
                        <div id="addDestinationImagesPreview" class="image-preview-container"></div>
                        <span class="error-message" id="imagesError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Ajouter la destination">Ajouter</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('addDestinationModal')" aria-label="Annuler l'ajout">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Modifier Destination -->
            <div class="modal" id="updateDestinationModal">
                <div class="modal-content">
                    <button class="btn-close" onclick="closeModal('updateDestinationModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2>Modifier une destination</h2>
                    <form id="updateDestinationForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="destinationId" name="id">
                        <label for="destinationTitle">Titre</label>
                        <input type="text" id="destinationTitle" name="title" required>
                        <span class="error-message" id="titleError"></span>
                        <label for="destinationDescription">Description</label>
                        <textarea id="destinationDescription" name="description"></textarea>
                        <span class="error-message" id="descriptionError"></span>
                        <label for="destinationLocation">Localisation</label>
                        <input type="text" id="destinationLocation" name="location" required>
                        <span class="error-message" id="locationError"></span>
                        <label for="destinationImages">Images (JPEG, PNG, GIF, max 2MB)</label>
                        <input type="file" id="destinationImages" name="images[]" accept="image/jpeg,image/png,image/gif" multiple>
                        <div id="destinationImagesPreview" class="image-preview-container"></div>
                        <span class="error-message" id="imagesError"></span>
                        <div class="modal-buttons">
                            <button type="submit" class="btn btn-save" aria-label="Enregistrer les modifications">Enregistrer</button>
                            <button type="button" class="btn btn-cancel" onclick="closeModal('updateDestinationModal')" aria-label="Annuler les modifications">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Galerie d'Images -->
            <div class="modal" id="imageGalleryModal">
                <div class="modal-content gallery-modal-content">
                    <button class="btn-close" onclick="closeModal('imageGalleryModal')" aria-label="Fermer la fenêtre">×</button>
                    <h2 id="galleryTitle">Galerie d'images</h2>
                    <div id="imageGalleryContent"></div>
                </div>
            </div>
        </main>

        <!-- Scripts JavaScript -->
        <script src="{{ asset('js/admin/main.js') }}"></script>
        <script>
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            function downloadPDF() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });

                doc.setFontSize(16);
                doc.setFont('helvetica', 'bold');
                doc.text('Liste des destinations', 14, 20);

                let currentY = 30;
                const destinationTable = document.getElementById('destinations-table').querySelector('table');
                const destinationRows = destinationTable.querySelectorAll('tbody tr');
                const destinationData = [];

                destinationRows.forEach(row => {
                    const rowData = [];
                    const cells = row.querySelectorAll('td');
                    rowData.push(cells[1].textContent.trim()); // Titre
                    rowData.push(cells[2].textContent.trim()); // Description
                    rowData.push(cells[3].querySelector('.truncate-location').textContent.trim()); // Localisation
                    destinationData.push(rowData);
                });

                if (destinationData.length > 0) {
                    doc.autoTable({
                        head: [['Titre', 'Description', 'Localisation']],
                        body: destinationData,
                        startY: currentY,
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
                            0: { cellWidth: 50 },
                            1: { cellWidth: 80 },
                            2: { cellWidth: 50 }
                        },
                        margin: { top: 30, left: 14, right: 14 },
                        styles: { overflow: 'linebreak', cellWidth: 'wrap' },
                        didParseCell: function(data) {
                            if (data.cell.section === 'body') {
                                data.cell.styles.cellWidth = 'auto';
                            }
                        }
                    });
                }

                doc.save('destinations.pdf');
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'none';
                    clearErrorMessages(modalId);
                }
            }

            function clearErrorMessages(modalId) {
                document.querySelectorAll(`#${modalId} .error-message`).forEach(error => {
                    error.textContent = '';
                    error.classList.remove('show');
                });
            }

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

            document.getElementById('navSearch')?.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('#destinationTableBody tr');

                rows.forEach(row => {
                    const title = row.querySelector('td[data-label="Titre"] p')?.textContent.toLowerCase() || '';
                    const description = row.querySelector('td[data-label="Description"]')?.textContent.toLowerCase() || '';
                    const location = row.querySelector('td[data-label="Location"] span')?.textContent.toLowerCase() || '';

                    const isMatch = title.includes(searchTerm) || description.includes(searchTerm) || location.includes(searchTerm);
                    row.style.display = isMatch ? '' : 'none';
                });
            });

            document.getElementById('addDestinationBtn')?.addEventListener('click', () => {
                document.getElementById('addDestinationForm').reset();
                document.getElementById('addDestinationImagesPreview').innerHTML = '';
                document.getElementById('addDestinationImages').value = '';
                clearErrorMessages('addDestinationModal');
                document.getElementById('addDestinationModal').style.display = 'flex';
            });

            document.querySelectorAll('.destination-edit').forEach(button => {
                button.addEventListener('click', () => {
                    try {
                        const destinationId = document.getElementById('destinationId');
                        const destinationTitle = document.getElementById('destinationTitle');
                        const destinationDescription = document.getElementById('destinationDescription');
                        const destinationLocation = document.getElementById('destinationLocation');
                        const destinationImagesPreview = document.getElementById('destinationImagesPreview');
                        const destinationImages = document.getElementById('destinationImages');

                        if (!destinationId || !destinationTitle || !destinationDescription || !destinationLocation || !destinationImagesPreview || !destinationImages) {
                            throw new Error('One or more modal input elements are missing');
                        }

                        destinationId.value = button.dataset.id || '';
                        destinationTitle.value = button.dataset.title || '';
                        destinationDescription.value = button.dataset.description || '';
                        destinationLocation.value = button.dataset.location || '';

                        let images = [];
                        try {
                            const rawImages = button.dataset.images || '[]';
                            images = JSON.parse(rawImages);
                            if (!Array.isArray(images)) {
                                console.warn('Parsed images is not an array, using empty array');
                                images = [];
                            }
                        } catch (e) {
                            console.error('Error parsing data-images JSON:', e, 'Raw value:', button.dataset.images);
                            images = [];
                        }

                        destinationImagesPreview.innerHTML = '';
                        if (images.length) {
                            images.forEach((src, index) => {
                                const imgWrapper = document.createElement('div');
                                imgWrapper.className = 'image-preview';
                                imgWrapper.innerHTML = `
                                    <img src="${src}" alt="Aperçu de l'image" loading="lazy">
                                    <span class="image-preview-remove" data-index="${index}">×</span>
                                `;
                                destinationImagesPreview.appendChild(imgWrapper);
                            });
                        } else {
                            destinationImagesPreview.innerHTML = '<span class="no-images">Aucune image disponible</span>';
                        }

                        destinationImages.value = '';
                        clearErrorMessages('updateDestinationModal');
                        document.getElementById('updateDestinationModal').style.display = 'flex';
                    } catch (error) {
                        console.error('Error opening edit modal:', error);
                        alert('Erreur lors de l\'ouverture du formulaire de modification: ' + error.message);
                    }
                });
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('view-all-icon')) {
                    e.preventDefault();
                    try {
                        let images = [];
                        try {
                            images = JSON.parse(e.target.dataset.images || '[]');
                            if (!Array.isArray(images)) {
                                images = [];
                            }
                        } catch (err) {
                            console.error('Error parsing gallery images:', err);
                            images = [];
                        }

                        const title = e.target.dataset.title || 'Destination';
                        const galleryContent = document.getElementById('imageGalleryContent');
                        galleryContent.innerHTML = images.length
                            ? images.map(src => `
                                <img src="${src}" alt="Image de ${title}" class="gallery-image" loading="lazy">
                            `).join('')
                            : '<span class="no-images">Aucune image disponible</span>';
                        document.getElementById('galleryTitle').textContent = `Galerie d'images : ${title}`;
                        document.getElementById('imageGalleryModal').style.display = 'flex';
                    } catch (error) {
                        console.error('Error opening gallery modal:', error);
                        alert('Erreur lors de l\'affichage de la galerie');
                    }
                }
            });

            const validateFiles = (files, maxSizeMB = 2, allowedTypes = ['image/jpeg', 'image/png', 'image/gif']) => {
                for (const file of files) {
                    if (!allowedTypes.includes(file.type)) {
                        return `Le fichier ${file.name} doit être un JPEG, PNG ou GIF.`;
                    }
                    if (file.size > maxSizeMB * 1024 * 1024) {
                        return `Le fichier ${file.name} dépasse la taille maximale de ${maxSizeMB}MB.`;
                    }
                }
                return null;
            };

            document.getElementById('addDestinationForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const fileInput = document.getElementById('addDestinationImages');
                const errorElement = document.getElementById('imagesError');
                if (fileInput.files.length > 0) {
                    const error = validateFiles(fileInput.files);
                    if (error) {
                        errorElement.textContent = error;
                        errorElement.classList.add('show');
                        return;
                    }
                }
                errorElement.classList.remove('show');

                const formData = new FormData(this);
                for (let [key, value] of formData.entries()) {
                    console.log(`FormData: ${key}`, value);
                }
                clearErrorMessages('addDestinationModal');

                try {
                    const response = await fetch("{{ route('admin.destinations.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    });

                    const data = await response.json();
                    console.log('Server response:', data);

                    if (data.status) {
                        alert('Destination ajoutée avec succès !');
                        location.reload();
                    } else {
                        displayErrors(data.errors || {}, 'addDestinationModal');
                        alert(data.message || 'Une erreur est survenue.');
                    }
                } catch (error) {
                    console.error('Error adding destination:', error);
                    alert('Erreur de connexion au serveur');
                }
            });

            document.getElementById('updateDestinationForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const fileInput = document.getElementById('destinationImages');
                const errorElement = document.getElementById('imagesError');
                if (fileInput.files.length > 0) {
                    const error = validateFiles(fileInput.files);
                    if (error) {
                        errorElement.textContent = error;
                        errorElement.classList.add('show');
                        return;
                    }
                }
                errorElement.classList.remove('show');

                const formData = new FormData(this);
                const id = document.getElementById('destinationId').value;

                try {
                    const response = await fetch(`/admin/destinations/${id}`, {
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
                        alert('Destination modifiée avec succès !');
                        location.reload();
                    } else {
                        displayErrors(data.errors || {}, 'updateDestinationModal');
                        if (!data.errors) {
                            alert(data.message || 'Une erreur est survenue.');
                        }
                    }
                } catch (error) {
                    console.error('Error updating destination:', error);
                    alert('Erreur de connexion au serveur');
                }
            });

            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', async function() {
                    if (!confirm(`Êtes-vous sûr de vouloir supprimer la destination "${this.dataset.title}" ?`)) return;

                    try {
                        const response = await fetch(`/admin/destinations/${this.dataset.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        });

                        const data = await response.json();

                        if (data.status) {
                            alert('Destination supprimée avec succès !');
                            location.reload();
                        } else {
                            alert('Erreur : ' + (data.message || 'Échec de la suppression'));
                        }
                    } catch (error) {
                        console.error('Error deleting destination:', error);
                        alert('Erreur de connexion au serveur');
                    }
                });
            });

            document.getElementById('addDestinationImages').addEventListener('change', function() {
                const previewContainer = document.getElementById('addDestinationImagesPreview');
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

            document.getElementById('destinationImages').addEventListener('change', function() {
                const previewContainer = document.getElementById('destinationImagesPreview');
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

                    if (!previewContainer.children.length) {
                        previewContainer.innerHTML = '<span class="no-images">Aucune image disponible</span>';
                    }
                }
            });

            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('mousedown', function(e) {
                    if (e.target === modal) {
                        closeModal(modal.id);
                    }
                });
            });

            ['addDestinationModal', 'updateDestinationModal', 'imageGalleryModal'].forEach(modalId => {
                document.getElementById(modalId)?.addEventListener('contextmenu', function(e) {
                    e.preventDefault();
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('destinations-table').style.display = 'block';
            });
        </script>
    </body>
</html>
