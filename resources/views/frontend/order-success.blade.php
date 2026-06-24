@extends('layouts.frontend')
@section('title', 'Order Success')

@section('content')
<section class="py-5" style="padding-top:150px !important;min-height:80vh;display:flex;align-items:center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center" data-aos="zoom-in">
                <div class="glass p-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill" style="font-size:5rem;color:#25d366;"></i>
                    </div>
                    <h2 class="mb-3">Order Submitted!</h2>
                    <p class="text-white-50 mb-4">Thank you for your order. We will contact you shortly.</p>
                    
                    <div class="glass p-3 mb-4 text-start">
                        <p class="mb-2"><strong>Order Number:</strong> {{ $order->order_number }}</p>
                        <p class="mb-2"><strong>Service:</strong> {{ $order->service->title }}</p>
                        <p class="mb-0"><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($order->status) }}</span></p>
                    </div>
                    
                    <a href="{{ route('home') }}" class="btn btn-primary-custom">
                        <i class="bi bi-house me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection