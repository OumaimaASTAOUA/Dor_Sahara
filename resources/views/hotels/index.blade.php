<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dor Sahara | Appartements et Hôtels à Laâyoune</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', 'Poppins', 'Arial', sans-serif;
    }

    :root {
      --primary-color: #fb923c;
      --primary-hover: #f97316;
      --text-color: #000000;
      --text-secondary: #4b5563;
      --bg-color: #ffffff;
      --border-color: #e5e7eb;
      --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.05);
      --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.1);
      --radius: 8px;
      --transition: all 0.3s ease;
      --max-width: 1280px;
      --text-dark: #1f2937;
      --text-light: #6b7280;
      --white: #ffffff;
      --primary-color-dark: #f97316;
    }

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      line-height: 1.6;
    }

    .section__container {
      max-width: var(--max-width);
      margin: auto;
      padding: 5rem 1rem;
    }

    nav {
      background-color: var(--bg-color);
      box-shadow: var(--shadow-sm);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav__header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px;
    }

    .nav__logo a {
      font-size: 24px;
      font-weight: bold;
      color: var(--text-color);
      text-decoration: none;
    }

    .nav__logo a span {
      color: var(--text-secondary);
    }

    .nav__menu__btn {
      font-size: 28px;
      cursor: pointer;
      color: var(--text-color);
      display: none;
      padding: 8px;
      z-index: 1002;
    }

    .nav__menu__btn:focus {
      outline: 2px solid var(--primary-color);
      outline-offset: 2px;
    }

    .nav__links {
      display: flex;
      align-items: center;
      list-style: none;
      gap: 24px;
    }

    .nav__links li a {
      text-decoration: none;
      color: var(--text-color);
      font-size: 16px;
      font-weight: 500;
      transition: var(--transition);
    }

    .nav__links li a:hover {
      color: var(--primary-color);
    }

    .nav__right {
      display: flex;
      align-items: center;
      gap: 24px;
    }

    .home-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background-color: var(--primary-color);
      border-radius: 50%;
      color: white;
      text-decoration: none;
      transition: var(--transition);
      margin-right: 16px;
    }

    .home-icon:hover {
      background-color: var(--primary-hover);
      transform: scale(1.1);
    }

    .home-icon i {
      font-size: 20px;
    }

    @media (max-width: 768px) {
      .nav__menu__btn {
        display: block;
      }

      .nav__right {
        display: none;
      }

      .nav__links {
        display: none;
      }

      .nav__links.active {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 64px;
        left: 0;
        width: 100%;
        background-color: var(--bg-color);
        padding: 24px;
        box-shadow: var(--shadow-sm);
        align-items: flex-start;
        z-index: 1001;
        transform: translateY(0);
        transition: transform 0.3s ease;
      }

      .nav__links li {
        width: 100%;
      }

      .nav__links li a {
        display: block;
        padding: 12px;
      }
    }

    .header__container {
      position: relative;
      text-align: center;
      height: 600px;
      background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .header__container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .header__overlay {
      position: relative;
      z-index: 2;
      color: var(--bg-color);
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
      text-align: center;
      max-width: 90%;
    }

    .header__overlay h1 {
      font-size: 40px;
      font-weight: 700;
      margin-bottom: 12px;
    }

    .header__overlay h1 span {
      color: var(--primary-color);
    }

    .header__overlay p {
      font-size: 18px;
      font-weight: 400;
      max-width: 600px;
      margin: 0 auto;
    }

    .header__cta {
      margin-top: 24px;
    }

    .header__cta .btn {
      background-color: var(--primary-color);
      color: var(--bg-color);
      padding: 12px 24px;
      border: none;
      border-radius: var(--radius);
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
      transition: var(--transition);
      text-decoration: none;
      display: inline-block;
    }

    .header__cta .btn:hover {
      background-color: var(--primary-hover);
      transform: translateY(-2px);
    }

    @media (max-width: 768px) {
      .header__container {
        height: 400px;
        background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&format&fit=crop&w=800&h=400&q=80');
      }

      .header__overlay h1 {
        font-size: 28px;
      }

      .header__overlay p {
        font-size: 16px;
      }
    }

    .search__container {
      background-color: var(--bg-color);
      padding: 32px;
      text-align: center;
      box-shadow: var(--shadow-sm);
      position: relative;
      z-index: 10;
      margin-top: -50px;
      border-radius: var(--radius);
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
    }

    .search__container form {
      display: flex;
      justify-content: center;
      gap: 12px;
      max-width: 800px;
      margin: 0 auto;
      flex-wrap: wrap;
    }

    .search__container input,
    .search__container select {
      flex: 1;
      padding: 14px;
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      font-size: 16px;
      min-width: 200px;
      transition: var(--transition);
    }

    .search__container input:focus,
    .search__container select:focus {
      border-color: var(--primary-color);
      outline: none;
    }

    .search__container .btn {
      background-color: var(--primary-color);
      color: var(--bg-color);
      padding: 14px 24px;
      border: none;
      border-radius: var(--radius);
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: var(--transition);
    }

    .search__container .btn:hover {
      background-color: var(--primary-hover);
    }

    .services__container {
      padding: 48px 24px;
      background-color: var(--bg-color);
      text-align: center;
      position: relative;
      background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=400&q=80');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .services__container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8);
      z-index: 1;
    }

    .services__container > * {
      position: relative;
      z-index: 2;
    }

    .services__container h2 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 32px;
    }

    .service__cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 24px;
    }

    .service__card {
      background-color: var(--bg-color);
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      padding: 24px;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
    }

    .service__card:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-lg);
    }

    .service__card i {
      font-size: 32px;
      margin-bottom: 16px;
    }

    .service__card.wifi i { color: #3b82f6; }
    .service__card.parking i { color: #10b981; }
    .service__card.cleaning i { color: #8b5cf6; }
    .service__card.reception i { color: #ef4444; }

    .service__card h3 {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .service__card p {
      font-size: 14px;
      color: var(--text-secondary);
    }

    @media (max-width: 768px) {
      .services__container {
        background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=300&q=80');
      }

      .services__container h2 {
        font-size: 24px;
      }
    }

    .accommodation__container {
      padding: 48px 24px;
      background-color: var(--bg-color);
    }

    .accommodation__container h2 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 32px;
      text-align: center;
    }

    .filter__buttons {
      display: flex;
      justify-content: center;
      gap: 12px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }

    .filter__button {
      background-color: var(--bg-color);
      border: 1px solid var(--border-color);
      color: var(--text-color);
      padding: 10px 20px;
      border-radius: var(--radius);
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
    }

    .filter__button.active,
    .filter__button:hover {
      background-color: var(--primary-color);
      color: var(--bg-color);
      border-color: var(--primary-color);
    }

    .cards {
      display: flex;
      gap: 24px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .card {
      background-color: var(--bg-color);
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow-md);
      cursor: pointer;
      transition: var(--transition);
      flex: 1;
      max-width: 360px;
      min-width: 320px;
      display: none;
    }

    .card.active {
      display: block;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-lg);
    }

    .card img {
      width: 100%;
      height: 240px;
      object-fit: cover;
    }

    .card-content {
      padding: 24px;
    }

    .card-content h3 {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .card-content p {
      font-size: 14px;
      color: var(--text-secondary);
      margin-bottom: 16px;
    }

    .card-content .features {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      margin-bottom: 16px;
      font-size: 14px;
      color: var(--text-color);
    }

    .card-content .features i {
      color: var(--primary-color);
      margin-right: 6px;
    }

    .card-content .btn {
      background-color: var(--primary-color);
      color: var(--bg-color);
      padding: 10px 16px;
      border: none;
      border-radius: var(--radius);
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: var(--transition);
    }

    .card-content .btn:hover {
      background-color: var(--primary-hover);
    }

    .card-content .price {
      font-size: 20px;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 16px;
    }

    .card-content .rating {
      display: flex;
      align-items: center;
      gap: 4px;
      margin-bottom: 16px;
    }

    .card-content .rating i {
      color: #f59e0b;
    }

    @media (max-width: 768px) {
      .cards {
        flex-direction: column;
        align-items: center;
      }

      .card {
        max-width: 100%;
      }

      .accommodation__container h2 {
        font-size: 24px;
      }

      .filter__buttons {
        flex-direction: column;
        align-items: center;
      }
    }

    .choose__container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 48px;
      padding: 48px 24px;
      background-color: var(--bg-color);
    }

    .choose__image {
      flex: 1;
      max-width: 50%;
    }

    .choose__image img {
      width: 80%;
      height: auto;
      border-radius: var(--radius);
      object-fit: cover;
      transition: var(--transition);
      margin-left: 120px;
    }

    .choose__image img:hover {
      transform: scale(1.02);
      box-shadow: var(--shadow-lg);
    }

    .choose__content {
      flex: 1;
      max-width: 50%;
    }

    .choose__content .section__subheader {
      font-size: 16px;
      font-weight: 500;
      color: var(--primary-color);
      text-transform: uppercase;
      margin-bottom: 12px;
      text-align: left;
    }

    .choose__content .section__header {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 24px;
      text-align: left;
      color: var(--text-color);
    }

    .choose__content .section__header span {
      color: var(--primary-color);
    }

    .choose__list {
      list-style: none;
      padding: 0;
    }

    .choose__list li {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      margin-bottom: 24px;
    }

    .choose__list li span {
      background-color: rgba(251, 146, 60, 0.1);
      color: var(--primary-color);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .choose__list li div h4 {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--text-color);
    }

    .choose__list li div p {
      font-size: 14px;
      color: var(--text-secondary);
      line-height: 1.5;
    }

    @media (max-width: 1024px) {
      .choose__container {
        flex-direction: column;
        gap: 32px;
      }

      .choose__image,
      .choose__content {
        max-width: 100%;
        text-align: center;
      }

      .choose__content .section__subheader,
      .choose__content .section__header {
        text-align: center;
      }

      .choose__list li {
        justify-content: center;
      }
    }

    @media (max-width: 768px) {
      .choose__content .section__header {
        font-size: 24px;
      }

      .choose__list li span {
        width: 36px;
        height: 36px;
        font-size: 18px;
      }

      .choose__list li div h4 {
        font-size: 16px;
      }

      .choose__list li div p {
        font-size: 13px;
      }
    }

    .client__container {
      padding-top: 0;
    }

    .client__container :is(.section__header, .section__description) {
      max-width: 600px;
      margin-inline: auto;
      text-align: center;
    }

    .client__swiper {
      margin-top: 2rem;
      max-width: 750px;
      margin-inline: auto;
      padding: 3rem 1rem;
      overflow: hidden;
      border: 2px solid rgba(252, 127, 9, 0.5);
      box-shadow: 5px 5px 30px rgba(252, 127, 9, 0.2);
      border-radius: 3rem;
    }

    .swiper {
      padding-bottom: 3rem;
      width: 100%;
    }

    .client__card {
      text-align: center;
    }

    .client__card p {
      margin-bottom: 2rem;
      color: var(--text-dark);
      line-height: 1.75rem;
    }

    .client__card img {
      margin-bottom: 1rem;
      max-width: 70px;
      margin-inline: auto;
      border-radius: 100%;
      box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
    }

    .client__card h4 {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--text-dark);
    }

    .client__card h5 {
      font-size: 1rem;
      font-weight: 500;
      color: var(--text-light);
    }

    .swiper-pagination-bullet-active {
      background-color: var(--primary-color);
    }

    .footer {
      background-color: #1f2937;
      color: var(--bg-color);
      padding: 48px 24px;
    }

    .footer__container {
      max-width: 1280px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 32px;
    }

    .footer__logo {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 16px;
    }

    .footer__logo span {
      color: var(--primary-color);
    }

    .footer__about p {
      margin-bottom: 16px;
      color: #d1d5db;
    }

    .footer__social {
      display: flex;
      gap: 16px;
    }

    .footer__social a {
      color: var(--bg-color);
      font-size: 20px;
      transition: var(--transition);
    }

    .footer__social a:hover {
      color: var(--primary-color);
    }

    .footer__links h3,
    .footer__contact h3,
    .footer__newsletter h3 {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 16px;
    }

    .footer__links ul {
      list-style: none;
    }

    .footer__links ul li {
      margin-bottom: 8px;
    }

    .footer__links ul li a {
      color: #d1d5db;
      text-decoration: none;
      transition: var(--transition);
    }

    .footer__links ul li a:hover {
      color: var(--primary-color);
    }

    .footer__contact p {
      display: flex;
      align-items: flex-start;
      gap: 8px;
      margin-bottom: 8px;
      color: #d1d5db;
    }

    .footer__contact p i {
      margin-top: 4px;
    }

    .footer__newsletter p {
      margin-bottom: 16px;
      color: #d1d5db;
    }

    .footer__newsletter form {
      display: flex;
      gap: 8px;
    }

    .footer__newsletter input {
      flex: 1;
      padding: 10px;
      border: 1px solid #374151;
      background-color: #374151;
      color: var(--bg-color);
      border-radius: var(--radius);
    }

    .footer__newsletter input:focus {
      outline: none;
      border-color: var(--primary-color);
    }

    .footer__newsletter button {
      background-color: var(--primary-color);
      color: var(--bg-color);
      border: none;
      padding: 10px;
      border-radius: var(--radius);
      cursor: pointer;
      transition: var(--transition);
    }

    .footer__bottom {
      max-width: 1280px;
      margin: 0 auto;
      padding-top: 24px;
      margin-top: 24px;
      border-top: 1px solid #374151;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
    }

    .footer__bottom p {
      color: #d1d5db;
      font-size: 14px;
    }

    .footer__bottom ul {
      display: flex;
      gap: 16px;
      list-style: none;
    }

    .footer__bottom ul li a {
      color: #d1d5db;
      font-size: 14px;
      text-decoration: none;
      transition: var(--transition);
    }

    .footer__bottom ul li a:hover {
      color: var(--primary-color);
    }

    @media (max-width: 768px) {
      .footer__bottom {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
    }

    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: var(--bg-color);
      border-left: 4px solid var(--primary-color);
      padding: 16px;
      border-radius: var(--radius);
      box-shadow: var(--shadow-md);
      z-index: 1000;
      display: flex;
      align-items: center;
      gap: 12px;
      transform: translateX(120%);
      transition: var(--transition);
    }

    .notification.active {
      transform: translateX(0);
    }

    .notification i {
      font-size: 24px;
      color: var(--primary-color);
    }

    .notification-content h3 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .notification-content p {
      font-size: 14px;
      color: var(--text-secondary);
    }

    .notification-close {
      position: absolute;
      top: 8px;
      right: 8px;
      font-size: 16px;
      color: var(--text-secondary);
      cursor: pointer;
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2000;
      opacity: 0;
      visibility: hidden;
      transition: var(--transition);
    }

    .modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .modal {
      background-color: var(--bg-color);
      border-radius: var(--radius);
      box-shadow: var(--shadow-lg);
      width: 90%;
      max-width: 600px;
      padding: 24px;
      position: relative;
      transform: translateY(-20px);
      transition: var(--transition);
    }

    .modal-overlay.active .modal {
      transform: translateY(0);
    }

    .modal-close {
      position: absolute;
      top: 16px;
      right: 16px;
      font-size: 24px;
      color: var(--text-secondary);
      cursor: pointer;
    }

    .modal h2 {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 16px;
    }

    .modal p {
      margin-bottom: 24px;
      color: var(--text-secondary);
    }

    .modal-form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .modal-form input,
    .modal-form textarea {
      padding: 12px;
      border: 1px solid var(--border-color);
      border-radius: var(--radius);
      font-size: 16px;
    }

    .modal-form input:focus,
    .modal-form textarea:focus {
      border-color: var(--primary-color);
      outline: none;
    }

    .modal-form button {
      background-color: var(--primary-color);
      color: var(--bg-color);
      padding: 12px;
      border: none;
      border-radius: var(--radius);
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
    }

    .modal-form button:hover {
      background-color: var(--primary-hover);
    }

    .carousel {
      position: relative;
      width: 100%;
      height: 300px;
      margin-bottom: 24px;
      overflow: hidden;
      border-radius: var(--radius);
    }

    .carousel img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .carousel img.active {
      opacity: 1;
    }

    .carousel-nav {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      transform: translateY(-50%);
    }

    .carousel-nav button {
      background-color: rgba(0, 0, 0, 0.5);
      color: var(--bg-color);
      border: none;
      padding: 10px;
      cursor: pointer;
      font-size: 18px;
      transition: var(--transition);
    }

    .carousel-nav button:hover {
      background-color: var(--primary-color);
    }

    .detailed-description {
      font-size: 16px;
      line-height: 1.8;
      color: var(--text-secondary);
      margin-bottom: 24px;
    }

    .theme-switcher {
      position: fixed;
      bottom: 20px;
      left: 20px;
      background-color: var(--bg-color);
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: var(--shadow-md);
      z-index: 999;
      transition: var(--transition);
    }

    .theme-switcher:hover {
      transform: rotate(30deg);
    }

    .theme-switcher i {
      font-size: 20px;
      color: var(--text-color);
    }

    body.dark-theme {
      --bg-color: #1f2937;
      --text-color: #f9fafb;
      --text-secondary: #d1d5db;
      --border-color: #374151;
    }

    body.dark-theme .nav__logo a,
    body.dark-theme .nav__links li a,
    body.dark-theme .nav__menu__btn {
      color: var(--text-color);
    }

    body.dark-theme .service__card,
    body.dark-theme .card,
    body.dark-theme .comment__card,
    body.dark-theme .search__container,
    body.dark-theme .notification,
    body.dark-theme .modal,
    body.dark-theme .theme-switcher {
      background-color: #374151;
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
      border: none;
      font-size: 1rem;
      color: var(--white);
      background-color: var(--primary-color);
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: var(--primary-color-dark);
    }
  </style>
</head>
<body>
  <nav>
    <div class="nav__header">
      <div class="nav__logo">
        <a href="{{ route('hotels.index') }}">Dor <span>Sahara</span></a>
      </div>
      <div class="nav__menu__btn" id="menuBtn">
        <i class="fas fa-bars"></i>
      </div>
      <ul class="nav__links" id="navLinks">
        <li><a href="#accueil">Accueil</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#hebergements">Hébergements</a></li>
        <li><a href="#about">À Propos</a></li>
        <li><a href="#client">Avis</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <div class="nav__right">
        <a href="{{ route('dashboard') }}" class="home-icon" title="Tableau de bord">
          <i class="fas fa-home"></i>
        </a>
      </div>
    </div>
  </nav>

  <header class="header__container" id="accueil">
    <div class="header__overlay">
      <h1>Bienvenue à <span>Dor Sahara</span></h1>
      <p>Découvrez nos appartements et hôtels de luxe à Laâyoune. Une expérience unique au cœur du Sahara marocain.</p>
      <div class="header__cta">
        <a href="#hebergements" class="btn">Découvrir nos hébergements</a>
      </div>
    </div>
  </header>

  <div class="search__container">
    <form>
      <input type="text" placeholder="Destination" />
      <input type="date" placeholder="Date d'arrivée" />
      <input type="date" placeholder="Date de départ" />
      <select>
        <option value="">Nombre de personnes</option>
        <option value="1">1 personne</option>
        <option value="2">2 personnes</option>
        <option value="3">3 personnes</option>
        <option value="4">4 personnes</option>
        <option value="5">5+ personnes</option>
      </select>
      <button type="submit" class="btn">
        <i class="fas fa-search"></i> Rechercher
      </button>
    </form>
  </div>

  <section class="services__container section__container" id="services">
    <h2>Nos Services</h2>
    <div class="service__cards">
      <div class="service__card wifi">
        <i class="fas fa-wifi"></i>
        <h3>Wi-Fi Gratuit</h3>
        <p>Restez connecté avec notre Wi-Fi haut débit disponible dans tous nos établissements.</p>
      </div>
      <div class="service__card parking">
        <i class="fas fa-parking"></i>
        <h3>Parking Sécurisé</h3>
        <p>Stationnement privé et sécurisé disponible pour tous nos clients.</p>
      </div>
      <div class="service__card cleaning">
        <i class="fas fa-broom"></i>
        <h3>Service de Ménage</h3>
        <p>Service de nettoyage quotidien pour garantir votre confort pendant votre séjour.</p>
      </div>
      <div class="service__card reception">
        <i class="fas fa-concierge-bell"></i>
        <h3>Réception 24/7</h3>
        <p>Notre équipe est à votre disposition 24h/24 et 7j/7 pour répondre à vos besoins.</p>
      </div>
    </div>
  </section>

  <section class="accommodation__container section__container" id="hebergements">
    <h2>Nos Hébergements</h2>
    <div class="filter__buttons">
      <button class="filter__button active" data-filter="all">Tous</button>
      <button class="filter__button" data-filter="apartment">Appartements</button>
      <button class="filter__button" data-filter="hotel">Chambres d'hôtel</button>
    </div>
    <div class="cards">
      @foreach ($apartments as $apartment)
        <div class="card active"
             data-category="apartment"
             data-title="{{ $apartment->name }}"
             data-description="{{ $apartment->description }}"
             data-images='[{{ $apartment->image ? '"'.asset('storage/apartments/'.$apartment->image).'"' : '""' }}]'>
          <img src="{{ $apartment->image ? asset('storage/apartments/' . $apartment->image) : asset('images/default.jpg') }}"
               alt="{{ $apartment->name }}" />
          <div class="card-content">
            <div class="rating">
              @for ($i = 1; $i <= 5; $i++)
                @if ($i <= floor($apartment->rating))
                  <i class="fas fa-star"></i>
                @elseif ($i == ceil($apartment->rating) && $apartment->rating != floor($apartment->rating))
                  <i class="fas fa-star-half-alt"></i>
                @else
                  <i class="far fa-star"></i>
                @endif
              @endfor
              <span>({{ number_format($apartment->rating ?? 0, 1) }})</span>
            </div>
            <h3>{{ $apartment->name }}</h3>
            <p>{{ Str::limit($apartment->description, 100) }}</p>
            <div class="price">À partir de {{ number_format($apartment->price, 2) }} DH / nuit</div>
            <div class="features">
              <span><i class="fas fa-bed"></i> 1 lit double</span>
              <span><i class="fas fa-bath"></i> 1 salle de bain</span>
              <span><i class="fas fa-wifi"></i> Wi-Fi</span>
              <span><i class="fas fa-tv"></i> TV</span>
            </div>
            <a href="{{ $apartment->link }}" class="btn">Réserver <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      @endforeach
      @foreach ($hotels as $hotel)
        <div class="card active"
             data-category="hotel"
             data-title="{{ $hotel->name }}"
             data-description="{{ $hotel->description }}"
             data-images='[{{ $hotel->image ? '"'.asset('storage/hotels/'.$hotel->image).'"' : '""' }}]'>
          <img src="{{ $hotel->image ? asset('storage/hotels/' . $hotel->image) : asset('images/default.jpg') }}"
               alt="{{ $hotel->name }}" />
          <div class="card-content">
            <div class="rating">
              @for ($i = 1; $i <= 5; $i++)
                @if ($i <= floor($hotel->rating))
                  <i class="fas fa-star"></i>
                @elseif ($i == ceil($hotel->rating) && $hotel->rating != floor($hotel->rating))
                  <i class="fas fa-star-half-alt"></i>
                @else
                  <i class="far fa-star"></i>
                @endif
              @endfor
              <span>({{ number_format($hotel->rating ?? 0, 1) }})</span>
            </div>
            <h3>{{ $hotel->name }}</h3>
            <p>{{ Str::limit($hotel->description, 100) }}</p>
            <div class="price">À partir de {{ number_format($hotel->price, 2) }} DH / nuit</div>
            <div class="features">
              <span><i class="fas fa-bed"></i> 1 lit king-size</span>
              <span><i class="fas fa-bath"></i> 1 salle de bain</span>
              <span><i class="fas fa-wifi"></i> Wi-Fi</span>
              <span><i class="fas fa-coffee"></i> Petit-déjeuner</span>
            </div>
            <a href="{{ $hotel->link }}" class="btn">Réserver <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <section class="section__container choose__container" id="about">
    <div class="choose__image">
      <img src="{{ asset('images/trip.png') }}" alt="Trip" class="trip" />
    </div>
    <div class="choose__content">
      <p class="section__subheader">Pourquoi nous choisir ?</p>
      <h2 class="section__header">Planifiez votre voyage <span>avec Dor Sahara</span></h2>
      <ul class="choose__list">
        <li>
          <span><i class="ri-verified-badge-fill"></i></span>
          <div>
            <h4>Meilleur prix garanti</h4>
            <p>Nous vous assurons les tarifs les plus compétitifs pour découvrir le Sahara sans vous ruiner.</p>
          </div>
        </li>
        <li>
          <span><i class="ri-calendar-fill"></i></span>
          <div>
            <h4>Réservations flexibles</h4>
            <p>Profitez d’options de réservation souples, adaptées à votre emploi du temps et à vos envies.</p>
          </div>
        </li>
        <li>
          <span><i class="ri-road-map-fill"></i></span>
          <div>
            <h4>Cartes de parcours personnalisées</h4>
            <p>Explorez le désert grâce à nos itinéraires conçus sur mesure pour une aventure fluide et mémorable.</p>
          </div>
        </li>
      </ul>
    </div>
  </section>

  <section class="section__container client__container" id="client">
    <h2 class="section__header">Ce que disent nos clients</h2>
    <p class="section__description">Découvrez les expériences et témoignages de nos précieux clients.</p>
    <div class="client__swiper">
      <div class="swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="client__card">
              <p>L'expertise de Dor Sahara rend chaque séjour inoubliable ! Chaque détail est parfait.</p>
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=70&h=70&q=80" alt="client" />
              <h4>David Lee</h4>
              <h5>Entrepreneur</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card">
              <p>Dor Sahara est ma référence pour des séjours confortables. Leur service est exceptionnel !</p>
              <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&auto=format&fit=crop&w=70&h=70&q=80" alt="client" />
              <h4>Emily Johnson</h4>
              <h5>Blogger Voyage</h5>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card">
              <p>Dor Sahara est parfait pour mes voyages en famille. Service exceptionnel à chaque fois.</p>
              <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=70&h=70&q=80" alt="client" />
              <h4>Michael Thompson</h4>
              <h5>Planificateur d'événements</h5>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <footer class="footer" id="contact">
    <div class="footer__container">
      <div class="footer__about">
        <div class="footer__logo">Dor <span>Sahara</span></div>
        <p>Dor Sahara vous offre des hébergements de qualité à Laâyoune. Notre mission est de vous faire vivre une expérience inoubliable au cœur du Sahara marocain.</p>
        <div class="footer__social">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
      <div class="footer__links">
        <h3>Liens rapides</h3>
        <ul>
          <li><a href="#accueil">Accueil</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#hebergements">Hébergements</a></li>
          <li><a href="#about">À Propos</a></li>
          <li><a href="#client">Avis</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
      <div class="footer__contact">
        <h3>Contact</h3>
        <p><i class="fas fa-map-marker-alt"></i> 123 Avenue Mohammed V, Laâyoune, Maroc</p>
        <p><i class="fas fa-phone-alt"></i> +212 5 28 99 88 77</p>
        <p><i class="fas fa-envelope"></i> contact@dorsahara.com</p>
        <p><i class="fas fa-clock"></i> Lun - Dim: 24h/24</p>
      </div>
      <div class="footer__newsletter">
        <h3>Newsletter</h3>
        <p>Abonnez-vous à notre newsletter pour recevoir nos dernières offres et promotions.</p>
        <form>
          <input type="email" placeholder="Votre email" />
          <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
      </div>
    </div>
    <div class="footer__bottom">
      <p>© 2025 Dor Sahara. Tous droits réservés.</p>
      <ul>
        <li><a href="#">Politique de confidentialité</a></li>
        <li><a href="#">Conditions d'utilisation</a></li>
        <li><a href="#">Mentions légales</a></li>
      </ul>
    </div>
  </footer>

  <div class="modal-overlay" id="modalOverlay">
    <div class="modal">
      <div class="modal-close" id="modalClose">
        <i class="fas fa-times"></i>
      </div>
      <h2>Réservez maintenant</h2>
      <p>Remplissez le formulaire ci-dessous pour réserver votre séjour.</p>
      <form class="modal-form">
        <input type="text" placeholder="Nom complet" required />
        <input type="email" placeholder="Email" required />
        <input type="tel" placeholder="Téléphone" required />
        <input type="date" placeholder="Date d'arrivée" required />
        <input type="date" placeholder="Date de départ" required />
        <select required>
          <option value="">Type d'hébergement</option>
          <option value="apartment">Appartement</option>
          <option value="hotel">Chambre d'hôtel</option>
          <option value="villa">Villa</option>
        </select>
        <textarea placeholder="Demandes spéciales"></textarea>
        <button type="submit">Réserver maintenant</button>
      </form>
    </div>
  </div>

  <div class="modal-overlay" id="accommodationDetailsPopup">
    <div class="modal">
      <div class="modal-close" id="accommodationDetailsPopupClose">
        <i class="fas fa-times"></i>
      </div>
      <h2 id="detailsTitle"></h2>
      <div class="carousel" id="detailsCarousel">
        <div class="carousel-nav">
          <button id="carouselPrev"><i class="fas fa-chevron-left"></i></button>
          <button id="carouselNext"><i class="fas fa-chevron-right"></i></button>
        </div>
      </div>
      <p class="detailed-description" id="detailsDescription"></p>
      <a href="#" class="btn" id="reserveFromDetails">Réserver maintenant</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const menuBtn = document.getElementById('menuBtn');
      const navLinks = document.getElementById('navLinks');

      menuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        menuBtn.innerHTML = navLinks.classList.contains('active')
          ? '<i class="fas fa-times"></i>'
          : '<i class="fas fa-bars"></i>';
      });

      const filterButtons = document.querySelectorAll('.filter__button');
      const cards = document.querySelectorAll('.card');

      filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
          filterButtons.forEach((btn) => btn.classList.remove('active'));
          button.classList.add('active');
          const filter = button.getAttribute('data-filter');
          cards.forEach((card) => {
            card.classList.toggle('active', filter === 'all' || card.getAttribute('data-category') === filter);
          });
        });
      });

      const detailsPopup = document.getElementById('accommodationDetailsPopup');
      const detailsPopupClose = document.getElementById('accommodationDetailsPopupClose');
      const detailsTitle = document.getElementById('detailsTitle');
      const detailsCarousel = document.getElementById('detailsCarousel');
      const detailsDescription = document.getElementById('detailsDescription');
      const carouselPrev = document.getElementById('carouselPrev');
      const carouselNext = document.getElementById('carouselNext');
      const reserveFromDetails = document.getElementById('reserveFromDetails');
      let currentImageIndex = 0;
      let images = [];

      function showImage(index) {
        const carouselImages = detailsCarousel.querySelectorAll('img');
        carouselImages.forEach((img, i) => img.classList.toggle('active', i === index));
      }

      function populateDetailsPopup(card) {
        detailsTitle.textContent = card.getAttribute('data-title') || 'Accommodation Details';
        detailsDescription.textContent = card.getAttribute('data-description') || 'No description available.';
        try {
          images = JSON.parse(card.getAttribute('data-images') || '[]');
        } catch (e) {
          images = [];
        }

        detailsCarousel.querySelectorAll('img, p').forEach(item => item.remove());

        if (images.length > 0) {
          images.forEach((src, index) => {
            const img = document.createElement('img');
            img.src = src;
            img.alt = `${card.getAttribute('data-title') || 'Accommodation'} ${index + 1}`;
            img.classList.toggle('active', index === 0);
            detailsCarousel.insertBefore(img, detailsCarousel.querySelector('.carousel-nav'));
          });
          currentImageIndex = 0;
          showImage(currentImageIndex);
          carouselPrev.style.display = 'block';
          carouselNext.style.display = 'block';
        } else {
          const noImage = document.createElement('p');
          noImage.textContent = 'Aucune image disponible';
          noImage.style.textAlign = 'center';
          noImage.style.color = '#666';
          noImage.style.padding = '20px';
          detailsCarousel.insertBefore(noImage, detailsCarousel.querySelector('.carousel-nav'));
          carouselPrev.style.display = 'none';
          carouselNext.style.display = 'none';
        }

        detailsPopup.classList.add('active');
      }

      carouselPrev.addEventListener('click', () => {
        if (images.length > 0) {
          currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
          showImage(currentImageIndex);
        }
      });

      carouselNext.addEventListener('click', () => {
        if (images.length > 0) {
          currentImageIndex = (currentImageIndex + 1) % images.length;
          showImage(currentImageIndex);
        }
      });

      detailsPopupClose.addEventListener('click', () => {
        detailsPopup.classList.remove('active');
      });

      detailsPopup.addEventListener('click', (e) => {
        if (e.target === detailsPopup) {
          detailsPopup.classList.remove('active');
        }
      });

      reserveFromDetails.addEventListener('click', (e) => {
        e.preventDefault();
        detailsPopup.classList.remove('active');
        document.getElementById('modalOverlay').classList.add('active');
      });

      cards.forEach(card => {
        card.addEventListener('click', (e) => {
          if (e.target.closest('.btn')) return;
          populateDetailsPopup(card);
        });
      });

      const modalOverlay = document.getElementById('modalOverlay');
      const modalClose = document.getElementById('modalClose');

      modalClose.addEventListener('click', () => {
        modalOverlay.classList.remove('active');
      });

      modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) {
          modalOverlay.classList.remove('active');
        }
      });

      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const targetId = this.getAttribute('href');
          if (targetId === '#') return;
          const targetElement = document.querySelector(targetId);
          if (targetElement) {
            window.scrollTo({
              top: targetElement.offsetTop - 80,
              behavior: 'smooth'
            });
            navLinks.classList.remove('active');
            menuBtn.innerHTML = '<i class="fas fa-bars"></i>';
          }
        });
      });

      const swiper = new Swiper('.swiper', {
        loop: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      });
    });
  </script>
</body>
</html>
