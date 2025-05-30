<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord d'administration - Utilisateurs</title>
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class="bx bxs-landscape"></i>
            <span class="text">Dor Sahara</span>
        </a>
        <ul class="side-menu top">
            <li class="active"><a href="{{ route('admin.user.index') }}"><i class="bx bxs-user"></i><span class="text">Utilisateurs</span></a></li>
            <li><a href="{{ route('admin.hotels.index') }}"><i class="bx bxs-hotel"></i><span class="text">Hôtels et appartements</span></a></li>
            <li><a href="{{ route('admin.destinations.index') }}"><i class="bx bxs-map"></i><span class="text">Destinations</span></a></li>
            <li><a href="{{ route('admin.restaurant.index') }}"><i class="bx bx-restaurant"></i><span class="text">Restaurants</span></a></li>
            <li><a href="{{ route('admin.group_touristiques.index') }}"><i class="bx bxs-group"></i><span class="text">Groupes touristiques</span></a></li>
        </ul>
        <ul class="side-menu">
            <li><a href="#"><i class="bx bxs-cog"></i><span class="text">Paramètres</span></a></li>
            <li><a href="{{ route('login') }}" class="logout"><i class="bx bxs-log-out-circle"></i><span class="text">Déconnexion</span></a></li>
        </ul>
    </section>

    <section id="content">
        <nav>
            <i class="bx bx-menu" id="menuIcon"></i>
            <a href="#" class="nav-link">Tableau de bord</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" id="navSearch" placeholder="Rechercher..." aria-label="Rechercher des utilisateurs">
                    <button type="submit" class="search-btn" aria-label="Rechercher"><i class="bx bx-search"></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden aria-label="Activer le mode sombre">
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification" id="notificationTrigger" aria-label="Voir les notifications">
                <i class="bx bxs-bell"></i>
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
                        <li>Nouvel utilisateur inscrit : Mohammed Ali</li>
                        <li>Abonnement de Fatima Zahra à l'hôtel Enchanté</li>
                        <li>Abonnement d'Ahmed Ben à la destination Merzouga</li>
                        <li>Inscription de Sara Khan</li>
                        <li>Abonnement de Youssef Omar à l'hôtel Oasis</li>
                    </ul>
                    <button class="btn-clear" onclick="clearNotifications()">Tout effacer</button>
                </div>
            </div>
        </nav>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Tableau de bord</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Tableau de bord</a></li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li><a class="active" href="#">Utilisateurs</a></li>
                    </ul>
                </div>
                <a href="#" class="btn-download" onclick="downloadPDF()"><i class="bx bxs-cloud-download"></i><span class="text">Télécharger PDF</span></a>
            </div>

            <ul class="box-info">
                <li aria-label="Utilisateur {{ $userCount }}"><i class="bx bxs-user"></i><span class="text"><h3>{{ $userCount }}</h3><p>Utilisateurs</p></span></li>
                <li aria-label="Destination 15"><i class="bx bxs-map"></i><span class="text"><h3>15</h3><p>Destinations</p></span></li>
                <li aria-label="Hôtel 12"><i class="bx bxs-hotel"></i><span class="text"><h3>12</h3><p>Hôtels</p></span></li>
                <li aria-label="Restaurant 8"><i class="bx bx-restaurant"></i><span class="text"><h3>8</h3><p>Restaurants</p></span></li>
                <li aria-label="Groupe 10"><i class="bx bxs-group"></i><span class="text"><h3>10</h3><p>Groupes touristiques</p></span></li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Liste des utilisateurs</h3>
                        <i class="bx bx-filter" data-filter="all" aria-label="Filtrer les utilisateurs"></i>
                    </div>
                    @if ($users->isEmpty())
                        <p>Aucun utilisateur trouvé.</p>
                    @else
                        <table role="grid" aria-label="Tableau de gestion des utilisateurs" id="userTable">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Paiement</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @foreach ($users as $user)
                                    <tr data-created-at="{{ $user->created_at }}">
                                        <td data-label="Nom"><p>{{ $user->name }}</p></td>
                                        <td data-label="Email">{{ $user->email }}</td>
                                        <td data-label="Téléphone">{{ $user->phone ?? 'Non disponible' }}</td>
                                        <td data-label="Statut">
                                            <span class="status {{ $user->is_admin ? 'active' : 'inactive' }}">
                                                {{ $user->is_admin ? 'Actif' : 'Inactif' }}
                                            </span>
                                        </td>
                                        <td data-label="Paiement">
                                            <span class="payment-status {{ $user->payment_method == 1 ? 'paid' : 'ended' }}">
                                                {{ $user->payment_method == 1 ? 'Payé' : 'Abonnement expiré' }}
                                            </span>
                                        </td>
                                        <td data-label="Actions">
                                            <button class="btn btn-edit user-edit" aria-label="Modifier l'utilisateur"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-phone="{{ $user->phone ?? '' }}"
                                                data-status="{{ $user->is_admin ? '1' : '0' }}"
                                                data-payment="{{ $user->payment_method == 1 ? '1' : '0' }}">
                                                <i class="bx bxs-pencil"></i>
                                            </button>
                                            <button class="btn btn-delete user-delete" aria-label="Supprimer l'utilisateur"
                                                data-id="{{ $user->id }}"
                                                data-email="{{ $user->email }}">
                                                <i class="bx bxs-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </main>

        <div class="modal" id="updateModal">
            <div class="modal-content">
                <button class="btn-close" onclick="closeModal('updateModal')" aria-label="Fermer la fenêtre">×</button>
                <h2>Modifier l'utilisateur</h2>
                <form id="updateUserForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="userId" name="id">
                    <label for="userName">Nom</label>
                    <input type="text" id="userName" name="name" required>
                    <span class="error-message" id="nameError"></span>
                    <label for="userEmailInput">Email</label>
                    <input type="email" id="userEmailInput" name="email" required>
                    <span class="error-message" id="emailError"></span>
                    <label for="userPhone">Téléphone</label>
                    <input type="tel" id="userPhone" name="phone" pattern="[0-9+\-\s\(\)]*" placeholder="Ex: +212 123 456 789">
                    <span class="error-message" id="phoneError"></span>
                    <label for="userStatus">Statut</label>
                    <select id="userStatus" name="is_admin" required aria-label="Statut de l'utilisateur">
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                    <span class="error-message" id="is_adminError"></span>
                    <label for="userPayment">Paiement</label>
                    <select id="userPayment" name="payment_method" required aria-label="Statut du paiement">
                        <option value="1">Payé</option>
                        <option value="0">Abonnement expiré</option>
                    </select>
                    <span class="error-message" id="payment_methodError"></span>
                    <div class="modal-buttons">
                        <button type="submit" class="btn btn-save" id="updateUserSubmit" aria-label="Enregistrer les modifications">Enregistrer</button>
                        <button type="button" class="btn btn-cancel" onclick="closeModal('updateModal')" aria-label="Annuler les modifications">Annuler</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
        <script src="{{ asset('js/admin/main.js') }}"></script>
        <script>
        // Initialisation du document PDF
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
            doc.text('Liste des utilisateurs', 14, 20);

            // Extraction des données du tableau
            const table = document.getElementById('userTable');
            const rows = table.querySelectorAll('tbody tr');
            const data = [];
            rows.forEach(row => {
                const rowData = [];
                const cells = row.querySelectorAll('td');
                rowData.push(cells[0].textContent.trim());
                rowData.push(cells[1].textContent.trim());
                rowData.push(cells[2].textContent.trim());
                rowData.push(cells[3].textContent.trim());
                rowData.push(cells[4].textContent.trim());
                data.push(rowData);
            });

            // Génération du tableau
            doc.autoTable({
                head: [['Nom', 'Email', 'Téléphone', 'Statut', 'Paiement']],
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
                    0: { cellWidth: 40 },
                    1: { cellWidth: 50 },
                    2: { cellWidth: 40 },
                    3: { cellWidth: 30 },
                    4: { cellWidth: 30 }
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

            doc.save('users.pdf');
        }
        </script>
    </body>
</html>
