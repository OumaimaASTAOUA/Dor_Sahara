document.addEventListener('DOMContentLoaded', () => {
    console.log('Main.js chargé');

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        console.error('Token CSRF introuvable');
    }

    const modals = [
        'addDestinationModal',
        'updateDestinationModal',
        'addModal',
        'updateModal',
        'addMenuModal',
        'updateMenuModal',
        'addGroupModal',
        'updateGroupModal',
        'addHotelModal',
        'updateHotelModal',
        'addApartmentModal',
        'updateApartmentModal',
        'linkPopupModal',
        'viewImagesModal',
        'viewLinksModal'
    ];
    modals.forEach(id => {
        const modal = document.getElementById(id);
        if (modal) {
            modal.style.display = 'none';
            console.log(`Modale ${id} initialisée`);
        } else {
            console.warn(`Modale ${id} non trouvée`);
        }
    });

    // Gestion de la barre latérale
    const sidebar = document.getElementById('sidebar');
    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
    allSideMenu.forEach(item => {
        item.addEventListener('click', () => {
            allSideMenu.forEach(i => i.parentElement.classList.remove('active'));
            item.parentElement.classList.add('active');
        });
    });

    // Bascule de la barre latérale
    const menuBar = document.querySelector('#content nav .bx.bx-menu');
    if (menuBar && sidebar) {
        menuBar.addEventListener('click', () => {
            sidebar.classList.toggle('hide');
        });
    }

    // Bascule du formulaire de recherche (mobile)
    const searchButton = document.querySelector('#content nav form .form-input button');
    const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
    const searchForm = document.querySelector('#content nav form');
    if (searchButton && searchButtonIcon && searchForm) {
        searchButton.addEventListener('click', e => {
            if (window.innerWidth < 576) {
                e.preventDefault();
                searchForm.classList.toggle('show');
                searchButtonIcon.classList.replace(
                    searchForm.classList.contains('show') ? 'bx-search' : 'bx-x',
                    searchForm.classList.contains('show') ? 'bx-x' : 'bx-search'
                );
            }
        });
    }

    // Adaptation responsive
    if (window.innerWidth < 768) {
        sidebar?.classList.add('hide');
    } else if (window.innerWidth > 576 && searchButtonIcon && searchForm) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth > 576 && searchButtonIcon && searchForm) {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });

    // Bascule du mode sombre
    const switchMode = document.getElementById('switch-mode');
    if (switchMode) {
        switchMode.addEventListener('change', () => {
            document.body.classList.toggle('dark', switchMode.checked);
        });
    }

    // Profile Popup
    const profileImg = document.querySelector('#content nav .profile img');
    const profilePopup = document.getElementById('profilePopup');
    if (profileImg && profilePopup) {
        profileImg.addEventListener('click', e => {
            e.stopPropagation();
            profilePopup.style.display = profilePopup.style.display === 'block' ? 'none' : 'block';
        });
    }

    // Notification Popup
    const notificationIcon = document.querySelector('#content nav .notification');
    const notificationPopup = document.getElementById('notificationPopup');
    const notificationList = document.querySelector('.notification-list');
    const notificationCount = document.querySelector('#content nav .notification .num');
    const clearBtn = document.querySelector('.btn-clear');

    const fetchNotifications = async () => {
        try {
            const response = await fetch('/admin/notifications/new-users', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            const data = await response.json();
            if (response.ok && data.users) {
                notificationList.innerHTML = '';
                if (data.users.length === 0) {
                    notificationList.innerHTML = '<li>Aucune nouvelle inscription</li>';
                    notificationCount.style.display = 'none';
                } else {
                    data.users.forEach(user => {
                        const li = document.createElement('li');
                        li.textContent = `Nouvel utilisateur inscrit : ${user.name}`;
                        notificationList.appendChild(li);
                    });
                    notificationCount.textContent = data.users.length;
                    notificationCount.style.display = 'block';
                }
            } else {
                console.error('Erreur lors du chargement des notifications:', data.message);
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    };

    if (notificationIcon && notificationPopup) {
        notificationIcon.addEventListener('click', e => {
            e.stopPropagation();
            notificationPopup.style.display = notificationPopup.style.display === 'block' ? 'none' : 'block';
            if (notificationPopup.style.display === 'block') {
                fetchNotifications();
            }
        });
    }

    if (clearBtn && notificationCount) {
        clearBtn.addEventListener('click', () => {
            notificationList.innerHTML = '<li>Aucune notification</li>';
            notificationCount.style.display = 'none';
            notificationPopup.style.display = 'none';
        });
    }

    // PDF Download
    const downloadBtn = document.querySelector('.btn-download');
    if (downloadBtn && typeof jsPDF !== 'undefined') {
        downloadBtn.addEventListener('click', e => {
            e.preventDefault();
            const { jsPDF } = window;
            const doc = new jsPDF();
            doc.setFontSize(16);
            doc.text('Liste des Utilisateurs', 20, 20);
            doc.setFontSize(12);
            const table = document.querySelector('#userTableBody');
            const rows = table.querySelectorAll('tr');
            const headers = ['Nom', 'Email', 'Téléphone', 'Statut', 'Paiement'];
            doc.autoTable({
                startY: 30,
                head: [headers],
                body: Array.from(rows).map(row => {
                    const cells = row.querySelectorAll('td');
                    return [
                        cells[0]?.querySelector('p')?.textContent || '',
                        cells[1]?.textContent || '',
                        cells[2]?.textContent || '',
                        cells[3]?.querySelector('.status')?.textContent || '',
                        cells[4]?.querySelector('.payment-status')?.textContent || ''
                    ];
                }),
                theme: 'grid',
                headStyles: { fillColor: [60, 145, 230] },
                styles: { fontSize: 10, cellPadding: 2 }
            });
            doc.save('utilisateurs.pdf');
        });
    }

    // Fermer les popups
    document.addEventListener('click', e => {
        if (profilePopup && !profileImg?.contains(e.target) && !profilePopup.contains(e.target)) {
            profilePopup.style.display = 'none';
        }
        if (notificationPopup && !notificationIcon?.contains(e.target) && !notificationPopup.contains(e.target)) {
            notificationPopup.style.display = 'none';
        }
        modals.forEach(id => {
            const modal = document.getElementById(id);
            if (modal && e.target === modal) {
                modal.style.display = 'none';
                if (sidebar) sidebar.classList.remove('hide');
            }
        });
    });

    // Gestion des modales
    document.querySelectorAll('.btn-cancel, .btn-close').forEach(button => {
        button.addEventListener('click', () => {
            modals.forEach(id => {
                const modal = document.getElementById(id);
                if (modal) {
                    modal.style.display = 'none';
                    const form = modal.querySelector('form');
                    if (form) form.reset();
                }
            });
            if (sidebar) sidebar.classList.remove('hide');
        });
    });

    // Gestion des boutons d'édition
    const editButtons = document.querySelectorAll('.user-edit');
    const updateModal = document.getElementById('updateModal');
    const updateUserForm = document.getElementById('updateUserForm');

    if (editButtons && updateModal && updateUserForm && csrfToken) {
        editButtons.forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const userId = button.getAttribute('data-id');
                const userName = button.getAttribute('data-name');
                const userEmail = button.getAttribute('data-email');
                const userPhone = button.getAttribute('data-phone');
                const userStatus = button.getAttribute('data-status');
                const userPayment = button.getAttribute('data-payment');

                document.getElementById('userId').value = userId;
                document.getElementById('userName').value = userName;
                document.getElementById('userEmailInput').value = userEmail;
                document.getElementById('userPhone').value = userPhone || '';
                document.getElementById('userStatus').value = userStatus;
                document.getElementById('userPayment').value = userPayment;

                updateModal.style.display = 'block';
                console.log('Modal opened for user:', userId);
            });
        });

        updateUserForm.addEventListener('submit', async e => {
            e.preventDefault();
            const userId = document.getElementById('userId').value;
            const formData = new FormData(updateUserForm);
            formData.append('_method', 'PUT');

            try {
                const response = await fetch(`/admin/users/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });

                const result = await response.json();
                if (response.ok) {
                    alert('Utilisateur mis à jour avec succès');
                    updateModal.style.display = 'none';
                    window.location.reload();
                } else {
                    console.error('Validation errors:', result.errors);
                    ['name', 'email', 'phone', 'is_admin', 'payment_method'].forEach(key => {
                        const errorSpan = document.getElementById(`${key}Error`);
                        if (errorSpan) {
                            errorSpan.textContent = result.errors && result.errors[key] ? result.errors[key][0] : '';
                        }
                    });
                }
            } catch (error) {
                console.error('Network error:', error);
                alert('Erreur réseau. Vérifiez votre connexion et réessayez.');
            }
        });
    } else {
        console.error('Missing elements or CSRF token:', { editButtons, updateModal, updateUserForm, csrfToken });
    }

    // Gestion des boutons de suppression
    const deleteButtons = document.querySelectorAll('.user-delete');
    if (deleteButtons && csrfToken) {
        deleteButtons.forEach(button => {
            button.addEventListener('click', async e => {
                e.preventDefault();
                const userId = button.getAttribute('data-id');
                const userEmail = button.getAttribute('data-email');

                if (confirm(`Voulez-vous vraiment supprimer l'utilisateur ${userEmail} ?`)) {
                    try {
                        const response = await fetch(`/admin/users/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        const result = await response.json();
                        if (response.ok && result.status) {
                            alert(result.message);
                            const row = button.closest('tr');
                            if (row) {
                                row.remove();
                            }
                            const userCountElement = document.querySelector('.box-info li:first-child .text h3');
                            if (userCountElement) {
                                const currentCount = parseInt(userCountElement.textContent);
                                userCountElement.textContent = currentCount - 1;
                            }
                        } else {
                            console.error('Erreur de suppression:', result.message);
                            alert(result.message || 'Erreur lors de la suppression de l\'utilisateur.');
                        }
                    } catch (error) {
                        console.error('Erreur réseau:', error);
                        alert('Erreur réseau. Vérifiez votre connexion et réessayez.');
                    }
                }
            });
        });
    } else {
        console.error('Missing delete buttons or CSRF token:', { deleteButtons, csrfToken });
    }
});
