@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(44,116,179,0.2);color:var(--secondary);">
                <i class="bi bi-eye"></i>
            </div>
            <h3>{{ number_format($total_visitors) }}</h3>
            <p>Total Visitors</p>
            <small class="text-success"><i class="bi bi-arrow-up"></i> +{{ $visitors_today }} today</small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(25,135,84,0.2);color:#75b798;">
                <i class="bi bi-grid"></i>
            </div>
            <h3>{{ $total_portfolios }}</h3>
            <p>Portfolio Items</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(255,193,7,0.2);color:#ffc107;">
                <i class="bi bi-envelope"></i>
            </div>
            <h3>{{ $total_contacts }}</h3>
            <p>Unread Messages</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(111,66,193,0.2);color:#6f42c1;">
                <i class="bi bi-cart"></i>
            </div>
            <h3>{{ $total_orders }}</h3>
            <p>Pending Orders</p>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="stat-card">
            <h5 class="mb-3"><i class="bi bi-graph-up me-2"></i>Visitor Analytics (Last 30 Days)</h5>
            <canvas id="visitorChart" height="100"></canvas>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="stat-card">
            <h5 class="mb-3"><i class="bi bi-pie-chart me-2"></i>Service Distribution</h5>
            <canvas id="serviceChart" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activities & Top Portfolios -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="stat-card">
            <h5 class="mb-3"><i class="bi bi-activity me-2"></i>Recent Activities</h5>
            <div class="table-glass">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Entity</th>
                            <th>Action</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_activities as $activity)
                        <tr>
                            <td>{{ $activity->entity_type }} #{{ $activity->entity_id }}</td>
                            <td>{{ $activity->action }}</td>
                            <td><small>{{ $activity->created_at->diffForHumans() }}</small></td>
                            <td><span class="badge badge-glass">{{ $activity->status }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-white-50">No activities yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="stat-card">
            <h5 class="mb-3"><i class="bi bi-star me-2"></i>Top Portfolios</h5>
            @foreach($portfolio_views as $portfolio)
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid var(--glass-border);">
                <div>
                    <h6 class="mb-0 small">{{ $portfolio->title }}</h6>
                    <small class="text-white-50">{{ ucfirst($portfolio->category) }}</small>
                </div>
                <span class="badge badge-glass"><i class="bi bi-eye me-1"></i>{{ number_format($portfolio->views) }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Recent Orders & Contacts -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="stat-card">
            <h5 class="mb-3"><i class="bi bi-cart me-2"></i>Recent Orders</h5>
            @foreach($recent_orders as $order)
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid var(--glass-border);">
                <div>
                    <h6 class="mb-0 small">{{ $order->client_name }}</h6>
                    <small class="text-white-50">{{ $order->service->title ?? 'N/A' }}</small>
                </div>
                <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'info') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-6">
        <div class="stat-card">
            <h5 class="mb-3"><i class="bi bi-envelope me-2"></i>Recent Messages</h5>
            @foreach($recent_contacts as $contact)
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid var(--glass-border);">
                <div>
                    <h6 class="mb-0 small">{{ $contact->name }} @unless($contact->is_read)<span class="badge bg-danger ms-1">New</span>@endunless</h6>
                    <small class="text-white-50">{{ Str::limit($contact->message, 50) }}</small>
                </div>
                <small class="text-white-50">{{ $contact->created_at->diffForHumans() }}</small>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Visitor Chart
const visitorCtx = document.getElementById('visitorChart').getContext('2d');
new Chart(visitorCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($visitor_chart->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))) !!},
        datasets: [{
            label: 'Visitors',
            data: {!! json_encode($visitor_chart->pluck('count')) !!},
            borderColor: '#2C74B3',
            backgroundColor: 'rgba(44, 116, 179, 0.1)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#2C74B3',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { labels: { color: '#fff' } } },
        scales: {
            x: { ticks: { color: 'rgba(255,255,255,0.5)' }, grid: { color: 'rgba(255,255,255,0.05)' } },
            y: { ticks: { color: 'rgba(255,255,255,0.5)' }, grid: { color: 'rgba(255,255,255,0.05)' } }
        }
    }
});

// Service Chart
const serviceCtx = document.getElementById('serviceChart').getContext('2d');
new Chart(serviceCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($service_stats->pluck('title')) !!},
        datasets: [{
            data: {!! json_encode($service_stats->pluck('orders_count')) !!},
            backgroundColor: ['#2C74B3', '#205295', '#144272', '#0A2647'],
            borderColor: 'rgba(255,255,255,0.1)',
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom', labels: { color: '#fff', padding: 15 } } }
    }
});
</script>
@endpush