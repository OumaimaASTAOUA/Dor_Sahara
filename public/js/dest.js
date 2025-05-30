  document.querySelectorAll('.popup-close, .groupe-popup-close, .image-zoom-close').forEach

        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('menu-btn');
            const navLinks = document.getElementById('nav-links');

            if (!menuBtn) {
                console.error("Erreur : Élément avec id='menu-btn' introuvable.");
                return;
            }
            if (!navLinks) {
                console.error("Erreur : Élément avec id='nav-links' introuvable.");
                return;
            }

            menuBtn.addEventListener('click', () => {
                try {
                    const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
                    menuBtn.setAttribute('aria-expanded', !isExpanded);
                    navLinks.classList.toggle('active');
                    const icon = menuBtn.querySelector('i');
                    icon.classList.toggle('ri-menu-3-line');
                    icon.classList.toggle('ri-close-line');
                    console.log(`Menu basculé. Actif : ${navLinks.classList.contains('active')}`);
                } catch (error) {
                    console.error('Erreur lors du basculement du menu :', error);
                }
            });

            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('active');
                    menuBtn.setAttribute('aria-expanded', 'false');
                    const icon = menuBtn.querySelector('i');
                    icon.classList.add('ri-menu-3-line');
                    icon.classList.remove('ri-close-line');
                    console.log('Menu fermé après clic sur un lien.');
                });
            });

            

            const swiper = new Swiper('.swiper', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            const zoomableImages = document.querySelectorAll('.zoomable-image');
            const imageZoomPopup = document.getElementById('image-zoom-popup');
            const zoomedImage = document.getElementById('zoomed-image');
            const imageZoomClose = document.getElementById('image-zoom-close');

            function attachZoomListeners(images) {
                images.forEach(image => {
                    image.addEventListener('click', () => {
                        zoomedImage.src = image.src;
                        imageZoomPopup.classList.add('active');
                    });
                });
            }

            attachZoomListeners(zoomableImages);

            imageZoomClose.addEventListener('click', () => {
                imageZoomPopup.classList.remove('active');
            });

            imageZoomPopup.addEventListener('click', (e) => {
                if (e.target === imageZoomPopup) {
                    imageZoomPopup.classList.remove('active');
                }
            });

            const destinationPopup = document.getElementById('destination-popup');
            const destinationPopupBody = document.getElementById('destination-popup-body');
            const destinationPopupClose = document.getElementById('destination-popup-close');
            const destinationDetailsButtons = document.querySelectorAll('.destination-details-btn');

            destinationDetailsButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const destinationId = button.getAttribute('data-destination-id');
                    const destination = destinations.find(d => d.id == destinationId);
                    if (destination) {
                        const mapUrl = `https://www.google.com/maps/embed/v1/place?${destination.map_query || 'q=Laayoune,Morocco'}&language=fr`;
                        destinationPopupBody.innerHTML = `
                            <h2>${destination.title}</h2>
                            <div class="popup-gallery">
                                ${destination.images.length ? destination.images.map(img => `
                                    <img src="${img}" alt="Image de ${destination.title}" class="zoomable-image">
                                `).join('') : `
                                    <img src="https://via.placeholder.com/200" alt="Image non disponible" class="zoomable-image">
                                `}
                            </div>
                            <div class="popup-details">
                                <p><strong>Description :</strong> ${destination.description || 'Aucune description disponible.'}</p>
                            </div>
                            <div class="popup-map">
                                <iframe src="${mapUrl}" allowfullscreen loading="lazy" aria-label="Carte de ${destination.title}" onerror="this.parentElement.classList.add('error')"></iframe>
                            </div>
                            <a href="https://wa.me/212600000000?text=Bonjour, je souhaite en savoir plus sur ${encodeURIComponent(destination.title)}" class="book-btn" target="_blank" aria-label="Contacter via WhatsApp pour ${destination.title}">Contacter via WhatsApp</a>
                        `;
                        destinationPopup.classList.add('active');
                        attachZoomListeners(destinationPopupBody.querySelectorAll('.zoomable-image'));

                        const iframe = destinationPopupBody.querySelector('.popup-map iframe');
                        iframe.addEventListener('load', () => {
                            if (!iframe.contentWindow.document.body.innerHTML) {
                                iframe.parentElement.classList.add('error');
                            }
                        });
                    }
                });
            });

            destinationPopupClose.addEventListener('click', () => {
                destinationPopup.classList.remove('active');
            });

            destinationPopup.addEventListener('click', (e) => {
                if (e.target === destinationPopup) {
                    destinationPopup.classList.remove('active');
                }
            });

            const groupePopup = document.getElementById('groupe-popup');
            const groupePopupBody = document.getElementById('groupe-popup-body');
            const groupePopupClose = document.getElementById('groupe-popup-close');
            const groupeDetailsButtons = document.querySelectorAll('.groupe-details-btn');

            groupeDetailsButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const groupeId = button.getAttribute('data-groupe-id');
                    const groupe = groups.find(g => g.id == groupeId);
                    if (groupe) {
                        const caravanName = JSON.parse(groupe.caravan_name || '{"fr": "Inconnu"}').fr;
                        const socialLinks = groupe.social_media_links || {};
                        groupePopupBody.innerHTML = `
                            <h2>${groupe.title}</h2>
                            <div class="groupe-popup-gallery">
                                ${groupe.images && groupe.images.length ? groupe.images.map(img => `
                                    <img src="${img}" alt="Image de ${groupe.title}" class="zoomable-image">
                                `).join('') : `
                                    <img src="https://via.placeholder.com/200" alt="Image non disponible" class="zoomable-image">
                                `}
                            </div>
                            <div class="groupe-popup-details">
                                <p><strong>Description :</strong> ${groupe.description || 'Aucune description disponible.'}</p>
                                <div class="detail-item">
                                    <i class="far fa-clock"></i>
                                    <span><strong>Durée :</strong> ${groupe.duration}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-users"></i>
                                    <span><strong>Participants :</strong> ${groupe.max_people} personnes</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><strong>Départ :</strong> ${groupe.starting_point}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span><strong>Prix :</strong> ${groupe.price} DH par personne</span>
                                </div>
                            </div>
                            <div class="caravan-info">
                            <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png"alt="Logo de la caravane" class="caravan-logo">
                                <div class="caravan-details">
                                    <h4 class="caravan-name">${caravanName}</h4>
                                    <div class="groupe-popup-social">
                                        ${socialLinks.facebook ? `
                                            <a href="${socialLinks.facebook}" target="_blank" aria-label="Page Facebook de ${groupe.title}">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        ` : ''}
                                        ${socialLinks.instagram ? `
                                            <a href="${socialLinks.instagram}" target="_blank" aria-label="Page Instagram de ${groupe.title}">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                            <a href="https://wa.me/212600000000?text=Bonjour, je souhaite réserver ${encodeURIComponent(groupe.title)}" class="book-btn" target="_blank" aria-label="Réserver ${groupe.title} via WhatsApp">Réserver maintenant</a>
                        `;
                        groupePopup.classList.add('active');
                        attachZoomListeners(groupePopupBody.querySelectorAll('.zoomable-image'));
                    }
                });
            });

            groupePopupClose.addEventListener('click', () => {
                groupePopup.classList.remove('active');
            });

            groupePopup.addEventListener('click', (e) => {
                if (e.target === groupePopup) {
                    groupePopup.classList.remove('active');
                }
            });
        });
