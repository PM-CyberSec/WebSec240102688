@extends('layouts.dashboard')
@section('page_title', 'Admin Dashboard')

@section('sidebar_menu')
    @include('admin.partials.sidebar')
@endsection

@section('styles')
<style>
    .admin-header {
        background: linear-gradient(135deg, var(--dark-charcoal), var(--dark-secondary));
        padding: 40px 0;
        margin-bottom: 32px;
    }
    .admin-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 700;
        color: white;
    }
    .stat-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 24px;
        box-shadow: var(--shadow-sm);
        height: 100%;
        transition: var(--transition-fast);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 16px;
    }
    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--dark-charcoal);
        line-height: 1;
    }
    .stat-label {
        font-size: 13px;
        color: var(--muted-gray);
        margin-top: 4px;
    }
    .stat-trend {
        font-size: 12px;
        font-weight: 600;
        margin-top: 8px;
    }
    .chart-container {
        background: white;
        border-radius: var(--radius-lg);
        padding: 24px;
        box-shadow: var(--shadow-sm);
        height: 100%;
    }
    .chart-container h6 {
        font-weight: 700;
        margin-bottom: 16px;
        color: var(--dark-charcoal);
    }
    .chart-box {
        position: relative;
        height: 250px;
    }
    .control-tower-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .table-card-admin {
        background: white;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .table-header-admin {
        padding: 20px 24px;
        border-bottom: 1px solid var(--light-gray);
    }
    .table-header-admin h4 {
        margin: 0;
        font-weight: 700;
    }
    .table th {
        background: var(--off-white);
        padding: 14px 16px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table td {
        padding: 14px 16px;
        vertical-align: middle;
    }
    .dispatch-btn {
        background: var(--primary-orange);
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: var(--transition-fast);
    }
    .dispatch-btn:hover {
        background: var(--primary-orange-dark);
    }
    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
    }
    .status-dot.placed { background: #3498DB; }
    .status-dot.confirmed { background: #F39C12; }
    .status-dot.preparing { background: #9B59B6; }
    .status-dot.on_the_way { background: #2ECC71; }
    .status-dot.delivered { background: #1ABC9C; }
    .status-dot.cancelled { background: #E74C3C; }
</style>
@endsection

@section('content')
<section class="admin-header">
    <div class="container-fluid-custom">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="admin-title">Admin Dashboard</h1>
                <p class="text-white-50 mt-2">Platform overview and insights</p>
            </div>
            <div class="text-end">
                <span class="badge bg-success px-3 py-2">
                    <i class="bi bi-circle-fill me-1"></i> {{ now()->format('M d, Y') }}
                </span>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid-custom mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498DB;">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-value">{{ $stats['customers'] }}</div>
                <div class="stat-label">Total Customers</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ECC71;">
                    <i class="bi bi-shop"></i>
                </div>
                <div class="stat-value">{{ $stats['restaurants'] }}</div>
                <div class="stat-label">Restaurants</div>
                <div class="stat-trend">
                    <span class="text-warning">{{ $pendingRestaurants->count() }} pending</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(243, 156, 18, 0.1); color: #F39C12;">
                    <i class="bi bi-motorcycle"></i>
                </div>
                <div class="stat-value">{{ $stats['riders'] }}</div>
                <div class="stat-label">Riders</div>
                <div class="stat-trend">
                    <span class="text-success">{{ $riders->where('status', 'available')->count() }} available</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(155, 89, 182, 0.1); color: #9B59B6;">
                    <i class="bi bi-bag"></i>
                </div>
                <div class="stat-value">{{ $stats['today_orders'] }}</div>
                <div class="stat-label">Orders Today</div>
                <div class="stat-trend">
                    <span class="text-danger">{{ $stats['pending_orders'] }} pending</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(255, 107, 53, 0.1); color: var(--primary-orange);">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stat-value">${{ number_format($stats['today_revenue'], 0) }}</div>
                <div class="stat-label">Revenue Today</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(26, 188, 156, 0.1); color: #1ABC9C;">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="stat-value">${{ number_format($stats['total_revenue'], 0) }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(52, 73, 94, 0.1); color: #34495E;">
                    <i class="bi bi-boxes"></i>
                </div>
                <div class="stat-value">{{ $stats['total_orders'] }}</div>
                <div class="stat-label">Total Orders</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(231, 76, 60, 0.1); color: #E74C3C;">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <div class="stat-value">${{ number_format($stats['avg_order_value'], 2) }}</div>
                <div class="stat-label">Avg Order Value</div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid-custom mb-4">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="chart-container">
                <h6><i class="bi bi-graph-up me-2 text-orange"></i>Orders & Revenue — Last 7 Days</h6>
                <div class="chart-box">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="chart-container">
                <h6><i class="bi bi-pie-chart me-2 text-orange"></i>Order Status Distribution</h6>
                <div class="chart-box">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid-custom mb-4">
    <div class="row g-4">
        <div class="col-lg-8" id="mapCard">
            <div class="control-tower-card">
                <div class="table-header-admin d-flex justify-content-between align-items-center">
                    <h4><i class="bi bi-map me-2 text-orange"></i>Live Rider Map</h4>
                    <button class="btn btn-sm btn-outline-dark" onclick="toggleMapFullscreen()">
                        <i class="bi bi-arrows-fullscreen me-1"></i> <span id="expandText">Expand</span>
                    </button>
                </div>
                <div id="riderMap" style="height:350px; background: #1a1a2e;"></div>
            </div>
        </div>
        <div class="col-lg-4" id="mapSidebar">
            <div class="control-tower-card mb-3">
                <div class="table-header-admin">
                    <h6 class="fw-bold mb-0"><i class="bi bi-gear me-2"></i>Quick Links</h6>
                </div>
                <div class="p-3">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-custom w-100 mb-2">
                        <i class="bi bi-people me-2"></i>Manage Partners
                    </a>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-custom w-100 mb-2">
                        <i class="bi bi-box-seam me-2"></i>Subscription Plans
                    </a>
                </div>
            </div>
            <div class="control-tower-card">
                <div class="table-header-admin">
                    <h6 class="fw-bold mb-0">Orders by Status</h6>
                </div>
                <div class="p-3">
                    @forelse($orderStatusCounts as $status => $count)
                    <div class="d-flex align-items-center justify-content-between py-2">
                        <span>
                            <span class="status-dot {{ $status }}"></span>
                            {{ ucwords(str_replace('_', ' ', $status)) }}
                        </span>
                        <span class="fw-bold">{{ $count }}</span>
                    </div>
                    @empty
                    <div class="text-muted py-3 text-center">No active orders</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid-custom mb-4">
    <div class="table-card-admin">
        <div class="table-header-admin d-flex justify-content-between align-items-center">
            <h4><i class="bi bi-list-ul me-2 text-orange"></i>Active Orders</h4>
            <span class="badge bg-orange">{{ $activeOrders->count() }} orders</span>
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Restaurant</th>
                        <th>Rider</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeOrders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->restaurant->name }}</td>
                        <td>
                            @if($order->rider)
                            <span class="text-success"><i class="bi bi-motorcycle"></i> {{ $order->rider->user->name }}</span>
                            @else
                            <span class="text-muted">Unassigned</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-dot {{ $order->status }}"></span>
                            {{ ucwords(str_replace('_', ' ', $order->status)) }}
                        </td>
                        <td class="fw-bold">${{ number_format($order->total, 2) }}</td>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if(!$order->rider)
                            <form method="POST" action="{{ route('admin.orders.assign', $order->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dispatch-btn">Assign</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-check-circle display-4 d-block mb-3 text-success"></i>
                            No active orders
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid-custom">
    <div class="table-card-admin">
        <div class="table-header-admin d-flex justify-content-between align-items-center">
            <div>
                <h4><i class="bi bi-shop me-2 text-orange"></i>Restaurants</h4>
                <small class="text-muted">{{ $restaurants->count() }} total
                    @if($pendingRestaurants->count() > 0)
                    · <span class="text-warning">{{ $pendingRestaurants->count() }} pending</span>
                    @endif
                </small>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mb-0" id="restaurants-table">
                <thead>
                    <tr>
                        <th>Restaurant</th>
                        <th>Owner</th>
                        <th>Status</th>
                        <th>Orders</th>
                        <th>Revenue</th>
                        <th>Rating</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($restaurants as $restaurant)
                    <tr class="{{ $restaurant->status !== 'active' || !$restaurant->is_open ? 'table-warning' : '' }}">
                        <td>
                            <strong>{{ $restaurant->name }}</strong>
                            @if(!$restaurant->is_open)
                            <span class="badge bg-warning text-dark ms-1">Closed</span>
                            @endif
                        </td>
                        <td>
                            <div>{{ $restaurant->owner_name }}</div>
                            <small class="text-muted">{{ $restaurant->owner_email }}</small>
                        </td>
                        <td>
                            @if($restaurant->status === 'active' && $restaurant->is_open)
                            <span class="badge bg-success">Active</span>
                            @elseif($restaurant->status !== 'active')
                            <span class="badge bg-danger">{{ ucfirst($restaurant->status) }}</span>
                            @else
                            <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $restaurant->total_orders }}</td>
                        <td class="fw-bold text-success">${{ number_format($restaurant->total_revenue, 2) }}</td>
                        <td>
                            @if($restaurant->rating > 0)
                            <span class="text-warning"><i class="bi bi-star-fill"></i> {{ number_format($restaurant->rating, 1) }}</span>
                            @else
                            <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $restaurant->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($restaurant->status !== 'active' || !$restaurant->is_open)
                            <form method="POST" action="{{ route('admin.restaurants.approve', $restaurant->id) }}" class="d-inline">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-check-lg"></i> Approve
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('admin.restaurants.toggle', $restaurant->id) }}" class="d-inline">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-power"></i> {{ $restaurant->is_open ? 'Close' : 'Open' }}
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-shop display-4 d-block mb-3"></i>
                            No restaurants yet
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let map, mapInitialized = false;

function initRiderMap() {
    if (mapInitialized) return;
    mapInitialized = true;
    var container = document.getElementById('riderMap');
    if (!container) return;
    map = L.map('riderMap').setView([30.0444, 31.2357], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    var riders = @json($riders);
    var bounds = [];
    riders.forEach(function(rider) {
        if (rider.location && rider.location.latitude && rider.location.longitude) {
            var color = rider.status === 'available' ? '#2ECC71' : '#FF6B35';
            var marker = L.marker([rider.location.latitude, rider.location.longitude], {
                icon: L.divIcon({
                    html: '<div style="background:' + color + ';width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;color:white;font-size:12px;"><i class="bi bi-motorcycle"></i></div>',
                    className: '', iconSize: [24, 24], iconAnchor: [12, 12]
                })
            }).addTo(map);
            marker.bindPopup('<strong>' + rider.name + '</strong><br>Status: ' + rider.status);
            bounds.push([rider.location.latitude, rider.location.longitude]);
        }
    });
    if (bounds.length > 0) map.fitBounds(bounds, { padding: [50, 50] });

    setInterval(refreshRiderMarkers, 30000);
}

var riderMarkers = {};

function refreshRiderMarkers() {
    fetch("{{ route('admin.riders.locations') }}")
        .then(function (r) { return r.json() })
        .then(function (data) {
            data.forEach(function(rider) {
                if (rider.latitude && rider.longitude) {
                    if (riderMarkers[rider.id]) {
                        riderMarkers[rider.id].setLatLng([rider.latitude, rider.longitude]);
                    } else {
                        var color = rider.status === 'available' ? '#2ECC71' : '#FF6B35';
                        var marker = L.marker([rider.latitude, rider.longitude], {
                            icon: L.divIcon({
                                html: '<div style="background:' + color + ';width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;color:white;font-size:12px;"><i class="bi bi-motorcycle"></i></div>',
                                className: '', iconSize: [24, 24], iconAnchor: [12, 12]
                            })
                        }).addTo(map);
                        marker.bindPopup('<strong>' + rider.name + '</strong><br>Status: ' + rider.status);
                        riderMarkers[rider.id] = marker;
                    }
                }
            });
        })
        .catch(function () {});
}

function toggleMapFullscreen() {
    var card = document.getElementById('mapCard');
    var sidebar = document.getElementById('mapSidebar');
    var text = document.getElementById('expandText');
    if (!card || !sidebar) return;
    if (card.classList.contains('col-lg-8')) {
        card.classList.remove('col-lg-8');
        card.classList.add('col-12');
        text.textContent = 'Shrink';
        sidebar.style.display = 'none';
    } else {
        card.classList.remove('col-12');
        card.classList.add('col-lg-8');
        text.textContent = 'Expand';
        sidebar.style.display = '';
    }
    if (map) setTimeout(function() { map.invalidateSize() }, 300);
}

(function autoRefreshRestaurants() {
    if (typeof window._restaurantsRefreshStarted !== 'undefined') return;
    window._restaurantsRefreshStarted = true;

    setInterval(function () {
        fetch(window.location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.text() })
            .then(function (html) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(html, 'text/html');
                var oldBody = document.querySelector('#restaurants-table tbody');
                var newBody = doc.querySelector('#restaurants-table tbody');
                if (oldBody && newBody && oldBody.innerHTML !== newBody.innerHTML) {
                    oldBody.innerHTML = newBody.innerHTML;
                }
            })
            .catch(function () {});
    }, 30000);
})();

function initCharts() {
    var trendCtx = document.getElementById('trendChart');
    if (trendCtx) {
        var days = @json($ordersByDay->pluck('date'));
        var counts = @json($ordersByDay->pluck('count'));
        var revenues = @json($ordersByDay->pluck('revenue'));
        new Chart(trendCtx, {
            type: 'bar',
            data: {
                labels: days.map(function(d) { return new Date(d).toLocaleDateString('en', { weekday: 'short', month: 'short', day: 'numeric' }); }),
                datasets: [{
                    label: 'Orders',
                    data: counts,
                    backgroundColor: 'rgba(255, 107, 53, 0.7)',
                    borderColor: '#FF6B35',
                    borderWidth: 1,
                    borderRadius: 4,
                    order: 2
                }, {
                    label: 'Revenue ($)',
                    data: revenues,
                    type: 'line',
                    borderColor: '#2ECC71',
                    backgroundColor: 'rgba(46, 204, 113, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#2ECC71',
                    pointRadius: 4,
                    borderWidth: 2,
                    order: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } }
            }
        });
    }
    var statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        var statusData = @json($orderStatusAll);
        var labels = Object.keys(statusData).map(function(s) { return s.replace(/_/g, ' '); });
        var values = Object.values(statusData);
        var colors = { placed: '#3498DB', confirmed: '#F39C12', preparing: '#9B59B6', on_the_way: '#2ECC71', delivered: '#1ABC9C', cancelled: '#E74C3C' };
        var bgColors = labels.map(function(l) { return colors[l.replace(/ /g, '_')] || '#95A5A6'; });
        new Chart(statusCtx, {
            type: 'doughnut',
            data: { labels: labels, datasets: [{ data: values, backgroundColor: bgColors, borderWidth: 2 }] },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'right', labels: { padding: 12, boxWidth: 12 } } },
                cutout: '60%'
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initRiderMap();
    initCharts();
});
</script>
@endsection