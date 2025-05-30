<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Dor Sahara') }} - Connexion / Inscription</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('register') }}" method="POST" novalidate id="register-form">
                @csrf
                <h1>Créer un compte</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou utilisez votre email pour l'inscription</span>
                <input type="text" name="name" placeholder="Nom" required value="{{ old('name') }}" />
                @error('name') <span class="error">{{ $message }}</span> @enderror

                <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}" />
                @error('email') <span class="error">{{ $message }}</span> @enderror

                <input type="tel" name="phone" placeholder="Numéro de téléphone" value="{{ old('phone') }}" />
                @error('phone') <span class="error">{{ $message }}</span> @enderror

                <input type="password" name="password" placeholder="Mot de passe" required />
                @error('password') <span class="error">{{ $message }}</span> @enderror

                <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required />
                @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror

                <select name="payment_method" id="payment-method" required>
                    <option value="" disabled {{ old('payment_method') ? '' : 'selected' }}>Choisir une méthode de paiement</option>
                    <option value="1" {{ old('payment_method') == '1' ? 'selected' : '' }}>Carte de crédit</option>
                    <option value="2" {{ old('payment_method') == '2' ? 'selected' : '' }}>PayPal</option>
                    <option value="3" {{ old('payment_method') == '3' ? 'selected' : '' }}>Virement bancaire</option>
                </select>
                @error('payment_method') <span class="error">{{ $message }}</span> @enderror

                <button type="submit">Créer un compte</button>
            </form>
        </div>

        <!-- Formulaire de connexion -->
        <div class="form-container sign-in">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf
                <h1>Se connecter</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou utilisez votre email et mot de passe</span>
                <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}" />
                @error('email') <span class="error">{{ $message }}</span> @enderror

                <input type="password" name="password" placeholder="Mot de passe" required />
                @error('password') <span class="error">{{ $message }}</span> @enderror

                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                <button type="submit">Se connecter</button>
            </form>
        </div>

        <!-- Panneau de bascule -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenue !</h1>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Dor Sahara" />
                    <p>Entrez vos informations pour explorer les aventures de voyage</p>
                    <button class="hidden" id="login">Se connecter</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Bienvenue !</h1>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Dor Sahara" />
                    <p>Inscrivez-vous pour commencer votre aventure</p>
                    <button class="hidden" id="register">Créer un compte</button>
                </div>
            </div>
        </div>

        <!-- Fenêtre contextuelle de paiement -->
        <div class="popup" id="payment-popup">
            <div class="popup-content">
                <span class="close-popup" id="close-popup">×</span>
                <h2 id="popup-title">Détails du paiement</h2>
                <div class="payment-icon" id="payment-icon"></div>
                <form id="payment-form">
                    <div id="payment-fields"></div>
                    <button type="submit">Confirmer le paiement</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Contrôle de la fenêtre contextuelle
            const paymentMethodSelect = document.getElementById('payment-method');
            const paymentPopup = document.getElementById('payment-popup');
            const closePopup = document.getElementById('close-popup');
            const paymentForm = document.getElementById('payment-form');
            const paymentFields = document.getElementById('payment-fields');
            const paymentIcon = document.getElementById('payment-icon');
            const popupTitle = document.getElementById('popup-title');
            const registerForm = document.getElementById('register-form');

            console.log('DOM chargé, sélection de la méthode de paiement:', paymentMethodSelect);

            if (paymentMethodSelect) {
                paymentMethodSelect.addEventListener('change', function () {
                    const method = this.value;
                    console.log('Méthode de paiement sélectionnée:', method);
                    paymentFields.innerHTML = '';
                    paymentIcon.innerHTML = '';

                    if (method === '1') { // Carte de crédit
                        popupTitle.textContent = 'Paiement par carte de crédit';
                        paymentIcon.innerHTML = '<i class="fa-solid fa-credit-card" style="font-size: 40px; color: #e1b06f;"></i>';
                        paymentFields.innerHTML = `
                            <div class="input-group">
                                <input type="text" name="card_number" placeholder="Numéro de la carte" required />
                                <i class="fa-solid fa-credit-card input-icon"></i>
                            </div>
                            <div class="input-group">
                                <input type="text" name="card_holder" placeholder="Nom du titulaire" required />
                                <i class="fa-solid fa-user input-icon"></i>
                            </div>
                            <div class="input-group">
                                <input type="text" name="expiry_date" placeholder="Date d'expiration (MM/AA)" required />
                                <i class="fa-solid fa-calendar input-icon"></i>
                            </div>
                            <div class="input-group">
                                <input type="text" name="cvv" placeholder="CVV" required />
                                <i class="fa-solid fa-lock input-icon"></i>
                            </div>
                        `;
                        paymentPopup.style.display = 'flex';
                    } else if (method === '2') { // PayPal
                        popupTitle.textContent = 'Paiement par PayPal';
                        paymentIcon.innerHTML = '<i class="fa-brands fa-paypal" style="font-size: 40px; color: #e1b06f;"></i>';
                        paymentFields.innerHTML = `
                            <div class="input-group">
                                <input type="email" name="paypal_email" placeholder="Email PayPal" required />
                                <i class="fa-solid fa-envelope input-icon"></i>
                            </div>
                            <div class="input-group">
                                <input type="password" name="paypal_password" placeholder="Mot de passe PayPal" required />
                                <i class="fa-solid fa-lock input-icon"></i>
                            </div>
                        `;
                        paymentPopup.style.display = 'flex';
                    } else if (method === '3') { // Virement bancaire
                        popupTitle.textContent = 'Paiement par virement bancaire';
                        paymentIcon.innerHTML = '<i class="fa-solid fa-bank" style="font-size: 40px; color: #e1b06f;"></i>';
                        paymentFields.innerHTML = `
                            <div class="input-group">
                                <input type="text" name="bank_account" placeholder="Numéro de compte bancaire" required />
                                <i class="fa-solid fa-university input-icon"></i>
                            </div>
                            <div class="input-group">
                                <input type="text" name="bank_name" placeholder="Nom de la banque" required />
                                <i class="fa-solid fa-building input-icon"></i>
                            </div>
                            <div class="input-group">
                                <input type="text" name="iban" placeholder="IBAN" required />
                                <i class="fa-solid fa-barcode input-icon"></i>
                            </div>
                        `;
                        paymentPopup.style.display = 'flex';
                    } else {
                        paymentPopup.style.display = 'none';
                    }
                });
            } else {
                console.error('Sélecteur de méthode de paiement non trouvé');
            }

            if (closePopup) {
                closePopup.addEventListener('click', function () {
                    console.log('Fermeture de la fenêtre contextuelle');
                    paymentPopup.style.display = 'none';
                    paymentFields.innerHTML = '';
                    paymentIcon.innerHTML = '';
                });
            }

            if (paymentForm) {
                paymentForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    console.log('Formulaire de paiement soumis');
                    alert('Paiement soumis avec succès !');
                    paymentPopup.style.display = 'none';
                    paymentFields.innerHTML = '';
                    paymentIcon.innerHTML = '';
                });
            }

            if (registerForm) {
                registerForm.addEventListener('submit', function (e) {
                    console.log('Formulaire d\'inscription soumis avec les données:', new FormData(this));
                });
            }

            // Contrôle du basculement entre connexion/inscription
            const container = document.getElementById('container');
            const loginBtn = document.getElementById('login');
            const registerBtn = document.getElementById('register');

            if (registerBtn) {
                registerBtn.addEventListener('click', () => {
                    console.log('Bouton d\'inscription cliqué');
                    container.classList.add('active');
                });
            }

            if (loginBtn) {
                loginBtn.addEventListener('click', () => {
                    console.log('Bouton de connexion cliqué');
                    container.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>
