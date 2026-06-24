@section('title', 'Service Detail')  
@extends('layouts.frontend')
@section('title', $service->title)

@section('content')
<section class="py-5" style="padding-top:150px !important;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="glass p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="service-icon me-3">
                            <i class="bi {{ $service->icon }}"></i>
                        </div>
                        <div>
                            <h1 class="mb-0">{{ $service->title }}</h1>
                            @if($service->price_label)<span class="badge bg-primary mt-2">{{ $service->price_label }}</span>@endif
                        </div>
                    </div>
                    
                    @if($service->image)
                    <img src="{{ asset('storage/'.$service->image) }}" class="img-fluid rounded mb-4" alt="{{ $service->title }}">
                    @endif
                    
                    <div class="text-white-50" style="line-height:1.8;">
                        {!! nl2br(e($service->description)) !!}
                    </div>
                    
                    @if($service->features && count($service->features) > 0)
                    <h4 class="mt-5 mb-3">What's Included</h4>
                    <div class="row g-3">
                        @foreach($service->features as $feature)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2" style="color:var(--secondary);font-size:1.2rem;"></i>
                                <span>{{ $feature }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-4" data-aos="fade-left">
                <div class="glass p-4 sticky-top" style="top:100px;">
                    <h5 class="mb-3">Interested in this service?</h5>
                    <p class="text-white-50 small mb-4">Get a free consultation and quote for your project.</p>
                    
                    <a href="{{ route('frontend.order.create', $service->slug) }}" class="btn btn-primary-custom w-100 mb-3">
                        <i class="bi bi-cart-plus me-2"></i>Order Now
                    </a>
                    <a href="{{ route('frontend.contact') }}" class="btn btn-glass w-100 mb-3">
                        <i class="bi bi-chat-dots me-2"></i>Free Consultation
                    </a>
                    @if(!empty($whatsapp_number ?? ''))
                    <a href="https://wa.me/{{ str_replace(['+',' ','-'],'',$whatsapp_number ?? '') }}?text=Hi, I'm interested in {{ $service->title }}" class="btn btn-glass w-100" target="_blank">
                        <i class="bi bi-whatsapp me-2"></i>WhatsApp
                    </a>
                    @endif
                    
                    @if($service->price_min || $service->price_max)
                    <hr class="my-4" style="border-color:rgba(255,255,255,0.1);">
                    <h6 class="mb-2">Price Range</h6>
                    <p class="mb-0" style="color:var(--secondary);font-size:1.5rem;font-weight:700;">
                        @if($service->price_min && $service->price_max)
                            Rp {{ number_format($service->price_min) }} - {{ number_format($service->price_max) }}
                        @elseif($service->price_min)
                            From Rp {{ number_format($service->price_min) }}
                        @else
                            Up to Rp {{ number_format($service->price_max) }}
                        @endif
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection