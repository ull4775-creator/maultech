@section('title', 'Contact')  
@extends('layouts.frontend')  
@section('title', 'Contact')  
@section('content')
<section class="py-5" style="padding-top:150px !important;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-up">Get In Touch</h1>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Have a project in mind? Let's discuss it!</p>
        
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="glass p-4 h-100">
                    <h4 class="mb-4">Contact Information</h4>
                    
                    @if($contact_email)
                    <div class="d-flex align-items-center mb-4">
                        <div class="service-icon me-3" style="width:50px;height:50px;font-size:1.3rem;">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <small class="text-white-50">Email</small>
                            <h6 class="mb-0">{{ $contact_email }}</h6>
                        </div>
                    </div>
                    @endif
                    
                    @if($contact_phone)
                    <div class="d-flex align-items-center mb-4">
                        <div class="service-icon me-3" style="width:50px;height:50px;font-size:1.3rem;">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div>
                            <small class="text-white-50">Phone</small>
                            <h6 class="mb-0">{{ $contact_phone }}</h6>
                        </div>
                    </div>
                    @endif
                    
                    @if($contact_address)
                    <div class="d-flex align-items-center mb-4">
                        <div class="service-icon me-3" style="width:50px;height:50px;font-size:1.3rem;">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <small class="text-white-50">Address</small>
                            <h6 class="mb-0">{{ $contact_address }}</h6>
                        </div>
                    </div>
                    @endif
                    
                    @if($whatsapp_number)
                    <a href="https://wa.me/{{ str_replace(['+',' ','-'],'',$whatsapp_number) }}" class="btn btn-glass w-100 mt-3" target="_blank">
                        <i class="bi bi-whatsapp me-2"></i>Chat on WhatsApp
                    </a>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-7" data-aos="fade-left">
                <div class="glass p-4 p-md-5">
                    <h4 class="mb-4">Send Message</h4>
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show glass" style="background:rgba(25,135,84,0.2);border-color:rgba(25,135,84,0.5);">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    <form action="{{ route('frontend.contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Full Name *</label>
                                <input type="text" name="name" class="form-control form-control-glass @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="John Doe">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Email *</label>
                                <input type="email" name="email" class="form-control form-control-glass @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="john@example.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Phone</label>
                                <input type="text" name="phone" class="form-control form-control-glass" value="{{ old('phone') }}" placeholder="+62 812 xxxx xxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-white-50">Service Type</label>
                                <select name="service_type" class="form-control form-control-glass">
                                    <option value="">Select Service</option>
                                    <option value="web">Web Development</option>
                                    <option value="cctv">CCTV Installation</option>
                                    <option value="hardware">Laptop/Hardware Service</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-white-50">Subject</label>
                                <input type="text" name="subject" class="form-control form-control-glass" value="{{ old('subject') }}" placeholder="Project discussion">
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-white-50">Message *</label>
                                <textarea name="message" class="form-control form-control-glass @error('message') is-invalid @enderror" rows="5" required placeholder="Tell me about your project...">{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom w-100">
                                    <i class="bi bi-send me-2"></i>Send Message
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
