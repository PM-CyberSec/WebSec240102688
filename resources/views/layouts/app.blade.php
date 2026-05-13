<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Food delivery - Order from your favorite restaurants">

    <title>{{ config('app.name', 'Quickbite!') }} - Fast Food Delivery</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:wght@400;500;600;700&family=Audiowide&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --cosmic-primary: #3B82F6;
            --cosmic-primary-dark: #2563EB;
            --cosmic-secondary: #8B5CF6;
            --cosmic-success: #16A34A;
            --cosmic-warning: #D97706;
            --cosmic-danger: #DC2626;
            --primary: var(--cosmic-primary);
            --primary-dark: var(--cosmic-primary-dark);
            --secondary: var(--cosmic-secondary);
            --success: var(--cosmic-success);
            --warning: var(--cosmic-warning);
            --danger: var(--cosmic-danger);
            --dark-charcoal: #0F172A;
            --dark-secondary: #1E293B;
            --bg-primary: #FFFFFF;
            --bg-card: #FFFFFF;
            --bg-off: #F1F5F9;
            --text-primary: #0F172A;
            --text-muted: #475569;
            --border-light: #DEE2E6;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 32px rgba(0,0,0,0.14);
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --transition-fast: 0.2s ease;
            --transition-normal: 0.3s ease;
            --transition-slow: 0.5s ease;
            --font-primary: 'Audiowide', 'DM Sans', sans-serif;
            --font-body: 'DM Sans', -apple-system, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --primary-orange: var(--cosmic-primary);
            --primary-orange-light: #60A5FA;
            --primary-orange-dark: var(--cosmic-primary-dark);
            --soft-white: var(--bg-primary);
            --off-white: var(--bg-off);
            --muted-gray: var(--text-muted);
            --light-gray: var(--border-light);
        }

        [data-theme="dark"] {
            --bg-primary: #0B1120;
            --bg-card: #141D2B;
            --bg-off: #1A2332;
            --text-primary: #F1F5F9;
            --text-muted: #94A3B8;
            --border-light: #2D3A4A;
            --dark-charcoal: #0F172A;
            --dark-secondary: #1E293B;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.4);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.5);
            --shadow-lg: 0 8px 32px rgba(0,0,0,0.6);
            --soft-white: var(--bg-primary);
            --off-white: var(--bg-off);
            --muted-gray: var(--text-muted);
            --light-gray: var(--border-light);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
            transition: background-color var(--transition-normal), color var(--transition-normal);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-primary);
            font-weight: 400;
            color: var(--text-primary);
        }

        .font-display {
            font-family: var(--font-primary);
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition-fast);
        }

        a:hover {
            color: var(--primary-orange);
        }

        .btn-primary-custom {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: var(--transition-normal);
            box-shadow: var(--shadow-sm);
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--text-primary);
            border: 2px solid var(--text-primary);
            padding: 10px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: var(--transition-normal);
        }

        .btn-outline-custom:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .text-orange {
            color: var(--primary) !important;
        }

        .bg-orange {
            background: var(--primary) !important;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--primary-orange-light), var(--primary-orange));
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--dark-charcoal);
            border: 2px solid var(--dark-charcoal);
            padding: 10px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: var(--transition-normal);
        }

        .btn-outline-custom:hover {
            background: var(--dark-charcoal);
            color: white;
            transform: translateY(-2px);
        }

        .text-orange {
            color: var(--primary-orange) !important;
        }

        .bg-orange {
            background-color: var(--primary-orange) !important;
        }

        .bg-charcoal {
            background-color: var(--dark-charcoal) !important;
        }

        .shadow-custom {
            box-shadow: var(--shadow-md);
        }

        .shadow-hover:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
        }

        .card-custom {
            background: white;
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-normal);
        }

        .card-custom:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .section-padding {
            padding: 80px 0;
        }

        .container-fluid-custom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .badge-custom {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-open {
            background-color: #D4EDDA;
            color: #155724;
        }

        .badge-closed {
            background-color: #F8D7DA;
            color: #721C24;
        }

        .badge-preparing {
            background-color: #FFF3CD;
            color: #856404;
        }

        .badge-delivered {
            background-color: #D4EDDA;
            color: #155724;
        }

        .rating-star {
            color: #FFD700;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        .fade-in-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .fade-in-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .fade-in-delay-3 { animation-delay: 0.3s; opacity: 0; }
        .fade-in-delay-4 { animation-delay: 0.4s; opacity: 0; }

        @media (max-width: 768px) {
            .section-padding {
                padding: 50px 0;
            }

            .container-fluid-custom {
                padding: 0 16px;
            }
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-lg);
            border-radius: var(--radius-md);
            padding: 8px;
        }

        .dropdown-item {
            padding: 10px 16px;
            border-radius: var(--radius-sm);
            font-weight: 500;
        }

        .dropdown-item:hover {
            background-color: var(--off-white);
            color: var(--primary-orange);
        }

        .form-control-custom {
            border: 2px solid var(--light-gray);
            border-radius: var(--radius-md);
            padding: 14px 18px;
            font-size: 16px;
            transition: var(--transition-fast);
        }

        .form-control-custom:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
        }

        .section-title {
            font-size: 32px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .section-subtitle {
            color: var(--muted-gray);
            font-size: 16px;
            margin-bottom: 40px;
        }

        .stagger-item {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 0.6s ease forwards;
        }

        .btn-primary-custom:visited,
        .btn-outline-custom:visited,
        .btn-outline-dark:visited,
        .nav-link:visited {
            color: inherit;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }
        .table th {
            color: var(--text-muted) !important;
        }
        .table td {
            color: var(--text-primary);
        }
        .table {
            color: var(--text-primary);
        }
    </style>

    @yield('styles')
    @stack('styles')
</head>
<body>
    @include('layouts.partials.navbar')

    <main class="main-content">
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot }}
        @endif
    </main>

    @include('layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function() {
    var theme = localStorage.getItem('foodie_theme') || 'light';
    document.documentElement.setAttribute('data-theme', theme);
})();
function toggleTheme() {
    var html = document.documentElement;
    var current = html.getAttribute('data-theme');
    var next = current === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    localStorage.setItem('foodie_theme', next);
}
function verifyLocation(lat, lng) {
    if (lat === undefined || lng === undefined || isNaN(lat) || isNaN(lng)) {
        return 'Please set a valid location'
    }
    lat = parseFloat(lat)
    lng = parseFloat(lng)
    if (lat < -90 || lat > 90 || lng < -180 || lng > 180) {
        return 'Invalid coordinates (lat: -90 to 90, lng: -180 to 180)'
    }
    if (lat === 0 && lng === 0) {
        return 'Please set your location on the map'
    }
    return null
}
</script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>