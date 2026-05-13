<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quickbite!') }} - Dashboard</title>

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
            --soft-white: var(--bg-primary);
            --off-white: var(--bg-off);
            --muted-gray: var(--text-muted);
            --light-gray: var(--border-light);
            --font-primary: 'Audiowide', 'DM Sans', sans-serif;
            --font-body: 'DM Sans', -apple-system, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --primary-orange: var(--cosmic-primary);
            --primary-orange-light: #60A5FA;
            --primary-orange-dark: var(--cosmic-primary-dark);
            --success-green: var(--cosmic-success);
            --warning-yellow: var(--cosmic-warning);
            --danger-red: var(--cosmic-danger);
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
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.12);
            --shadow-lg: 0 8px 32px rgba(0,0,0,0.16);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --transition-fast: 0.2s ease;
            --transition-normal: 0.3s ease;
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
            transition: background-color var(--transition-normal), color var(--transition-normal);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-primary);
            font-weight: 400;
            color: var(--text-primary);
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1A1A2E, #16213E);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
        }

        .brand-icon-sm {
            width: 40px;
            height: 40px;
            background: var(--primary-orange);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 18px;
        }

        .brand-text-sm {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            margin: 4px 12px;
        }

        .nav-link, .nav-link:visited {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            color: rgba(255,255,255,0.7);
            border-radius: var(--radius-md);
            font-weight: 500;
            transition: var(--transition-fast);
            text-decoration: none;
        }

        .nav-link:hover, .nav-link:visited:hover, .nav-link.active, .nav-link:visited.active {
            background: rgba(255, 107, 53, 0.15);
            color: var(--primary-orange);
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 18px;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 0;
        }

        .top-bar {
            background: var(--bg-card);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .page-title-bar h2 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .page-content {
            padding: 32px;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-normal);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .stat-icon.orange {
            background: rgba(255, 107, 53, 0.1);
            color: var(--primary-orange);
        }

        .stat-icon.green {
            background: rgba(46, 204, 113, 0.1);
            color: var(--success-green);
        }

        .stat-icon.blue {
            background: rgba(52, 152, 219, 0.1);
            color: #3498DB;
        }

        .stat-icon.purple {
            background: rgba(155, 89, 182, 0.1);
            color: #9B59B6;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1;
        }

        .stat-label {
            color: var(--muted-gray);
            font-size: 14px;
            margin-top: 4px;
        }

        .data-table {
            background: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 18px;
            font-weight: 700;
        }

        .table {
            margin: 0;
        }

        .table th {
            background: var(--off-white);
            padding: 16px 20px;
            font-weight: 600;
            color: var(--dark-charcoal);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .table td {
            padding: 16px 20px;
            vertical-align: middle;
            border-color: var(--light-gray);
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-preparing {
            background: #FFF3CD;
            color: #856404;
        }

        .status-confirmed {
            background: #D4EDDA;
            color: #155724;
        }

        .status-delivered {
            background: #D1ECF1;
            color: #0C5460;
        }

        .status-cancelled {
            background: #F8D7DA;
            color: #721C24;
        }

        .btn-primary-custom, .btn-primary-custom:visited,
        .btn-outline-custom, .btn-outline-custom:visited,
        .btn-outline-dark, .btn-outline-dark:visited {
            color: inherit;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition-fast);
        }

        .btn-view {
            background: var(--primary-orange);
            color: white;
        }

        .btn-view:hover {
            background: var(--primary-orange-dark);
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    @yield('styles')
    @stack('styles')
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('home') }}" class="sidebar-brand">
                    <div class="brand-icon-sm">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <span class="brand-text-sm">Quickbite!</span>
                </a>
            </div>

            <nav class="sidebar-nav">
                @yield('sidebar_menu')
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn d-lg-none" onclick="toggleSidebar()">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <div class="page-title-bar">
                        <h2>@yield('page_title', 'Dashboard')</h2>
                    </div>
                </div>

                <div class="user-dropdown">
                    <div class="d-none d-md-flex flex-column align-items-end">
                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>
                    <div class="user-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <button class="btn btn-sm btn-outline-light ms-2" onclick="toggleTheme()" title="Toggle theme" style="color:var(--text-primary);border-color:var(--border-light);">
                        <i class="bi bi-moon-stars" id="dash-theme-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Page Content -->
            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            var theme = localStorage.getItem('foodie_theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
            var icon = document.getElementById('dash-theme-icon');
            if (icon) icon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
        })();
        function toggleTheme() {
            var html = document.documentElement;
            var current = html.getAttribute('data-theme');
            var next = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('foodie_theme', next);
            var icon = document.getElementById('dash-theme-icon');
            if (icon) icon.className = next === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
        }
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
    @yield('scripts')
    @stack('scripts')
    <style>
        .text-muted { color: var(--text-muted) !important; }
        .table th { color: var(--text-muted) !important; }
        .table td { color: var(--text-primary); }
        .table { color: var(--text-primary); }
    </style>
</body>
</html>