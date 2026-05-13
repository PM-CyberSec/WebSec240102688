<nav class="navbar navbar-expand-lg sticky-top" style="background:var(--bg-card);border-bottom:1px solid var(--border-light);">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <div class="brand-icon me-2">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>
            <span class="brand-text">Quickbite!</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door d-lg-none me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('restaurants.index') ? 'active' : '' }}" href="{{ route('restaurants.index') }}">
                        <i class="bi bi-grid d-lg-none me-1"></i> Restaurants
                    </a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('partner.pricing') ? 'active' : '' }}" href="{{ route('partner.pricing') }}">
                        <i class="bi bi-shop d-lg-none me-1"></i> Become a Partner
                    </a>
                </li>
                @else
                @php $user = Auth::user(); @endphp
                @if(!$user->isRestaurant() && !$user->isRider())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('partner.pricing') ? 'active' : '' }}" href="{{ route('partner.pricing') }}">
                        <i class="bi bi-shop d-lg-none me-1"></i> Become a Partner
                    </a>
                </li>
                @endif
                @endguest
                @auth
                @php $user = Auth::user(); @endphp
                @if($user->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-gear d-lg-none me-1"></i> <span class="badge bg-orange">Admin</span>
                    </a>
                </li>
                @endif
                @if(!$user->isCustomer() && !$user->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 d-lg-none me-1"></i> Dashboard
                    </a>
                </li>
                @endif
                @if($user->isCustomer())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.orders.index') ? 'active' : '' }}" href="{{ route('customer.orders.index') }}">
                        <i class="bi bi-bag d-lg-none me-1"></i> Orders
                    </a>
                </li>
                @endif
                @endauth
            </ul>

            <div class="d-flex align-items-center gap-2">
                @auth
                    @php
                        $user = Auth::user();
                        $notifications = [];
                        $notifCount = 0;
                        if ($user->isRestaurant()) {
                            $restaurant = $user->restaurant;
                            if ($restaurant) {
                                $newOrders = $restaurant->orders()->where('status', 'confirmed')->latest()->take(5)->get();
                                foreach ($newOrders as $o) {
                                    $notifications[] = ['icon' => 'bi-bag', 'text' => "New order {$o->order_number}", 'time' => $o->created_at->diffForHumans(), 'url' => route('restaurant.orders.show', $o->id)];
                                }
                                $notifCount = $newOrders->count();
                            }
                        } elseif ($user->isAdmin()) {
                            $pendingOrders = \App\Models\Order::where('status', 'confirmed')->whereNull('rider_id')->take(5)->get();
                            foreach ($pendingOrders as $o) {
                                $notifications[] = ['icon' => 'bi-clock', 'text' => "Order {$o->order_number} needs rider", 'time' => $o->created_at->diffForHumans(), 'url' => route('admin.dashboard')];
                            }
                            $pendingRestaurants = \App\Models\Restaurant::where('is_open', false)->take(5)->get();
                            foreach ($pendingRestaurants as $r) {
                                $notifications[] = ['icon' => 'bi-shop', 'text' => "{$r->name} pending approval", 'time' => $r->created_at->diffForHumans(), 'url' => route('admin.dashboard')];
                            }
                            $notifCount = $pendingOrders->count() + $pendingRestaurants->count();
                        } elseif ($user->isRider()) {
                            $rider = $user->rider;
                            if ($rider) {
                                $newAssignments = $rider->orders()->whereIn('status', ['confirmed', 'preparing'])->latest()->take(5)->get();
                                foreach ($newAssignments as $o) {
                                    $notifications[] = ['icon' => 'bi-bicycle', 'text' => "Order {$o->order_number} assigned — ready for pickup", 'time' => $o->created_at->diffForHumans(), 'url' => route('rider.dashboard')];
                                }
                                $notifCount = $newAssignments->count();
                            }
                        } else {
                            $orderUpdates = $user->customerOrders()->whereIn('status', ['confirmed', 'preparing', 'on_the_way'])->latest()->take(5)->get();
                            foreach ($orderUpdates as $o) {
                                $notifications[] = ['icon' => 'bi-truck', 'text' => "Order {$o->order_number} is " . str_replace('_', ' ', $o->status), 'time' => $o->updated_at->diffForHumans(), 'url' => route('customer.orders.show', $o->id)];
                            }
                            $notifCount = $orderUpdates->count();
                        }
                    @endphp
                    <div class="dropdown">
                        <button class="btn btn-icon position-relative rounded-circle p-2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell"></i>
                            @if($notifCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                                {{ $notifCount > 9 ? '9+' : $notifCount }}
                            </span>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" style="width:320px;max-height:400px;overflow-y:auto;">
                            <div class="px-3 py-2 fw-bold border-bottom" style="color:var(--text-primary);">Notifications</div>
                            @forelse($notifications as $notif)
                            <a href="{{ $notif['url'] }}" class="dropdown-item d-flex align-items-start gap-3 py-3 border-bottom">
                                <div class="btn-icon rounded-circle p-2 flex-shrink-0" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi {{ $notif['icon'] }}"></i>
                                </div>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="small" style="color:var(--text-primary);">{{ $notif['text'] }}</div>
                                    <small style="color:var(--text-muted);">{{ $notif['time'] }}</small>
                                </div>
                            </a>
                            @empty
                            <div class="text-center py-4" style="color:var(--text-muted);">
                                <i class="bi bi-check2-circle d-block mb-2 fs-3"></i>
                                <small>No new notifications</small>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <button class="btn btn-icon position-relative rounded-circle p-2" onclick="toggleTheme()" title="Toggle theme">
                        <i class="bi bi-moon-stars" id="theme-icon"></i>
                    </button>
                    <script>
                        (function() {
                            var icon = document.getElementById('theme-icon');
                            if (icon) {
                                var theme = document.documentElement.getAttribute('data-theme');
                                icon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
                            }
                        })();
                        document.addEventListener('click', function(e) {
                            if (e.target.closest('[onclick*="toggleTheme"]') || e.target.closest('#theme-icon')) {
                                var icon = document.getElementById('theme-icon');
                                if (icon) {
                                    var theme = document.documentElement.getAttribute('data-theme');
                                    icon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
                                }
                            }
                        });
                    </script>

                    <div class="dropdown">
                        <button class="btn btn-light d-flex align-items-center gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar-circle">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                            @if($user->isAdmin())
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-gear me-2"></i>Admin Panel</a></li>
                            @endif
                @if(!$user->isCustomer() && !$user->isAdmin())
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none" style="color:var(--text-primary);">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary-custom">Sign Up</a>
                    <button class="btn btn-icon position-relative rounded-circle p-2" onclick="toggleTheme()" title="Toggle theme">
                        <i class="bi bi-moon-stars" id="theme-icon-guest"></i>
                    </button>
                @endauth
            </div>
        </div>
    </div>
</nav>

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
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .nav-link {
        font-weight: 500;
        padding: 10px 18px;
        border-radius: var(--radius-md);
        transition: var(--transition-fast);
        position: relative;
        color: var(--text-primary);
    }

    .nav-link:hover {
        color: var(--primary-orange);
        background: rgba(255, 107, 53, 0.08);
    }

    .nav-link.active {
        color: var(--primary-orange);
        background: rgba(255, 107, 53, 0.08);
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 3px;
        background: var(--primary);
        border-radius: 2px;
    }

    .avatar-circle {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
    }

    .navbar {
        backdrop-filter: blur(10px);
        background: var(--bg-card) !important;
        border-bottom: 1px solid var(--border-light);
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-toggler {
        padding: 8px 12px;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2833, 37, 41, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .btn-icon {
        background: var(--bg-off);
        color: var(--text-primary);
        border: 1px solid var(--border-light);
        transition: var(--transition-fast);
    }
    .btn-icon:hover {
        background: var(--primary-orange);
        color: white;
        border-color: var(--primary-orange);
    }

    @media (max-width: 991px) {
        .navbar-collapse {
            padding: 20px 0;
            background: white;
            border-radius: var(--radius-lg);
            margin-top: 10px;
            box-shadow: var(--shadow-lg);
        }

        .nav-link {
            padding: 12px 16px;
        }
    }
</style>