<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swiper/3.0.0/css/swiper.min.css">
    <link rel="stylesheet" href="{{ asset('css/rest.css') }}">
    <title>FoodSahara | Nos Restaurants à Laâyoune</title>
    <style>
        :root {
            --primary-color: #ffa03f;
            --primary-color: #e08b37;
            color: #e0e0;
            --text-dark: #020617;
            --text-light: #1e293b;
            color: #1e293;
            --extra-light: #f3f4f6;
            --white: #ffffff;
            --max-width: 1200px;
        }

        body {
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
        }

        .section__container {
            max-width: var(--max-width);
            margin: auto;
            padding: 5rem 1rem;
        }

        .section__header {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .section__description {
            font-size: 1rem;
            color: var(--text-light);
            text-align: center;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            outline: none;
            border: none;
            font-size: 1rem;
            color: var(--white);
            background-color: var(--primary-color);
            border-radius: 5px;
            cursor: pointer;
            transition: background-color: 0.3s;
        }

        .btn:hover {
            background-color: var(--primary-color-dark);
        }

        .details__btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            color: var(--primary-color);
            background-color: var(--white);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            cursor: pointer;
            max-width: 200px;
            width: 100%;
            text-align: center;
            margin: 0 auto 1rem;
            display: block;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
        }

        .details__btn:hover {
            background-color: var(--primary-color);
            color: var(--white);
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .filter__container {
            padding: 4rem 1rem;
        }

        .filter__bar {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .filter__btn {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-dark);
            background-color: var(--extra-light);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            min-width: 120px;
            text-align: center;
        }

        .filter__btn.active,
        .filter__btn:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .restaurants__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .restaurant__card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .restaurant__card:hover {
            transform: translateY(-5px);
        }

        .restaurant__card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .restaurant__card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            margin: 1rem;
        }

        .restaurant__card p {
            font-size: 0.9rem;
            color: var(--text-light);
            margin: 0 1rem 1rem;
            line-height: 1.4;
        }

        /* Menu Popup */
        .menu-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            padding: 20px;
            transition: opacity 0.3s ease-in-out;
        }
        .menu-popup.active {
            display: flex;
            opacity: 1;
        }
        .menu-popup__content {
            background: var(--white);
            border-radius: 16px;
            max-width: 900px;
            width: 95%;
            padding: 30px;
            position: relative;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            max-height: 85vh;
            overflow-y: auto;
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .menu-popup__close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        .menu-popup__close:hover {
            background: var(--primary-color-dark);
            transform: rotate(90deg);
        }
        .menu-popup__close i {
            font-size: 1.5rem;
        }
        .menu-popup__header {
            text-align: center;
            margin-bottom: 25px;
        }
        .menu-popup__header h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }
        .menu-popup__header p {
            font-size: 16px;
            color: var(--text-light);
            margin: 8px 0 0;
        }
        .menu-popup__items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        .menu-item {
            background: var(--extra-light);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .menu-item img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .menu-item h4 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0 0 8px;
        }
        .menu-item p {
            font-size: 14px;
            color: var(--text-light);
            margin: 0 0 12px;
            line-height: 1.5;
        }
        .menu-item .price {
            font-size: 18px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        .menu-item .add-to-cart {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-color-dark));
            color: var(--white);
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 15px;
            transition: background 0.3s, transform 0.2s;
        }
        .menu-item .add-to-cart:hover {
            background: linear-gradient(135deg, var(--primary-color-dark), var(--primary-color));
            transform: scale(1.05);
        }
        .menu-item .add-to-cart i {
            font-size: 18px;
        }

        /* Cart Summary */
        .cart-items {
            border-top: 2px solid var(--extra-light);
            padding-top: 25px;
            margin-top: 25px;
        }
        .cart-items h3 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 20px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--extra-light);
        }
        .cart-item span {
            font-size: 15px;
            color: var(--text-dark);
        }
        .cart-item .quantity {
            font-weight: bold;
            color: var(--primary-color);
        }
        .cart-item .restaurant-name {
            font-size: 13px;
            color: var(--text-light);
        }
        .cart-item .remove-item {
            background: #e74c3c;
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 13px;
            transition: background 0.3s;
        }
        .cart-item .remove-item:hover {
            background: #c0392b;
        }
        .cart-item .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cart-item .quantity-controls button {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        .cart-item .quantity-controls button:hover {
            background: var(--primary-color-dark);
        }
        .cart-total {
            font-size: 18px;
            font-weight: bold;
            color: var(--text-dark);
            margin: 20px 0;
            text-align: right;
        }
        .cart-actions {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }
        .clear-cart {
            background: #7f8c8d;
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            transition: background 0.3s;
        }
        .clear-cart:hover {
            background: #6c757d;
        }
        .place-order {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: var(--white);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s, transform 0.2s;
        }
        .place-order:hover {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            transform: scale(1.05);
        }

        /* Cart Sidebar */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background: var(--white);
            box-shadow: -4px 0 12px rgba(0, 0, 0, 0.2);
            z-index: 1100;
            transition: right 0.4s ease-in-out;
            padding: 30px;
            overflow-y: auto;
        }
        .cart-sidebar.open {
            right: 0;
        }
        .cart-sidebar__close {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: absolute;
            top: 15px;
            right: 15px;
            transition: background 0.3s, transform 0.2s;
        }
        .cart-sidebar__close:hover {
            background: var(--primary-color-dark);
            transform: rotate(90deg);
        }
        .cart-sidebar h2 {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 25px;
        }
        .cart-sidebar__items {
            margin-bottom: 25px;
        }
        .cart-sidebar__item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--extra-light);
        }
        .cart-sidebar__item span {
            font-size: 15px;
            color: var(--text-dark);
        }
        .cart-sidebar__item .quantity {
            font-weight: bold;
            color: var(--primary-color);
        }
        .cart-sidebar__item .restaurant-name {
            font-size: 13px;
            color: var(--text-light);
        }
        .cart-sidebar__item .remove-item {
            background: #e74c3c;
            color: var(--white);
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 13px;
            transition: background 0.3s;
        }
        .cart-sidebar__item .remove-item:hover {
            background: #c0392b;
        }
        .cart-sidebar__item .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cart-sidebar__item .quantity-controls button {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        .cart-sidebar__item .quantity-controls button:hover {
            background: var(--primary-color-dark);
        }
        .cart-sidebar__total {
            font-size: 18px;
            font-weight: bold;
            color: var(--text-dark);
            margin: 20px 0;
            text-align: right;
        }
        .cart-sidebar__order-items {
            background: var(--extra-light);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            color: var(--text-dark);
        }
        .cart-sidebar__order-items h4 {
            margin: 0 0 12px;
            font-size: 18px;
            color: var(--text-dark);
        }
        .cart-sidebar__order-items p {
            margin: 6px 0;
        }
        .cart-sidebar__checkout {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: var(--white);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 0 auto;
            transition: background 0.3s, transform 0.2s;
        }
        .cart-sidebar__checkout:hover {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            transform: scale(1.05);
        }

        /* Comments Section */
        .comments-section {
            border-top: 2px solid var(--extra-light);
            padding-top: 25px;
            margin-top: 25px;
        }
        .comments-section h3 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 20px;
        }
        .comment-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }
        .comment-form textarea {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            border: 1px solid var(--extra-light);
            border-radius: 8px;
            font-size: 15px;
            color: var(--text-dark);
            resize: vertical;
            transition: border-color 0.3s;
        }
        .comment-form textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        .comment-form button {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            align-self: flex-start;
            transition: background 0.3s, transform 0.2s;
        }
        .comment-form button:hover {
            background: var(--primary-color-dark);
            transform: scale(1.05);
        }
        .comments-list {
            background: var(--extra-light);
            padding: 20px;
            border-radius: 12px;
        }
        .comment {
            padding: 12px 0;
            border-bottom: 1px solid var(--extra-light);
        }
        .comment:last-child {
            border-bottom: none;
        }
        .comment p {
            margin: 0;
            font-size: 15px;
            color: var(--text-dark);
            line-height: 1.5;
        }
        .comment .user {
            font-weight: bold;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-size: 16px;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: var(--white);
            padding: 15px 30px;
            border-radius: 10px;
            z-index: 2000;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            font-size: 15px;
        }
        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Nav Buttons */
        .nav__btn {
            position: relative;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .cart-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #e74c3c;
            color: var(--white);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        .home-btn {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .home-btn:hover {
            background: var(--primary-color-dark);
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .restaurants__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 768px) {
            .cart-sidebar {
                width: 100%;
                right: -100%;
            }
            .cart-sidebar.open {
                right: 0;
            }
            .restaurants__grid {
                grid-template-columns: 1fr;
            }
            .filter__bar {
                flex-direction: column;
                align-items: center;
            }
            .filter__btn {
                width: 100%;
                max-width: 200px;
            }
            .menu-popup__content {
                padding: 20px;
                width: 95%;
            }
            .menu-popup__header h2 {
                font-size: 24px;
            }
            .menu-popup__items {
                grid-template-columns: 1fr;
            }
            .menu-item img {
                height: 120px;
            }
            .cart-item span, .cart-sidebar__item span {
                font-size: 14px;
            }
            .cart-actions {
                flex-direction: column;
            }
            .clear-cart, .place-order {
                width: 100%;
                text-align: center;
            }
        }
        @media (max-width: 600px) {
            .menu-popup__header h2 {
                font-size: 20px;
            }
            .menu-item h4 {
                font-size: 18px;
            }
            .menu-item .price {
                font-size: 16px;
            }
            .cart-sidebar__item .quantity-controls button {
                width: 24px;
                height: 24px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav__header">
            <div class="logo nav__logo">
                <a href="{{ route('home') }}">Food<span>Sahara</span></a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <span><i class="ri-menu-line"></i></span>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="#home">Accueil</a></li>
            <li><a href="#restaurants">Restaurants</a></li>
            <li><a href="#chef">Chefs</a></li>
            <li><a href="#client">Clients</a></li>
            <li><a href="#contact">Contactez-nous</a></li>
        </ul>
        <div class="nav__btn">
            <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="home-btn" title="Tableau de bord">
                <i class="ri-home-line"></i>
            </a>
            <button class="btn" id="cartButton" aria-label="Voir le panier">
                <i class="ri-shopping-cart-fill"></i>
                <span class="cart-badge" id="cartBadge">0</span>
            </button>
        </div>
    </nav>

    <header class="section__container header__container" id="home">
        <div class="header__image">
            <img src="{{ asset('images/header.png') }}" alt="En-tête" loading="lazy">
        </div>
        <div class="header__content">
            <h1>Découvrez les Saveurs Authentiques de <span>Laâyoune</span></h1>
            <p class="section__description">
                Plongez dans une expérience culinaire unique à Laâyoune Saguia el-Hamra, où les traditions sahariennes rencontrent des saveurs modernes pour ravir vos papilles.
            </p>
            <div class="header__btn">
                <button class="btn">Explorez Maintenant</button>
            </div>
        </div>
    </header>

    <section class="section__container filter__container" id="restaurants">
        <h2 class="section__header">Nos Restaurants à Laâyoune</h2>
        <p class="section__description">
            Explorez les meilleurs restaurants de Laâyoune, offrant une variété de plats sahariens et internationaux. Filtrez par catégorie pour découvrir les spécialités locales.
        </p>

        <div class="filter__bar">
            <button class="filter__btn active" data-filter="all" aria-label="Afficher tous les restaurants">Tous</button>
            @foreach ($categories as $category)
                <button class="filter__btn" data-filter="{{ $category->slug }}" aria-label="Filtrer par {{ $category->name }}">{{ $category->name }}</button>
            @endforeach
        </div>

        <div class="restaurants__grid" data-filter="all">
            @forelse ($restaurants as $restaurant)
                @php
                    $imagePath = $restaurant->image ? 'restaurants/' . $restaurant->image : null;
                    $imageExists = $imagePath && Storage::disk('public')->exists($imagePath);
                @endphp
                <div class="restaurant__card"
                     data-category="{{ $restaurant->category->slug ?? 'unknown' }}"
                     data-restaurant="{{ $restaurant->name }}"
                     data-id="{{ $restaurant->id }}"
                     data-description="{{ $restaurant->description }}"
                     data-image="{{ $imageExists ? asset('storage/' . $imagePath) : asset('images/default-restaurant.jpg') }}"
                     data-menus='@json($restaurant->menus)'>
                    <img src="{{ $imageExists ? asset('storage/' . $imagePath) : asset('images/default-restaurant.jpg') }}" alt="{{ $restaurant->name }}" loading="lazy">
                    <h3>{{ $restaurant->name }}</h3>
                    <p>{{ $restaurant->description ?? 'Aucune description disponible.' }}</p>
                    <button class="details__btn" data-id="{{ $restaurant->id }}">Détails</button>
                </div>
            @empty
                <p class="section__description">Aucun restaurant trouvé à Laâyoune.</p>
            @endforelse
        </div>

        <!-- Menu Popup -->
        <div class="menu-popup" id="menuPopup">
            <div class="menu-popup__content">
                <button class="menu-popup__close" aria-label="Fermer la fenêtre">
                    <i class="ri-close-line"></i>
                </button>
                <div class="menu-popup__header">
                    <h2 id="popupRestaurantName"></h2>
                    <p id="popupRestaurantCategory"></p>
                </div>
                <div class="menu-popup__items" id="popupMenuItems"></div>
                <div class="cart-summary" id="cartSummary">
                    <h3>Votre Panier</h3>
                    <div class="cart-order-summary" id="cartOrderSummary"></div>
                    <div id="cartItems"></div>
                    <div class="cart-total" id="cartTotal">Total : 0,00 MAD</div>
                    <div class="cart-actions">
                        <button class="clear-cart">Vider le Panier</button>
                    </div>
                </div>
                <!-- Comments Section -->
                <div class="comments-section" id="commentsSection">
                    <h3>Commentaires</h3>
                    <div class="comment-form">
                        <textarea id="commentInput" placeholder="Ajoutez votre commentaire..." required></textarea>
                        <button id="submitComment">Ajouter Commentaire</button>
                    </div>
                    <div class="comments-list" id="commentsList"></div>
                </div>
            </div>
        </div>

        <!-- Cart Sidebar -->
        <div class="cart-sidebar" id="cartSidebar">
            <button class="cart-sidebar__close" aria-label="Fermer le panier">
                <i class="ri-close-line"></i>
            </button>
            <h2>Votre Panier</h2>
            <div class="cart-sidebar__order-summary" id="cartSidebarOrderSummary"></div>
            <div class="cart-sidebar__items" id="cartSidebarItems"></div>
            <div class="cart-sidebar__total" id="cartSidebarTotal">Total : 0,00 MAD</div>
            <button class="cart-sidebar__checkout">Passer la Commande</button>
        </div>

        <!-- Notification -->
        <div class="notification" id="notification">Article ajouté au panier !</div>
    </section>

    <section class="section__container explore__container">
        <div class="explore__image">
            <img src="{{ asset('images/explore.png') }}" alt="Exploration" loading="lazy">
        </div>
        <div class="explore__content">
            <h1 class="section__header">Cuisine Saharienne Authentique et Savoureuse</h1>
            <p class="section__description">
                Découvrez les délices de Laâyoune avec des plats qui allient traditions sahariennes et ingrédients frais. Chaque bouchée est une célébration de la culture locale.
            </p>
            <div class="explore__btn">
                <button class="btn">
                    Découvrez Notre Histoire <span><i class="ri-arrow-right-line"></i></span>
                </button>
            </div>
        </div>
    </section>

    <section class="section__container banner__container">
        <div class="banner__card">
            <span class="banner__icon"><i class="ri-bowl-fill"></i></span>
            <h4>Commandez Votre Repas</h4>
            <p>
                Commandez facilement vos plats préférés à Laâyoune en quelques clics, et savourez les saveurs du Sahara directement chez vous.
            </p>
            <a href="#">
                En savoir plus
                <span><i class="ri-arrow-right-line"></i></span>
            </a>
        </div>
        <div class="banner__card">
            <span class="banner__icon"><i class="ri-truck-fill"></i></span>
            <h4>Choisissez Votre Repas</h4>
            <p>
                Explorez une variété de plats sahariens et marocains pour satisfaire toutes vos envies, du tajine traditionnel aux desserts locaux.
            </p>
            <a href="#">
                En savoir plus
                <span><i class="ri-arrow-right-line"></i></span>
            </a>
        </div>
        <div class="banner__card">
            <span class="banner__icon"><i class="ri-star-smile-fill"></i></span>
            <h4>Savourez Votre Repas</h4>
            <p>
                Profitez d’une expérience culinaire unique avec des plats préparés avec soin, livrés directement à votre porte à Laâyoune.
            </p>
            <a href="#">
                En savoir plus
                <span><i class="ri-arrow-right-line"></i></span>
            </a>
        </div>
    </section>

    <section class="chef" id="chef">
        <img src="{{ asset('images/topping.png') }}" alt="Garnitures" class="chef__bg" loading="lazy">
        <div class="section__container chef__container">
            <div class="chef__image">
                <img src="{{ asset('images/chef.png') }}" alt="Chef" loading="lazy">
            </div>
            <div class="chef__content">
                <h2 class="section__header">Préparé par les Meilleurs Chefs de Laâyoune</h2>
                <p class="section__description">
                    Nos chefs locaux à Laâyoune allient savoir-faire traditionnel et créativité pour offrir des plats sahariens et marocains d’exception.
                </p>
                <ul class="chef__list">
                    <li><span><i class="ri-checkbox-fill"></i></span> Saveurs authentiques inspirées du patrimoine saharien.</li>
                    <li><span><i class="ri-checkbox-fill"></i></span> Ingrédients frais et locaux pour une qualité inégalée.</li>
                    <li><span><i class="ri-checkbox-fill"></i></span> Passion pour l’excellence culinaire à chaque plat.</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section__container client__container" id="client">
        <h2 class="section__header">Ce que Disent Nos Clients à Laâyoune</h2>
        <p class="section__description">
            Écoutez les témoignages de nos clients à Laâyoune, qui partagent leur amour pour nos plats savoureux et notre service exceptionnel.
        </p>
        <div class="client__swiper">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="client__card">
                            <p>FoodSahara m’a fait redécouvrir les saveurs sahariennes ! Les plats sont délicieux et reflètent l’âme de Laâyoune.</p>
                            <img src="{{ asset('images/client-1.jpg') }}" alt="Client" loading="lazy">
                            <h4>Hassan Benali</h4>
                            <h5>Commerçant Local</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client__card">
                            <p>Un service rapide et des plats qui rappellent les recettes de ma grand-mère. FoodSahara est mon choix préféré à Laâyoune !</p>
                            <img src="{{ asset('images/client-2.jpg') }}" alt="Client" loading="lazy">
                            <h4>Fatima Zahra</h4>
                            <h5>Enseignante</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client__card">
                            <p>Pour chaque événement, je fais confiance à FoodSahara. Leur attention aux détails fait toute la différence.</p>
                            <img src="{{ asset('images/client-3.jpg') }}" alt="Client" loading="lazy">
                            <h4>Mohammed El Khattabi</h4>
                            <h5>Organisateur d’Événements</h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <footer class="footer" id="contact">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="logo footer__logo">
                    <a href="{{ route('home') }}">Food<span>Sahara</span></a>
                </div>
                <p class="section__description">
                    FoodSahara vous invite à savourer l’essence de Laâyoune, où chaque plat célèbre les traditions et les saveurs du Sahara.
                </p>
            </div>
            <div class="footer__col">
                <h4>Produits</h4>
                <ul class="footer__links">
                    <li><a href="#">Menu Saharien</a></li>
                    <li><a href="#">Offres Spéciales</a></li>
                    <li><a href="#">Plats Marocains</a></li>
                    <li><a href="#">Options de Traiteur</a></li>
                    <li><a href="#">Desserts Locaux</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Informations</h4>
                <ul class="footer__links">
                    <li><a href="#">À Propos</a></li>
                    <li><a href="#">Contactez-nous à Laâyoune</a></li>
                    <li><a href="#">Informations Nutritionnelles</a></li>
                    <li><a href="#">Informations sur les Allergènes</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Entreprise</h4>
                <ul class="footer__links">
                    <li><a href="#">Notre Histoire à Laâyoune</a></li>
                    <li><a href="#">Carrières</a></li>
                    <li><a href="#">Conditions d'Utilisation</a></li>
                    <li><a href="#">Politique de Confidentialité</a></li>
                </ul>
            </div>
        </div>
        <div class="footer__bar">
            Copyright © 2025 FoodSahara, Laâyoune. Tous droits réservés.
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/rest.js') }}"></script>
    <script>
        // Cart management
        let cart = [];

        // Load cart from localStorage
        function loadCart() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
                updateCartDisplay();
            }
        }

        // Save cart to localStorage
        function saveCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Update cart display
        function updateCartDisplay() {
            const cartItems = document.getElementById('cartItems');
            const cartSidebarItems = document.getElementById('cartSidebarItems');
            const cartBadge = document.getElementById('cartBadge');
            const cartTotal = document.getElementById('cartTotal');
            const cartSidebarTotal = document.getElementById('cartSidebarTotal');

            cartItems.innerHTML = '';
            cartSidebarItems.innerHTML = '';
            let total = 0;
            let itemCount = 0;

            cart.forEach((item, index) => {
                const subtotal = item.price * item.quantity;
                total += subtotal;
                itemCount += item.quantity;

                // Popup cart items
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <span>${item.name} (${item.restaurant})</span>
                    <div class="quantity-controls">
                        <button onclick="updateQuantity(${index}, -1)">-</button>
                        <span class="quantity">${item.quantity}</span>
                        <button onclick="updateQuantity(${index}, 1)">+</button>
                    </div>
                    <span>${subtotal.toFixed(2)} MAD</span>
                    <button class="remove-item" onclick="removeFromCart(${index})">Supprimer</button>
                `;
                cartItems.appendChild(cartItem);

                // Sidebar cart items
                const sidebarItem = document.createElement('div');
                sidebarItem.className = 'cart-sidebar__item';
                sidebarItem.innerHTML = `
                    <span>${item.name} (${item.restaurant})</span>
                    <div class="quantity-controls">
                        <button onclick="updateQuantity(${index}, -1)">-</button>
                        <span class="quantity">${item.quantity}</span>
                        <button onclick="updateQuantity(${index}, 1)">+</button>
                    </div>
                    <span>${subtotal.toFixed(2)} MAD</span>
                    <button class="remove-item" onclick="removeFromCart(${index})">Supprimer</button>
                `;
                cartSidebarItems.appendChild(sidebarItem);
            });

            cartBadge.textContent = itemCount;
            cartTotal.textContent = `Total : ${total.toFixed(2)} MAD`;
            cartSidebarTotal.textContent = `Total : ${total.toFixed(2)} MAD`;
            updateOrderSummary();
        }

        // Update order summary
        function updateOrderSummary() {
            const summary = document.getElementById('cartOrderSummary');
            const sidebarSummary = document.getElementById('cartSidebarOrderSummary');
            summary.innerHTML = '<h4>Récapitulatif de la Commande</h4>';
            sidebarSummary.innerHTML = '<h4>Récapitulatif de la Commande</h4>';

            const restaurants = [...new Set(cart.map(item => item.restaurant))];
            restaurants.forEach(restaurant => {
                const restaurantItems = cart.filter(item => item.restaurant === restaurant);
                const restaurantTotal = restaurantItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
                summary.innerHTML += `<p>${restaurant}: ${restaurantTotal.toFixed(2)} MAD</p>`;
                sidebarSummary.innerHTML += `<p>${restaurant}: ${restaurantTotal.toFixed(2)} MAD</p>`;
            });
        }

        // Add to cart
        function addToCart(menu, restaurant) {
            const existingItem = cart.find(item => item.id === menu.id && item.restaurant === restaurant);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: menu.id,
                    name: menu.name,
                    price: parseFloat(menu.price),
                    quantity: 1,
                    restaurant: restaurant,
                    image: menu.image
                });
            }
            saveCart();
            updateCartDisplay();
            showNotification();
        }

        // Update quantity
        function updateQuantity(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            saveCart();
            updateCartDisplay();
        }

        // Remove from cart
        function removeFromCart(index) {
            cart.splice(index, 1);
            saveCart();
            updateCartDisplay();
        }

        // Show notification
        function showNotification() {
            const notification = document.getElementById('notification');
            notification.classList.add('show');
            setTimeout(() => notification.classList.remove('show'), 3000);
        }

        // Clear cart
        document.querySelector('.clear-cart').addEventListener('click', () => {
            cart = [];
            saveCart();
            updateCartDisplay();
        });

        // Filter restaurants
        document.querySelectorAll('.filter__btn').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelector('.filter__btn.active').classList.remove('active');
                button.classList.add('active');
                const filter = button.dataset.filter;
                document.querySelectorAll('.restaurant__card').forEach(card => {
                    card.style.display = filter === 'all' || card.dataset.category === filter ? 'block' : 'none';
                });
            });
        });

        // Open menu popup
        document.querySelectorAll('.details__btn').forEach(button => {
            button.addEventListener('click', () => {
                const card = button.closest('.restaurant__card');
                const restaurantName = card.dataset.restaurant;
                const restaurantCategory = card.dataset.category;
                const menus = JSON.parse(card.dataset.menus);

                document.getElementById('popupRestaurantName').textContent = restaurantName;
                document.getElementById('popupRestaurantCategory').textContent = restaurantCategory.charAt(0).toUpperCase() + restaurantCategory.slice(1);
                const menuItems = document.getElementById('popupMenuItems');
                menuItems.innerHTML = '';

                if (menus.length === 0) {
                    menuItems.innerHTML = '<p>Aucun menu disponible pour ce restaurant.</p>';
                } else {
                    menus.forEach(menu => {
                        const menuItem = document.createElement('div');
                        menuItem.className = 'menu-item';
                        const imageSrc = menu.image ? `{{ asset('storage/menus/') }}/${menu.image}` : '{{ asset('images/default-menu.jpg') }}';
                        menuItem.innerHTML = `
                            <img src="${imageSrc}" alt="${menu.name}" loading="lazy">
                            <h4>${menu.name}</h4>
                            <p>${menu.description || 'Aucune description disponible.'}</p>
                            <div class="price">${parseFloat(menu.price).toFixed(2)} MAD</div>
                            <button class="add-to-cart" onclick='addToCart(${JSON.stringify(menu)}, "${restaurantName}")'>
                                <i class="ri-shopping-cart-fill"></i> Ajouter
                            </button>
                        `;
                        menuItems.appendChild(menuItem);
                    });
                }

                document.getElementById('menuPopup').classList.add('active');
                loadComments(card.dataset.id);
            });
        });

        // Close menu popup
        document.querySelector('.menu-popup__close').addEventListener('click', () => {
            document.getElementById('menuPopup').classList.remove('active');
        });

        // Open/close cart sidebar
        document.getElementById('cartButton').addEventListener('click', () => {
            document.getElementById('cartSidebar').classList.add('open');
        });
        document.querySelector('.cart-sidebar__close').addEventListener('click', () => {
            document.getElementById('cartSidebar').classList.remove('open');
        });

        // Load comments
        function loadComments(restaurantId) {
            // Placeholder for fetching comments from backend
            const commentsList = document.getElementById('commentsList');
            commentsList.innerHTML = '<p>Chargement des commentaires...</p>';
            // Example static comments
            setTimeout(() => {
                commentsList.innerHTML = `
                    <div class="comment">
                        <p class="user">Ahmed</p>
                        <p>Excellents plats sahariens, je recommande vivement !</p>
                    </div>
                    <div class="comment">
                        <p class="user">Sara</p>
                        <p>Service rapide et nourriture délicieuse.</p>
                    </div>
                `;
            }, 1000);
        }

        // Submit comment
        document.getElementById('submitComment').addEventListener('click', () => {
            const commentInput = document.getElementById('commentInput');
            if (commentInput.value.trim()) {
                // Placeholder for submitting comment to backend
                const commentsList = document.getElementById('commentsList');
                const comment = document.createElement('div');
                comment.className = 'comment';
                comment.innerHTML = `
                    <p class="user">{{ auth()->user()->name ?? 'Invité' }}</p>
                    <p>${commentInput.value}</p>
                `;
                commentsList.appendChild(comment);
                commentInput.value = '';
                alert('Commentaire ajouté !');
            } else {
                alert('Veuillez entrer un commentaire.');
            }
        });

        // Place order
        document.querySelector('.place-order').addEventListener('click', () => {
            if (cart.length > 0) {
                alert('Commande passée avec succès !');
                cart = [];
                saveCart();
                updateCartDisplay();
                document.getElementById('menuPopup').classList.remove('active');
            } else {
                alert('Votre panier est vide.');
            }
        });

        // Checkout
        document.querySelector('.cart-sidebar__checkout').addEventListener('click', () => {
            if (cart.length > 0) {
                alert('Commande passée avec succès !');
                cart = [];
                saveCart();
                updateCartDisplay();
                document.getElementById('cartSidebar').classList.remove('open');
            } else {
                alert('Votre panier est vide.');
            }
        });

        loadCart();
    </script>
</body>
</html>
