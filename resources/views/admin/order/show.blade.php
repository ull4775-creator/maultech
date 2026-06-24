@extends('layouts.admin')
@section('title', 'Order Detail')
@section('page-title', 'Order Detail')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card mb-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h5 class="mb-1">Order #{{ $order->order_number }}</h5>
                    <small class="text-white-50">
                        <i class="bi bi-calendar me-1"></i>{{ $order->created_at->format('d M Y, H:i') }}
                    </small>
                </div>
                @php
                    $statusColors = ['pending' => 'warning', 'processing' => 'info', 'completed' => 'success', 'cancelled' => 'danger'];
                @endphp
                <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }} fs-6">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="mb-4 p-3" style="background:rgba(255,255,255,0.03);border-radius:10px;">
                <h6 class="mb-3"><i class="bi bi-person me-2"></i>Client Information</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-white-50">Name:</small>
                        <h6 class="mb-0">{{ $order->client_name }}</h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-white-50">Email:</small>
                        <h6 class="mb-0"><a href="mailto:{{ $order->client_email }}" class="text-info">{{ $order->client_email }}</a></h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-white-50">Phone:</small>
                        <h6 class="mb-0">{{ $order->client_phone }}</h6>
                    </div>
                    @if($order->client_address)
                    <div class="col-md-6">
                        <small class="text-white-50">Address:</small>
                        <h6 class="mb-0">{{ $order->client_address }}</h6>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mb-4 p-3" style="background:rgba(230,126,34,0.05);border-radius:10px;border:1px solid rgba(230,126,34,0.2);">
                <h6 class="mb-3" style="color:var(--accent);"><i class="bi bi-gear me-2"></i>Service Ordered</h6>
                <h5 class="mb-2">{{ $order->service->title ?? 'N/A' }}</h5>
                @if($order->total_price)
                <h4 class="mb-0" style="color:var(--accent);">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h4>
                @endif
            </div>

            <div class="mb-4">
                <h6 class="mb-2"><i class="bi bi-chat-left-text me-2"></i>Project Description:</h6>
                <div class="p-3" style="background:rgba(255,255,255,0.03);border-radius:10px;border-left:3px solid var(--accent);">
                    {!! nl2br(e($order->description)) !!}
                </div>
            </div>

            @if($order->notes)
            <div class="mb-4">
                <h6 class="mb-2"><i class="bi bi-sticky me-2"></i>Admin Notes:</h6>
                <div class="p-3" style="background:rgba(230,126,34,0.1);border-radius:10px;">
                    {!! nl2br(e($order->notes)) !!}
                </div>
            </div>
            @endif
        </div>

        <!-- Update Status Form -->
        <div class="stat-card">
            <h5 class="mb-3"><i class="bi bi-pencil-square me-2"></i>Update Status</h5>
            <form action="{{ route('admin.order.status', $order) }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control form-control-admin" required>
                            <option value="pending" @selected($order->status == 'pending')>Pending</option>
                            <option value="processing" @selected($order->status == 'processing')>Processing</option>
                            <option value="completed" @selected($order->status == 'completed')>Completed</option>
                            <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Price (Rp)</label>
                        <input type="number" name="total_price" class="form-control form-control-admin" value="{{ $order->total_price }}" placeholder="0">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control form-control-admin" rows="3" placeholder="Add notes about this order...">{{ old('notes', $order->notes) }}</textarea>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-save me-2"></i>Update Order
                    </button>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-glass-admin">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Quick Actions</h6>
            <div class="d-grid gap-2">
                <a href="mailto:{{ $order->client_email }}?subject=Order #{{ $order->order_number }}" class="btn btn-glass-admin">
                    <i class="bi bi-envelope me-2"></i>Email Client
                </a>
                <a href="tel:{{ $order->client_phone }}" class="btn btn-glass-admin">
                    <i class="bi bi-telephone me-2"></i>Call Client
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->client_phone) }}?text=Hi {{ $order->client_name }}, regarding your order #{{ $order->order_number }}" class="btn btn-glass-admin" target="_blank">
                    <i class="bi bi-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
@endsection