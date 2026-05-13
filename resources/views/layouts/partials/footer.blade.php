<footer class="bg-charcoal text-white pt-5 pb-4">
    <div class="container-fluid px-4">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-4">
                    <div class="brand-icon me-2">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <span class="brand-text">Quickbite!</span>
                </div>
                <p class="text-light opacity-75 mb-4">
                    Your favorite restaurants, delivered fast. Lightning-fast food delivery at your fingertips.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('restaurants.index') }}">Browse Restaurants</a></li>
                    <li><a href="{{ route('partner.pricing') }}">Partner with Us</a></li>
                    @auth
                    <li><a href="{{ route('dashboard') }}">My Dashboard</a></li>
                    <li><a href="{{ route('profile') }}">My Profile</a></li>
                    @endauth
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="text-uppercase fw-bold mb-4">Support</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="mailto:support@foodie.local">Contact Us</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="text-uppercase fw-bold mb-4">Legal</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        <hr class="my-4 border-secondary">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 text-light opacity-75">&copy; {{ date('Y') }} Quickbite!. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/200px-Visa_Inc._logo.svg.png" alt="Visa" height="24" class="me-2" loading="lazy">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/200px-Mastercard-logo.svg.png" alt="Mastercard" height="24" loading="lazy">
            </div>
        </div>
    </div>
</footer>

<style>
    .brand-icon {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }
    .brand-text {
        font-family: 'Audiowide', 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 400;
        color: white;
    }
    .footer-links li {
        margin-bottom: 10px;
    }
    .footer-links a {
        color: rgba(255, 255, 255, 0.7);
        transition: var(--transition-fast);
        text-decoration: none;
    }
    .footer-links a:hover {
        color: var(--primary-orange);
        padding-left: 5px;
    }
    .social-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-normal);
        text-decoration: none;
        color: rgba(255,255,255,0.7);
    }
    .social-icon:hover {
        background: var(--primary-orange);
        transform: translateY(-3px);
        color: white;
    }
</style>