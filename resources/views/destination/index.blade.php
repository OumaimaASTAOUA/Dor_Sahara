<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez les merveilles de Laâyoune : dunes, culture saharienne et aventures uniques avec Dor Sahara.">
    <meta name="keywords" content="Laâyoune, tourisme, désert, Dor Sahara">
    <title>Destinations touristiques à Laâyoune - Dor Sahara</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #d97706;
            --primary-dark: #b65d04;
            --secondary: #1e40af;
            --secondary-dark: #1e3a8a;
            --accent: #10b981;
            --light: #f3f4f6;
            --dark: #1f2937;
            --text: #1a1a1a;
            --text-light: #4b5563;
            --white: #ffffff;
            --bg: #ffffff;
            --card-bg: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --overlay: rgba(0, 0, 0, 0.5);
            --transition: all 0.3s ease;
            --header-height: 60px;
            --max-width: 1200px;
            --primary-color: #f59e0b;
            --primary-color-dark: #d97706;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
            padding-top: 0;
        }

        .container, .section__container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 15px;
        }

        .section__subheader {
            margin-bottom: 10px;
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--primary-color);
            text-align: center;
        }

        .section__header {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--text);
            line-height: 3.25rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .section__header span {
            color: var(--primary-color);
        }

        .section__description {
            font-size: 1rem;
            color: var(--text-light);
            text-align: center;
            margin-bottom: 2rem;
            line-height: 1.75rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            font-size: 1rem;
            color: var(--white);
            background-color: var(--primary-color);
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn:hover {
            background-color: var(--primary-color-dark);
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
            font-weight: bold;
            margin-left: auto;
        }

        img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        a {
            text-decoration: none;
            transition: var(--transition);
        }

        ul {
            list-style: none;
        }

        nav {
            position: fixed;
            isolation: isolate;
            width: 100%;
            z-index: 9;
        }

        .nav__header {
            padding: 0.75rem 1rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--primary-color);
        }

        .nav__logo a {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--white);
        }

        .nav__menu__btn {
            font-size: 1.5rem;
            color: var(--white);
            cursor: pointer;
        }

        .nav__links {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 2rem;
            padding: 2rem;
            background-color: var(--primary-color);
            transition: transform 0.5s;
            z-index: -1;
        }

        .nav__links.open {
            transform: translateY(100%);
        }

        .nav__links a {
            font-weight: 500;
            color: var(--white);
        }

        .nav__links a:hover {
            color: var(--primary-color-dark);
        }

        .nav__btns {
            display: none;
        }

        .header__container {
            display: grid;
            gap: 2rem;
            padding: 5rem 1rem;
        }

        .header__content h1 {
            font-size: 4rem;
            color: var(--text);
            text-align: center;
            margin-bottom: 2rem;
        }

        .header__content h1 span {
            text-decoration: underline;
            text-decoration-color: var(--primary-color);
        }

        .header__content form {
            margin-top: 4rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
        }

        .header__content .input__group {
            flex: 1 0 125px;
            display: grid;
            gap: 10px;
        }

        .header__content label {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text);
        }

        .header__content input {
            width: 100%;
            outline: none;
            border: none;
            font-size: 1rem;
            background-color: transparent;
            color: var(--text-light);
        }

        .header__content input::placeholder {
            color: var(--text-light);
        }

        .header__content .btn {
            padding: 13px 15px;
            font-size: 1.75rem;
            border-radius: 1rem;
        }

        .header__image img {
            border-radius: 1rem;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .services {
            padding: 5rem 0;
            background-color: var(--bg);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .service-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text);
        }

        .service-card p {
            font-size: 1rem;
            color: var(--text-light);
        }

        .destinations {
            padding: 5rem 0;
            background-color: var(--bg);
        }

        .destinations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .simple-destination {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            height: 250px;
            box-shadow: var(--shadow);
        }

        .simple-destination img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .simple-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, var(--overlay), transparent);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            color: var(--white);
        }

        .simple-btn {
            background-color: var(--primary);
            color: var(--white);
            padding: 8px 20px;
            border-radius: 30px;
        }

        .activities {
            padding: 5rem 0;
            background-color: var(--bg);
        }

        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .activity-card {
            background: var(--card-bg);
            border-radius: 8px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .activity-image {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .activity-content {
            padding: 10px;
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .activity-title {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text);
        }

        .activity-price {
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 500;
        }

        .activity-details {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 6px 0;
        }

        .detail-item {
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--text-light);
        }

        .caravan-info {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 6px 0;
        }

        .caravan-logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary);
        }

        .caravan-name {
            font-size: 0.95rem;
            color: var(--text);
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }

        .social-links a {
            color: var(--primary);
            font-size: 1rem;
        }

        .social-links a:hover {
            color: var(--secondary);
        }

        .book-btn, .details-btn {
            padding: 8px 12px;
            font-size: 0.9rem;
            border-radius: 5px;
            margin: 5px 5px 0 0;
        }

        .book-btn {
            background: var(--primary);
            color: var(--white);
        }

        .details-btn {
            background: var(--secondary);
            color: var(--white);
        }

        .book-btn:hover {
            background: var(--primary-dark);
        }

        .details-btn:hover {
            background: var(--secondary-dark);
        }

        .choose__container {
            display: grid;
            gap: 2rem;
            padding: 5rem 1rem;
            background-color: var(--bg);
        }

        .choose__image img {
            max-width: 475px;
            margin-inline: auto;
            border-radius: 2rem;
        }

        .choose__list {
            margin-top: 4rem;
            display: grid;
            gap: 3rem;
        }

        .choose__list li {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .choose__list li span {
            padding: 6px 14px;
            font-size: 2rem;
            color: var(--primary-color);
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .choose__list li h4 {
            margin-bottom: 5px;
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--text);
        }

        .choose__list li p {
            color: var(--text-light);
        }

        .client__container {
            padding: 5rem 1rem;
            background-color: var(--bg);
        }

        .client__swiper {
            margin-top: 2rem;
            max-width: 750px;
            margin-inline: auto;
            padding: 3rem 1rem;
            border: 2px solid rgba(252, 127, 9, 0.5);
            box-shadow: 5px 5px 30px rgba(252, 127, 9, 0.2);
            border-radius: 3rem;
        }

        .swiper {
            padding-bottom: 3rem;
        }

        .client__card {
            text-align: center;
        }

        .client__card p {
            margin-bottom: 2rem;
            color: var(--text);
            line-height: 1.75rem;
        }

        .client__card img {
            max-width: 70px;
            margin-inline: auto;
            border-radius: 100%;
            box-shadow: var(--shadow);
            margin-bottom: 1rem;
        }

        .client__card h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text);
        }

        .client__card h5 {
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-light);
        }

        .swiper-pagination-bullet-active {
            background-color: var(--primary-color);
        }

        footer {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 3rem 0;
        }

        .footer__container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 3rem 0;
        }

        .footer__col {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer__logo a {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--white);
        }

        .footer__logo a span {
            color: var(--white);
        }

        .footer__col p {
            font-size: 0.9rem;
            color: var(--white);
            line-height: 1.5;
        }

        .footer__socials {
            display: flex;
            gap: 1rem;
        }

        .footer__socials a {
            font-size: 1.2rem;
            color: var(--white);
            transition: var(--transition);
        }

        .footer__socials a:hover {
            color: var(--secondary);
        }

        .footer__col h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer__links a {
            font-size: 0.9rem;
            color: var(--white);
            display: block;
            margin-bottom: 0.5rem;
        }

        .footer__links a:hover {
            color: var(--secondary);
        }

        .footer__col__flex {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .footer__col__flex img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .footer__links li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer__links li span {
            font-size: 1rem;
        }

        .footer__bar {
            padding: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .popup-overlay, .groupe-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--overlay);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .popup-overlay.active, .groupe-popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .popup-content, .groupe-popup-content {
            background: var(--card-bg);
            border-radius: 10px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
            transform: scale(0.95);
            transition: var(--transition);
        }

        .popup-overlay.active .popup-content, .groupe-popup-overlay.active .groupe-popup-content {
            transform: scale(1);
        }

        .popup-close, .groupe-popup-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--primary);
            color: var(--white);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
        }

        .popup-close:hover, .groupe-popup-close:hover {
            background: var(--primary-dark);
        }

        .popup-body h2, .groupe-popup-body h2 {
            font-size: 1.8rem;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .popup-gallery, .groupe-popup-gallery {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 1.5rem;
            overflow-x: auto;
        }

        .popup-gallery img, .groupe-popup-gallery img {
            max-height: 200px;
            max-width: 300px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .popup-gallery img:hover, .groupe-popup-gallery img:hover {
            transform: scale(1.05);
        }

        .popup-details p, .groupe-popup-details p {
            font-size: 0.9rem;
            margin: 0.5rem 0;
            color: var(--text-light);
        }

        .popup-details .detail-item, .groupe-popup-details .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .popup-map {
            margin: 1.5rem 0;
            height: 300px;
            position: relative;
        }

        .popup-map iframe {
            width: 100%;
            height: 100%;
            border: 0;
            border-radius: 8px;
        }

        .popup-map::after {
            content: 'Impossible de charger la carte. Veuillez vérifier votre connexion ou réessayer plus tard.';
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--text);
            font-size: 0.9rem;
            text-align: center;
            padding: 1rem;
            background: var(--card-bg);
            border-radius: 8px;
        }

        .popup-map.error::after {
            display: block;
        }

        .groupe-popup-social {
            display: flex;
            gap: 15px;
            margin: 1rem 0;
        }

        .groupe-popup-social a {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .groupe-popup-social a:hover {
            color: var(--secondary);
        }

        .image-zoom-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 3000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-zoom-popup.active {
            display: flex;
            opacity: 1;
        }

        .image-zoom-content {
            max-width: 90%;
            max-height: 90%;
            background: var(--white);
            padding: 20px;
            border-radius: 8px;
            transform: scale(0.8);
            transition: transform 0.3s ease;
        }

        .image-zoom-popup.active .image-zoom-content {
            transform: scale(1);
        }

        .image-zoom-content img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }

        .image-zoom-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: var(--white);
            cursor: pointer;
        }

        .back-to-top {
            position: fixed;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
        }

        @media (width > 768px) {
            nav {
                position: static;
                padding: 1.5rem 1rem;
                max-width: var(--max-width);
                margin-inline: auto;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
            }

            .nav__header {
                padding: 0;
                background-color: transparent;
            }

            .nav__logo a {
                font-size: 1.5rem;
                color: var(--text);
            }

            .nav__logo a span {
                color: var(--primary-color);
            }

            .nav__menu__btn {
                display: none;
            }

            .nav__links {
                position: static;
                width: fit-content;
                padding: 0;
                flex-direction: row;
                background-color: transparent;
                transform: none !important;
            }

            .nav__links a {
                color: var(--text);
            }

            .nav__links a:hover {
                color: var(--primary-color);
            }

            .nav__btns {
                flex: 1;
                display: flex;
                justify-content: flex-end;
            }

            .header__container {
                grid-template-columns: repeat(2, 1fr);
                align-items: center;
            }

            .header__content {
                padding-bottom: 10rem;
            }

            .header__content :is(h1, .section__description) {
                text-align: left;
            }

            .header__content form {
                position: absolute;
                width: max-content;
                padding: 1.5rem;
                bottom: 0;
                border-radius: 1.5rem;
                backdrop-filter: blur(5px);
            }

            .choose__container {
                grid-template-columns: repeat(2, 1fr);
                align-items: center;
            }

            .activities-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header__content h1 {
                font-size: 3rem;
            }

            .activities-grid {
                grid-template-columns: 1fr;
            }

            .activity-image {
                height: 180px;
            }

            .popup-content, .groupe-popup-content {
                max-width: 95%;
                padding: 1.5rem;
            }

            .popup-gallery img, .groupe-popup-gallery img {
                max-height: 150px;
            }

            .popup-map {
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            .header__content h1 {
                font-size: 2.5rem;
            }

            .popup-gallery img, .groupe-popup-gallery img {
                max-height: 120px;
            }

            .popup-map {
                height: 200px;
            }

            .destinations-grid, .services-grid {
                grid-template-columns: 1fr;
            }

            .footer__col__flex img {
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="#">Dor<span>Sahara</span></a>
            </div>
            <div class="nav__menu__btn" id="menu-btn" aria-expanded="false">
                <i class="ri-menu-3-line"></i>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="/" aria-label="Accueil">Accueil</a></li>
            <li><a href="#destinations" aria-label="Destinations">Destinations</a></li>
            <li><a href="#activities" aria-label="Voyages">Voyages</a></li>
            <li><a href="#client" aria-label="Témoignages">Témoignages</a></li>
            <li><a href="{{ route('dashboard') }}" class="home-btn" aria-label="Retour au tableau de bord"><i class="ri-home-2-line" style="color: white;"></i></a></li>
        </ul>
    </nav>

    <header class="section__container header__container" id="home">
        <div class="header__content">
            <h1><span>Explorez</span> Laâyoune, perle du désert</h1>
            <p class="section__description">
                Plongez dans la magie de Laâyoune : dunes dorées, marchés animés comme Souk Ezzefzafi, et une hospitalité saharienne authentique. Vivez une aventure inoubliable avec Dor Sahara.
            </p>
        </div>
        <div class="header__image">
            <img src="{{ asset('images/logoD.png') }}" alt="Dunes de Laâyoune" loading="lazy">
        </div>
    </header>

    <section class="section__container services" id="services">
        <p class="section__subheader">Nos Offres</p>
        <h2 class="section__header">Services à <span>Laâyoune</span></h2>
        <div class="services-grid">
            <div class="service-card">
                <i class="fas fa-map-signs"></i>
                <h3>Visites Guidées</h3>
                <p>Explorez les dunes de Foum El Oued et les sites historiques de Laâyoune avec nos guides experts.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-users"></i>
                <h3>Culture Saharienne</h3>
                <p>Participez à des soirées traditionnelles et découvrez l’artisanat local au cœur de Laâyoune.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-campground"></i>
                <h3>Campements</h3>
                <p>Passez une nuit sous les étoiles dans un campement saharien près de Plage de Tarouma.</p>
            </div>
        </div>
    </section>

    <section class="section__container destinations" id="destinations">
        <p class="section__subheader">Nos Lieux</p>
        <h2 class="section__header">Destinations à <span>Laâyoune</span></h2>
        <div class="destinations-grid">
            @if (isset($destinations) && $destinations->isEmpty())
                <p>Aucune destination disponible pour le moment.</p>
            @else
                @foreach ($destinations as $index => $destination)
                    @php
                        $images = is_string($destination->images) ? json_decode($destination->images, true) : (is_array($destination->images) ? $destination->images : []);
                        $firstImage = !empty($images) ? (strpos($images[0], 'storage/') === false ? asset('storage/' . $images[0]) : $images[0]) : asset('images/placeholder.jpg');
                    @endphp
                    <div class="simple-destination" style="--animation-order: {{ $index + 1 }};">
                        <img src="{{ $firstImage }}" alt="{{ $destination->title }}" loading="lazy">
                        <div class="simple-overlay">
                            <h3>{{ $destination->title }}</h3>
                            <a href="#" class="simple-btn destination-details-btn" data-destination-id="{{ $destination->id }}" aria-label="En savoir plus sur {{ $destination->title }}">En savoir plus</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <section class="section__container activities" id="activities">
        <p class="section__subheader">Nos Groupes</p>
        <h2 class="section__header">Groupes <span>Touristiques</span> à Laâyoune</h2>
        <div class="activities-grid">
            @if (isset($groupTouristiques) && $groupTouristiques->isEmpty())
                <p>Aucun groupe touristique disponible pour le moment.</p>
            @else
                @foreach ($groupTouristiques as $groupe)
                    @php
                        $images = is_string($groupe->images) ? json_decode($groupe->images, true) : (is_array($groupe->images) ? $groupe->images : []);
                        $firstImage = !empty($images) ? (strpos($images[0], 'storage/') === false ? asset('storage/' . $images[0]) : $images[0]) : asset('images/placeholder.jpg');
                        $caravanName = is_array($groupe->caravan_name) ? implode(', ', $groupe->caravan_name) : (is_string($groupe->caravan_name) ? $groupe->caravan_name : 'Inconnu');
                    @endphp
                    <div class="activity-card" data-groupe-id="{{ $groupe->id }}">
                        <div class="activity-image" style="background-image: url('{{ $firstImage }}');">
                            <img src="{{ $firstImage }}" alt="{{ $groupe->title }}" loading="lazy" class="zoomable-image" style="display: none;">
                        </div>
                        <div class="activity-content">
                            <div class="activity-header">
                                <h3 class="activity-title">{{ $groupe->title }}</h3>
                                <div class="activity-price">{{ $groupe->price }} DH / pers.</div>
                            </div>
                            <div class="activity-details">
                                <div class="detail-item">
                                    <i class="far fa-clock"></i>
                                    <span>{{ $groupe->duration }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-users"></i>
                                    <span>{{ $groupe->max_people }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $groupe->starting_point }}</span>
                                </div>
                            </div>
                            <div class="caravan-info">
                                <div class="caravan-details">
                                    <div class="caravan-name">{{ $caravanName }}</div>
                                    <div class="social-links">
                                        @if (!empty($groupe->social_media_links['facebook']))
                                            <a href="{{ $groupe->social_media_links['facebook'] }}" aria-label="Page Facebook de {{ $groupe->title }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                        @endif
                                        @if (!empty($groupe->social_media_links['instagram']))
                                            <a href="{{ $groupe->social_media_links['instagram'] }}" aria-label="Page Instagram de {{ $groupe->title }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="activity-buttons">
                                <a href="{{ $groupe->registration_link }}" class="book-btn" target="_blank" aria-label="Réserver">Réserver maintenant</a>
                                <a href="#" class="details-btn groupe-details-btn" data-groupe-id="{{ $groupe->id }}" aria-label="Voir les détails de {{ $groupe->title }}">Détails</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <section class="section__container choose__container" id="about">
        <div class="choose__image">
            <img src="{{ asset('images/headeDr.png') }}" alt="Culture de Laâyoune" loading="lazy">
        </div>
        <div class="choose__content">
            <p class="section__subheader">Pourquoi Laâyoune ?</p>
            <h2 class="section__header">Découvrez <span>Laâyoune</span> avec Dor Sahara</h2>
            <p class="section__description">
                Laâyoune, cœur du Sahara Marocain, offre des paysages à couper le souffle et une riche culture nomade. De la mosquée Lalla Zninia aux vastes dunes, chaque coin raconte une histoire.
            </p>
            <ul class="choose__list">
                <li>
                    <span><i class="ri-verified-badge-fill"></i></span>
                    <div>
                        <h4>Expérience Authentique</h4>
                        <p>Vivez la vie saharienne avec des guides locaux de Laâyoune.</p>
                    </div>
                </li>
                <li>
                    <span><i class="ri-calendar-fill"></i></span>
                    <div>
                        <h4>Flexibilité</h4>
                        <p>Planifiez votre aventure selon vos envies, des souks aux plages.</p>
                    </div>
                </li>
                <li>
                    <span><i class="ri-road-map-fill"></i></span>
                    <div>
                        <h4>Itinéraires Uniques</h4>
                        <p>Découvrez des sites exclusifs comme la lagune de Naila.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section class="section__container client__container" id="client">
        <p class="section__subheader">Témoignages</p>
        <h2 class="section__header">Ce que disent <span>nos visiteurs</span> sur Laâyoune</h2>
        <p class="section__description">
            Écoutez les expériences de ceux qui ont exploré Laâyoune avec nous.
        </p>
        <div class="client__swiper">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="client__card">
                            <p>Les dunes de Laâyoune sont magiques ! Dor Sahara a rendu cette aventure parfaite.</p>
                            <img src="{{ asset('images/client-1.jpg') }}" alt="client" />
                            <h4>David Lee</h4>
                            <h5>Voyageur</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client__card">
                            <p>Le souk et la culture locale m’ont émerveillé. Merci Dor Sahara !</p>
                            <img src="{{ asset('images/client-2.jpg') }}" alt="client" />
                            <h4>Emily Johnson</h4>
                            <h5>Blogueur</h5>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="client__card">
                            <p>Une nuit dans le désert près de Tarouma, inoubliable ! Service exceptionnel.</p>
                            <img src="{{ asset('images/client-3.jpg') }}" alt="client" />
                            <h4>Michel Thompson</h4>
                            <h5>Organisateur</h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <footer>
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <a href="#">Dor<span>Sahara</span></a>
                </div>
                <p>
                    Explorez le monde avec nous ! Connectez-vous via nos réseaux sociaux pour découvrir Laâyoune et planifiez votre aventure saharienne.
                </p>
                <ul class="footer__socials">
                    <li>
                        <a href="https://facebook.com/dorsahara" target="_blank" aria-label="Page Facebook de Dor Sahara"><i class="ri-facebook-fill"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/dorsahara" target="_blank" aria-label="Page Twitter de Dor Sahara"><i class="ri-twitter-fill"></i></a>
                    </li>
                    <li>
                        <a href="https://instagram.com/dorsahara" target="_blank" aria-label="Page Instagram de Dor Sahara"><i class="ri-instagram-line"></i></a>
                    </li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Services</h4>
                <ul class="footer__links">
                    <li><a href="#about" aria-label="À Propos">À Propos</a></li>
                    <li><a href="#destinations" aria-label="Destinations">Destinations</a></li>
                    <li><a href="#services" aria-label="Services">Services</a></li>
                    <li><a href="#contact" aria-label="Contact">Contact</a></li>
                    <li><a href="#privacy" aria-label="Confidentialité">Confidentialité</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Instagram</h4>
                <div class="footer__col__flex">
                    <img src="{{ asset('images/dest1.jpg') }}" alt="Laâyoune Image 1" loading="lazy">
                    <img src="{{ asset('images/dest2.jpg') }}" alt="Laâyoune Image 2" loading="lazy">
                    <img src="{{ asset('images/dest3.jpg') }}" alt="Laâyoune Image 3" loading="lazy">
                    <img src="{{ asset('images/dest4.jpg') }}" alt="Laâyoune Image 4" loading="lazy">
                    <img src="{{ asset('images/dest5.jpg') }}" alt="Laâyoune Image 5" loading="lazy">
                    <img src="{{ asset('images/dest6.jpg') }}" alt="Laâyoune Image 6" loading="lazy">
                </div>
            </div>
            <div class="footer__col">
                <h4>Contact</h4>
                <ul class="footer__links">
                    <li>
                        <a href="tel:+212600000000" aria-label="Appeler +212 600 000 000">
                            <span><i class="ri-phone-fill"></i></span> +212 600 000 000
                        </a>
                    </li>
                    <li>
                        <a href="#" aria-label="Laâyoune, Maroc">
                            <span><i class="ri-map-pin-fill"></i></span> Laâyoune, Maroc
                        </a>
                    </li>
                    <li>
                        <a href="mailto:info@dorsahara.com" aria-label="Envoyer un email à info@dorsahara.com">
                            <span><i class="ri-mail-fill"></i></span> info@dorsahara.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__bar">
            © 2025 Dor Sahara. Tous droits réservés.
        </div>
    </footer>

    <div class="popup-overlay" id="destination-popup">
        <div class="popup-content">
            <button class="popup-close" id="destination-popup-close">
                <i class="fas fa-times"></i>
            </button>
            <div class="popup-body" id="destination-popup-body"></div>
        </div>
    </div>

    <div class="groupe-popup-overlay" id="groupe-popup">
        <div class="groupe-popup-content">
            <button class="groupe-popup-close" id="groupe-popup-close">
                <i class="fas fa-times"></i>
            </button>
            <div class="groupe-popup-body" id="groupe-popup-body"></div>
        </div>
    </div>

    <div class="image-zoom-popup" id="image-zoom-popup">
        <div class="image-zoom-content">
            <i class="fas fa-times image-zoom-close" id="image-zoom-close"></i>
            <img id="zoomed-image" src="" alt="Image agrandie">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
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
                    navLinks.classList.toggle('open');
                    const icon = menuBtn.querySelector('i');
                    icon.classList.toggle('ri-menu-3-line');
                    icon.classList.toggle('ri-close-line');
                    console.log(`Menu basculé. Actif : ${navLinks.classList.contains('open')}`);
                } catch (error) {
                    console.error('Erreur lors du basculement du menu :', error);
                }
            });

            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('open');
                    menuBtn.setAttribute('aria-expanded', 'false');
                    const icon = menuBtn.querySelector('i');
                    icon.classList.add('ri-menu-3-line');
                    icon.classList.remove('ri-close-line');
                    console.log('Menu fermé après clic sur un lien.');
                });
            });

            const destinations = @json($destinations);
            const groups = @json($groupTouristiques);

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

            const laayouneAreas = [
                {
                    name: "Souk Ezzefzafi",
                    mapUrl: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3415.824570277083!2d-13.20369468489665!3d27.153611149999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDA5JzEzLjAiTiAxM8KwMTInMTMuMyJX!5e0!3m2!1sfr!2sma!4v1698765432100!5m2!1sfr!2sma"
                },
                {
                    name: "Foum El Oued",
                    mapUrl: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3415.824570277083!2d-13.283687549999999!3d27.1536111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDA5JzEzLjAiTiAxM8KwMTcnMDIuMyJX!5e0!3m2!1sfr!2sma!4v1698765432101!5m2!1sfr!2sma"
                },
                {
                    name: "Plage de Tarouma",
                    mapUrl: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3415.824570277083!2d-13.431687549999999!3d27.1536111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDA5JzEzLjAiTiAxM8KwMjUnNTMuMyJX!5e0!3m2!1sfr!2sma!4v1698765432102!5m2!1sfr!2sma"
                },
                {
                    name: "Lagune de Naila",
                    mapUrl: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3415.824570277083!2d-13.416687549999999!3d27.0836111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDA1JzAwLjAiTiAxM8KwMjQJ59.3!5e0!3m2!1sfr!2sma!4v1698765432103!5m2!1sfr!2sma"
                }
            ];

            destinationDetailsButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const destinationId = button.getAttribute('data-destination-id');
                    const destination = destinations.find(d => d.id == destinationId);
                    if (destination) {
                        let images = [];
                        try {
                            images = typeof destination.images === 'string' ? JSON.parse(destination.images) : Array.isArray(destination.images) ? destination.images : [];
                        } catch (e) {
                            console.error('Erreur lors du parsing des images de destination:', e);
                        }
                        const validImages = images.length ? images.map(img => {
                            const cleanImg = img.replace(/^destinations\//, '');
                            return cleanImg.startsWith('http') ? cleanImg : `{{ asset('storage/destinations/') }}${cleanImg}`;
                        }).filter(img => img) : [
                            "{{ asset('images/desert1.jpg') }}",
                            "{{ asset('images/desert2.jpg') }}",
                            "{{ asset('images/desert3.jpg') }}",
                            "{{ asset('images/desert4.jpg') }}",
                            "{{ asset('images/desert5.jpg') }}",
                            "{{ asset('images/desert6.jpg') }}",
                            "{{ asset('images/desert7.jpg') }}"
                        ];
                        const areaIndex = parseInt(destinationId) % laayouneAreas.length;
                        const selectedArea = laayouneAreas[areaIndex] || laayouneAreas[0];
                        destinationPopupBody.innerHTML = `
                            <h2>${destination.title}</h2>
                            <div class="popup-gallery">
                                ${validImages.map(img => `
                                    <img src="${img}" alt="Image de ${destination.title}" class="zoomable-image" loading="lazy" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                `).join('')}
                            </div>
                            <div class="popup-details">
                                <p><strong>Description :</strong> ${destination.description || 'Aucune description disponible.'}</p>
                                <p><strong>À propos de Laâyoune :</strong> Laâyoune, la perle du Sahara marocain, est une ville vibrante où la culture nomade rencontre la modernité. Connue pour ses dunes dorées, ses souks animés comme Souk Ezzefzafi, et ses sites naturels comme la Lagune de Naila, Laâyoune offre une expérience unique. Les visiteurs peuvent explorer l’artisanat local, goûter à la cuisine saharienne, et vivre des nuits magiques sous un ciel étoilé.</p>
                                <p><strong>Activités populaires :</strong> Randonnées dans les dunes, visites culturelles à la mosquée Lalla Zninia, safaris en 4x4, et observation des oiseaux à la lagune.</p>
                                <p><strong>Histoire :</strong> Fondée au cœur du désert, Laâyoune est un carrefour historique des tribus sahraouies, avec une riche tradition de commerce et d’hospitalité.</p>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Zone : ${selectedArea.name}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-sun"></i>
                                    <span>Climat : Chaud et sec, idéal pour les aventures en désert</span>
                                </div>
                            </div>
                            <div class="popup-map">
                                <iframe src="${selectedArea.mapUrl}" allowfullscreen loading="lazy" aria-label="Carte de ${selectedArea.name}" onerror="this.parentElement.classList.add('error')"></iframe>
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
                        let images = [];
                        try {
                            images = typeof groupe.images === 'string' ? JSON.parse(groupe.images) : Array.isArray(groupe.images) ? groupe.images : [];
                        } catch (e) {
                            console.error('Erreur lors du parsing des images de groupe:', e);
                        }
                        const validImages = images
                            .map(img => {
                                const cleanImg = img.replace(/^destinations\//, '');
                                return cleanImg.startsWith('http') ? cleanImg : `{{ asset('storage/destinations/') }}${cleanImg}`;
                            })
                            .filter(img => img);
                        const caravanName = Array.isArray(groupe.caravan_name) ? groupe.caravan_name.join(', ') : (typeof groupe.caravan_name === 'string' ? groupe.caravan_name : 'Inconnu');
                        const socialLinks = groupe.social_media_links || {};
                        groupePopupBody.innerHTML = `
                            <h2>${groupe.title}</h2>
                            <div class="groupe-popup-gallery">
                                ${validImages.length ? validImages.map(img => `
                                    <img src="${img}" alt="Image de ${groupe.title}" class="zoomable-image" loading="lazy" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                `).join('') : `
                                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Image non disponible" class="zoomable-image" loading="lazy">
                                `}
                            </div>
                            <div class="groupe-popup-details">
                                <p><strong>Description :</strong> ${groupe.description || 'Aucune description disponible.'}</p>
                                <div class="detail-item">
                                    <i class="far fa-clock"></i>
                                    <span>Durée : ${groupe.duration}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-users"></i>
                                    <span>Max. Personnes : ${groupe.max_people}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Départ : ${groupe.starting_point}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-bus"></i>
                                    <span>Caravane : ${caravanName}</span>
                                </div>
                                <p><strong>Prix :</strong> ${groupe.price} DH / personne</p>
                            </div>
                            <div class="groupe-popup-social">
                                ${socialLinks.facebook ? `<a href="${socialLinks.facebook}" target="_blank" aria-label="Facebook de ${groupe.title}"><i class="fab fa-facebook"></i></a>` : ''}
                                ${socialLinks.instagram ? `<a href="${socialLinks.instagram}" target="_blank" aria-label="Instagram de ${groupe.title}"><i class="fab fa-instagram"></i></a>` : ''}
                            </div>
                            <a href="${groupe.registration_link}" class="book-btn" target="_blank" aria-label="Réserver ${groupe.title}">Réserver maintenant</a>
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
    </script>
</body>
</html>
