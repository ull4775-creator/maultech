@extends('layouts.admin')
@section('title', 'Orders')
@section('page-title', 'Service Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Orders</h5>
        <p class="text-white-50 small mb-0">Manage service orders from clients</p>
    </div>
    <span class="badge badge-glass">
        <i class="bi bi-cart me-1"></i>{{ $orders->total() }} Total Orders
    </span>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Client</th>
                <th>Service</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td><strong>{{ $order->order_number }}</strong></td>
                <td>
                    <div>
                        <strong>{{ $order->client_name }}</strong>
                        <br><small class="text-white-50">{{ $order->client_email }}</small>
                    </div>
                </td>
                <td>{{ $order->service->title ?? 'N/A' }}</td>
                <td>
                    @if($order->total_price)
                    <strong style="color:var(--accent);">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                    @else
                    <span class="text-white-50">-</span>
                    @endif
                </td>
                <td>
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'processing' => 'info',
                            'completed' => 'success',
                            'cancelled' => 'danger'
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td><small class="text-white-50">{{ $order->created_at->diffForHumans() }}</small></td>
                <td>
                    <a href="{{ route('admin.order.show', $order) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-eye"></i>
                    </a>
                    <form action="{{ route('admin.order.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this order?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-white-50 py-4">
                    No orders yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $orders->links() }}</div>
@endsection