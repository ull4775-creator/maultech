@extends('layouts.admin')
@section('title', 'Visitors')
@section('page-title', 'Visitor Analytics')

@section('content')
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(44,116,179,0.2);color:var(--secondary);">
                <i class="bi bi-eye"></i>
            </div>
            <h3>{{ number_format($stats['total']) }}</h3>
            <p>Total Visitors</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(25,135,84,0.2);color:#75b798;">
                <i class="bi bi-calendar-check"></i>
            </div>
            <h3>{{ number_format($stats['today']) }}</h3>
            <p>Today</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(255,193,7,0.2);color:#ffc107;">
                <i class="bi bi-calendar-week"></i>
            </div>
            <h3>{{ number_format($stats['week']) }}</h3>
            <p>This Week</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(111,66,193,0.2);color:#6f42c1;">
                <i class="bi bi-calendar-month"></i>
            </div>
            <h3>{{ number_format($stats['month']) }}</h3>
            <p>This Month</p>
        </div>
    </div>
</div>

<!-- Visitors Table -->
<div class="stat-card">
    <h5 class="mb-3"><i class="bi bi-people me-2"></i>Recent Visitors</h5>
    <div class="table-glass">
        <table class="table table-dark table-hover mb-0">
            <thead>
                <tr>
                    <th>IP Address</th>
                    <th>Page</th>
                    <th>Browser</th>
                    <th>OS</th>
                    <th>Location</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($visitors as $visitor)
                <tr>
                    <td><code>{{ $visitor->ip_address ?? '-' }}</code></td>
                    <td><small>{{ $visitor->page_visited ?? '/' }}</small></td>
                    <td>
                        @if($visitor->browser)
                        <span class="badge badge-glass">{{ $visitor->browser }}</span>
                        @else
                        <span class="text-white-50">-</span>
                        @endif
                    </td>
                    <td>
                        @if($visitor->os)
                        <span class="badge badge-glass">{{ $visitor->os }}</span>
                        @else
                        <span class="text-white-50">-</span>
                        @endif
                    </td>
                    <td>
                        @if($visitor->city || $visitor->country)
                        <small>{{ $visitor->city }}{{ $visitor->city && $visitor->country ? ', ' : '' }}{{ $visitor->country }}</small>
                        @else
                        <span class="text-white-50">-</span>
                        @endif
                    </td>
                    <td><small class="text-white-50">{{ $visitor->visited_at->diffForHumans() }}</small></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-white-50 py-4">
                        No visitor data yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">{{ $visitors->links() }}</div>
@endsection