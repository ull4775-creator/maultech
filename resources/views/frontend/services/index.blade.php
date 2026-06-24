@section('title', 'Services')  
@extends('layouts.frontend')  
@section('title', 'Services')  

@section('content')
<section class="py-5" style="padding-top:150px !important;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-up">Our Services</h1>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Professional solutions tailored to your needs</p>
        
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="glass service-card">
                    <div class="service-icon">
                        <i class="bi {{ $service->icon }}"></i>
                    </div>
                    <h4 class="mb-3">{{ $service->title }}</h4>
                    <p class="text-white-50 mb-3">{{ Str::limit($service->description, 150) }}</p>
                    
                    @if($service->features)
                    <ul class="list-unstyled mb-3">
                        @foreach($service->features as $feature)
                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2" style="color:var(--secondary)"></i>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                    
                    @if($service->price_label)
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $service->price_label }}</span>
                    </div>
                    @endif
                    
                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('frontend.services.show', $service->slug) }}" class="btn btn-glass btn-sm flex-grow-1">
                            Details
                        </a>
                        <a href="{{ route('frontend.order.create', $service->slug) }}" class="btn btn-primary-custom btn-sm flex-grow-1">
                            Order
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
