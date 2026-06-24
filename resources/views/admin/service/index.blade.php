@extends('layouts.admin')
@section('title', 'Services')
@section('page-title', 'Services Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Services</h5>
        <p class="text-white-50 small mb-0">Manage your service offerings</p>
    </div>
    <a href="{{ route('admin.service.create') }}" class="btn btn-primary-admin">
        <i class="bi bi-plus-lg me-2"></i>Add New
    </a>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Service Name</th>
                <th>Price Range</th>
                <th>Status</th>
                <th>Orders</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td>
                    @if($service->image)
                    <img src="{{ asset('storage/'.$service->image) }}" style="width:40px;height:40px;border-radius:8px;object-fit:cover;">
                    @else
                    <div style="width:40px;height:40px;border-radius:8px;background:var(--secondary);display:flex;align-items:center;justify-content:center;">
                        <i class="bi {{ $service->icon ?? 'bi-gear' }}" style="font-size:1.2rem;color:var(--accent);"></i>
                    </div>
                    @endif
                </td>
                <td>
                    <strong>{{ $service->title }}</strong>
                    <br><small class="text-white-50">{{ Str::limit($service->description, 40) }}</small>
                </td>
                <td>
                    @if($service->price_label)
                    <span class="badge badge-glass">{{ $service->price_label }}</span>
                    @elseif($service->price_min || $service->price_max)
                    <span class="text-white-50 small">
                        @if($service->price_min && $service->price_max)
                            Rp {{ number_format($service->price_min, 0, ',', '.') }} - {{ number_format($service->price_max, 0, ',', '.') }}
                        @elseif($service->price_min)
                            From Rp {{ number_format($service->price_min, 0, ',', '.') }}
                        @else
                            Up to Rp {{ number_format($service->price_max, 0, ',', '.') }}
                        @endif
                    </span>
                    @else
                    <span class="text-white-50">-</span>
                    @endif
                </td>
                <td>
                    @if($service->status == 'active')
                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1 small"></i>Active</span>
                    @else
                    <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <span class="badge badge-glass">
                        <i class="bi bi-cart me-1"></i>{{ $service->orders_count ?? 0 }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.service.edit', $service) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.service.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-white-50 py-4">
                    No services yet. <a href="{{ route('admin.service.create') }}">Add one!</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $services->links() }}</div>
@endsection