@extends('layouts.frontend')
@section('title', 'Order - '.$service->title)

@section('content')
<section class="py-5" style="padding-top:150px !important;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="glass p-4 p-md-5">
                    <h2 class="mb-2">Order Service</h2>
                    <p class="text-white-50 mb-4">Fill the form below to order <strong>{{ $service->title }}</strong></p>
                    
                    <div class="glass p-3 mb-4 d-flex align-items-center">
                        <div class="service-icon me-3" style="width:50px;height:50px;">
                            <i class="bi {{ $service->icon }}"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $service->title }}</h5>
                            @if($service->price_label)<small class="text-white-50">{{ $service->price_label }}</small>@endif
                        </div>
                    </div>
                    
                    <form action="{{ route('frontend.order.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Full Name *</label>
                                <input type="text" name="client_name" class="form-control form-control-glass @error('client_name') is-invalid @enderror" value="{{ old('client_name') }}" required>
                                @error('client_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Email *</label>
                                <input type="email" name="client_email" class="form-control form-control-glass @error('client_email') is-invalid @enderror" value="{{ old('client_email') }}" required>
                                @error('client_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Phone *</label>
                                <input type="text" name="client_phone" class="form-control form-control-glass @error('client_phone') is-invalid @enderror" value="{{ old('client_phone') }}" required>
                                @error('client_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Address</label>
                                <input type="text" name="client_address" class="form-control form-control-glass" value="{{ old('client_address') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-white-50">Project Description *</label>
                                <textarea name="description" class="form-control form-control-glass @error('description') is-invalid @enderror" rows="5" required placeholder="Describe what you need...">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom w-100">
                                    <i class="bi bi-cart-check me-2"></i>Submit Order
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection