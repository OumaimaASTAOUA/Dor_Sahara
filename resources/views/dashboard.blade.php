<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/intr.css') }}">
    <title>Dor Sahara | Explorez Laâyoune</title>
</head>
<body>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="{{ route('dashboard') }}">Dor<span>Sahara</span></a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-3-line"></i>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">
        <li><a href="#home">Accueil</a></li>
        <li><a href="#about">À propos</a></li>
        <li><a href="#package">Destinations</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <div class="nav__btns">
    @if (Auth::check())
        <a href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn">
           Se déconnecter
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <a href="{{ route('login') }}" class="btn">Se connecter</a>  
        <a href="{{ route('register') }}" class="btn">S'inscrire</a>
    @endif
</div>

    </nav>

    <header class="section__container header__container" id="home">
      <div class="header__content">
        <h1><span>Partez</span> à l’aventure dans le Sahara</h1>
        <p class="section__description">
          Découvrez la beauté unique de Laâyoune et ses environs : dunes dorées,
          traditions nomades et hospitalité inoubliable. Vivez l’authenticité saharienne avec Dor Sahara.
        </p>
        <form action="{{ route('search') }}" method="GET">
          <div class="input__group">
            <label for="location">Lieu</label>
            <input type="text" name="location" placeholder="Laâyoune" />
          </div>
          <div class="input__group">
            <label for="date">Date</label>
            <input type="text" name="date" placeholder="26 Mar, Ven" />
          </div>
          <div class="input__group">
            <label for="price">Prix</label>
            <input type="text" name="price" placeholder="250 MAD" />
          </div>
          <button type="submit" class="btn"><i class="ri-search-line"></i></button>
        </form>
      </div>
      <div class="header__image">
        <img src="{{ asset('images/Shara3.jpeg') }}" alt="header" />
        <img src="{{ asset('images/Shara.jpg') }}" alt="header" />
        <img src="{{ asset('images/header-3.jpg') }}" alt="header" />
        <img src="{{ asset('images/bg.png') }}" alt="bg" />
      </div>
    </header>

    <section id="services" class="section__container">
      <h2 class="section__header">Nos services exceptionnels</h2>
      <div class="services__container">
        <a href="{{ route('destination.index') }}" class="card">
          <div class="icon__container">
            <i class="fas fa-map-marked-alt text-4xl text-blue-600"></i>
          </div>
          <h3 class="text-xl font-bold">Destinations</h3>
          <p class="text-gray-600">Explorez les plus beaux lieux du désert.</p>
        </a>
        <a href="{{ route('hotels.index') }}" class="card">
          <div class="icon__container">
            <i class="fas fa-hotel text-4xl text-blue-600"></i>
          </div>
          <h3 class="text-xl font-bold">Hôtels</h3>
          <p class="text-gray-600">Séjours luxueux.</p>
        </a>
        <a href="{{ route('restaurants.index') }}" class="card">
          <div class="icon__container">
            <i class="fas fa-utensils text-4xl text-blue-600"></i>
          </div>
          <h3 class="text-xl font-bold">Restaurants</h3>
          <p class="text-gray-600">Saveurs authentiques.</p>
        </a>
      </div>
    </section>

    <section class="section__container choose__container" id="about">
      <div class="choose__image">
        <img src="{{ asset('images/explore.jpg') }}" alt="choose" />
      </div>
      <div class="choose__content">
        <p class="section__subheader">Pourquoi nous choisir ?</p>
        <h2 class="section__header">Planifiez votre voyage <span>avec Dor Sahara</span></h2>
        <ul class="choose__list">
          <li>
            <span><i class="ri-verified-badge-fill"></i></span>
            <div>
              <h4>Meilleur prix garanti</h4>
              <p>
                Nous vous assurons les tarifs les plus compétitifs pour découvrir le Sahara sans vous ruiner.
              </p>
            </div>
          </li>
          <li>
            <span><i class="ri-calendar-fill"></i></span>
            <div>
              <h4>Réservations flexibles</h4>
              <p>
                Profitez d’options de réservation souples, adaptées à votre emploi du temps et à vos envies.
              </p>
            </div>
          </li>
          <li>
            <span><i class="ri-road-map-fill"></i></span>
            <div>
              <h4>Cartes de parcours personnalisées</h4>
              <p>
                Explorez le désert grâce à nos itinéraires conçus sur mesure pour une aventure fluide et mémorable.
              </p>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <section class="section__container explore__container">
      <div class="explore__image">
        <img src="{{ asset('images/choose.jpg') }}" alt="explore" />
      </div>
      <div class="explore__content">
        <p class="section__subheader">Explorez Avec Nous</p>
        <h2 class="section__header">
          Choisissez des Destinations de Rêve pour <span>Explorer le Monde</span>
        </h2>
        <p class="section__description">
          Découvrez un monde de merveilles ! Sélectionnez parmi notre liste soigneusement choisie de destinations de rêve et commencez votre voyage pour explorer des paysages à couper le souffle, des cultures vibrantes et des expériences inoubliables.
        </p>
        <div class="explore__btn">
          <a href="#about" class="btn">À Propos de Nous</a>
        </div>
        <div class="explore__grid">
          <div>
            <h4>14</h4>
            <p>Ans<br />d'Expérience</p>
          </div>
          <div>
            <h4>67+</h4>
            <p>Destinations<br />Célébrées</p>
          </div>
          <div>
            <h4>320+</h4>
            <p>Clients<br />Satisfaits</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container client__container">
      <img src="{{ asset('images/bg.png') }}" alt="bg" class="client__bg" />
      <p class="section__subheader">Que Disent Nos Clients ?</p>
      <h2 class="section__header">Témoignages <span>Clients</span></h2>
      <div class="client__card active">
        <img src="{{ asset('images/client-1.jpg') }}" alt="client" />
        <div class="client__content">
          <h4>Emma Johnson</h4>
          <h5>Blogueuse de Voyage</h5>
          <p>
            Cette plateforme de voyage a transformé mes rêves en réalité ! Le processus de réservation était fluide et leur équipe a fourni d’excellents conseils sur les endroits incontournables. Chaque étape était simple, et j’ai hâte de planifier ma prochaine aventure avec eux. Fortement recommandé !
          </p>
        </div>
      </div>
      <div class="client__btns">
        <button class="btn" id="prev">
          <i class="ri-arrow-left-line"></i>
        </button>
        <button class="btn" id="next">
          <i class="ri-arrow-right-line"></i>
        </button>
      </div>
    </section>

    <section class="section__container subscribe__container" id="contact">
      <h2 class="section__header">
        Abonnez-vous pour Recevoir les Dernières Nouvelles <span>À Propos de Nous</span>
      </h2>
      <p class="section__description">
        Restez informé des dernières offres de voyage, des points forts des destinations et des offres exclusives. Abonnez-vous maintenant pour ne jamais manquer les nouveautés et mises à jour excitantes sur nos services !
      </p>
      <form action="{{ route('subscribe') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Votre Email" required />
        <button type="submit" class="btn">S'abonner</button>
      </form>
    </section>

    <footer>
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="footer__logo">
            <a href="{{ route('home') }}">DorSahara</a>
          </div>
          <p>
            Explorez le monde avec nous ! Connectez-vous via nos réseaux sociaux, trouvez des liens rapides vers les ressources essentielles et bénéficiez d'un support 24/7 pour rendre la planification de vos voyages simple et agréable.
          </p>
          <ul class="footer__socials">
            <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
            <li><a href="#"><i class="ri-twitter-fill"></i></a></li>
            <li><a href="#"><i class="ri-instagram-line"></i></a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Services</h4>
          <ul class="footer__links">
            <li><a href="#about">À Propos</a></li>
            <li><a href="{{ route('destination.index') }}">Destinations</a></li> <!-- تصحيح المسار -->
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="{{ route('privacy') }}">Confidentialité</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Instagram</h4>
          <div class="footer__col__flex">
            <img src="{{ asset('images/instagram-1.jpg') }}" alt="instagram" />
            <img src="{{ asset('images/instagram-2.jpg') }}" alt="instagram" />
            <img src="{{ asset('images/instagram-3.jpg') }}" alt="instagram" />
            <img src="{{ asset('images/instagram-4.jpg') }}" alt="instagram" />
            <img src="{{ asset('images/instagram-5.jpg') }}" alt="instagram" />
            <img src="{{ asset('images/instagram-6.jpg') }}" alt="instagram" />
          </div>
        </div>
        <div class="footer__col">
          <h4>Contact</h4>
          <ul class="footer__links">
            <li>
              <a href="#">
                <span><i class="ri-phone-fill"></i></span> +212 612-345-678
              </a>
            </li>
            <li>
              <a href="#">
                <span><i class="ri-map-pin-fill"></i></span> Laâyoune, Maroc
              </a>
            </li>
            <li>
              <a href="mailto:info@dorsahara.com">
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

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/intr.js') }}"></script>
    <script>
      var swiper = new Swiper('.swiper', {
        spaceBetween: 30,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
      });
    </script>
</body>
</html>
