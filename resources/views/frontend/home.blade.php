@extends('layouts.frontend')
@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="hero-badge">
                    <span class="badge bg-success rounded-pill me-2">Available</span>
                    Available for freelance projects
                </div>
                <h1 class="hero-title">
                    Hello, <span class="highlight">{{ $hero_title }}</span>
                </h1>
                <p class="hero-subtitle">{{ $hero_subtitle }}</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('frontend.contact') }}" class="btn-primary-custom">
                        <i class="bi bi-chat-dots me-2"></i>Hubungi Saya
                    </a>
                    <a href="{{ route('frontend.services') }}" class="btn-outline-custom">
                        <i class="bi bi-grid me-2"></i>Lihat Layanan
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ $services->count() }}+</div>
                        <div class="stat-label">Projects</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $testimonials->count() * 10 }}+</div>
                        <div class="stat-label">Clients</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $experiences->count() }}+</div>
                        <div class="stat-label">Years Exp</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center" data-aos="fade-left">
    <div class="col-lg-5 text-center" data-aos="fade-left">
    <div class="hero-image">
        @php
            $profileSrc = null;
            if(!empty($profile_photo) && file_exists(storage_path('app/public/' . $profile_photo))) {
                $profileSrc = asset('storage/' . $profile_photo);
            } elseif(!empty($hero_image) && file_exists(storage_path('app/public/' . $hero_image))) {
                $profileSrc = asset('storage/' . $hero_image);
            } else {
                $profileSrc = asset('maultechlogo/maultechlogo.png');
            }
        @endphp
        <img src="{{ $profileSrc }}" alt="Profile" style="max-width:400px;width:100%;border-radius:20px;box-shadow:0 20px 50px rgba(230,126,34,0.3);" onerror="this.src='https://ui-avatars.com/api/?name=Maul+Tech&size=400&background=e67e22&color=fff&bold=true'">
    </div>
</div>
</div>
        </div>
        <div class="scroll-indicator">
            <i class="bi bi-chevron-down"></i> Scroll Down
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section" id="about">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Get To Know</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">About Me</p>
        
        <div class="row g-4">
            <div class="col-lg-8 mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div class="glass p-5">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="glass p-4 d-inline-block">
                                <div style="width:180px;height:180px;background:var(--gradient-2);border-radius:24px;display:flex;align-items:center;justify-content:center;margin:0 auto;">
                                    <span style="font-size:4rem;font-weight:900;">2+</span>
                                </div>
                                <h5 class="mt-3">Tahun</h5>
                                <p class="text-white-50 small">Pengalaman</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">Full Stack Developer & IT Technician</h4>
                            <p class="text-white-50 mb-4">{{ $about_text ?? 'Membantu bisnis dan individu memanfaatkan teknologi secara optimal adalah passion saya. Sebagai Developer dan Teknisi IT yang berpengalaman, saya menyediakan layanan pengembangan website serta dukungan teknis komputer yang andal.' }}</p>
                            
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:50px;height:50px;background:rgba(0,212,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                            <i class="bi bi-person" style="color:var(--accent);font-size:1.3rem;"></i>
                                        </div>
                                        <div>
                                            <div class="text-white-50 small">Nama</div>
                                            <div class="fw-bold">Admin</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:50px;height:50px;background:rgba(0,212,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                            <i class="bi bi-envelope" style="color:var(--accent);font-size:1.3rem;"></i>
                                        </div>
                                        <div>
                                            <div class="text-white-50 small">Email</div>
                                            <div class="fw-bold small">{{ $contact_email ?? 'admin@portfolio.com' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:50px;height:50px;background:rgba(0,212,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                            <i class="bi bi-phone" style="color:var(--accent);font-size:1.3rem;"></i>
                                        </div>
                                        <div>
                                            <div class="text-white-50 small">Telepon</div>
                                            <div class="fw-bold">{{ $contact_phone ?? '+62 812 3456 7890' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:50px;height:50px;background:rgba(0,212,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                            <i class="bi bi-geo-alt" style="color:var(--accent);font-size:1.3rem;"></i>
                                        </div>
                                        <div>
                                            <div class="text-white-50 small">Lokasi</div>
                                            <div class="fw-bold">{{ $contact_address ?? 'Jakarta, Indonesia' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
@if($skills->count() > 0)
<section class="section" id="skills" style="background: rgba(10, 14, 39, 0.5);">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">My Abilities</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Skills & Expertise</p>
        
        <div class="row g-4">
            <div class="col-lg-10 mx-auto">
                <div class="glass p-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        @foreach($skills as $index => $skill)
                        <div class="col-md-6">
                            <div class="skill-item">
                                <div class="skill-header">
                                    <span class="skill-name">
                                        @if($skill->icon)<i class="bi {{ $skill->icon }} me-2"></i>@endif
                                        {{ $skill->name }}
                                    </span>
                                    <span class="skill-percentage">{{ $skill->level }}%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-progress" data-width="{{ $skill->level }}" style="width:0%;"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Certifications Section -->
@if($certifications->count() > 0)
<section class="section" id="certifications" style="background: rgba(10, 14, 26, 0.5);">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">My <span>Certifications</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Professional Certificates & Achievements</p>
        
        <div class="row g-4">
            @foreach($certifications as $index => $cert)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="glass p-4 h-100">
                    <div class="d-flex align-items-start gap-3">
                        <div style="width:60px;height:60px;background:rgba(230,126,34,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi {{ $cert->icon ?? 'bi-patch-check-fill' }}" style="font-size:2rem;color:var(--accent);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-2" style="color:var(--accent);">{{ $cert->name }}</h5>
                            @if($cert->issuer || $cert->position)
                            <div class="mb-2">
                                @if($cert->issuer)
                                <div class="text-white-50 small"><i class="bi bi-building me-2"></i>{{ $cert->issuer }}</div>
                                @endif
                                @if($cert->position)
                                <div class="text-white-50 small"><i class="bi bi-briefcase me-2"></i>{{ $cert->position }}</div>
                                @endif
                            </div>
                            @endif
                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                @if($cert->level)
                                <span class="badge" style="background:rgba(230,126,34,0.2);color:var(--accent);border:1px solid var(--accent);">
                                    <i class="bi bi-award me-1"></i>{{ $cert->level }}
                                </span>
                                @endif
                                @if($cert->year)
                                <span class="badge" style="background:rgba(255,255,255,0.1);">
                                    <i class="bi bi-calendar me-1"></i>{{ $cert->year }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


<!-- Portfolio Section -->
<section class="section" id="portfolio">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">My <span>Portfolio Project</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Showcasing my best work across web development, CCTV, and hardware</p>
        
        <div class="row g-4">
            @foreach($featured_portfolios as $index => $portfolio)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="glass portfolio-card" style="overflow:hidden;">
                    <!-- Image Carousel -->
                    <div class="portfolio-carousel position-relative" style="height:300px;overflow:hidden;">
                        @php
                            $allImages = [];
                            if($portfolio->image) $allImages[] = $portfolio->image;
                            if($portfolio->images) $allImages = array_merge($allImages, $portfolio->images);
                        @endphp
                        
                        @if(count($allImages) > 0)
                        <div class="carousel-slides" style="display:flex;transition:transform 0.5s ease;height:100%;">
                            @foreach($allImages as $img)
                            <div style="min-width:100%;height:100%;">
                                <img src="{{ asset('storage/'.$img) }}" alt="{{ $portfolio->title }}" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            @endforeach
                        </div>
                        
                        @if(count($allImages) > 1)
                        <button class="carousel-prev" onclick="slideCarousel(this, -1)" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.5);color:white;border:none;border-radius:50%;width:40px;height:40px;cursor:pointer;z-index:10;">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="carousel-next" onclick="slideCarousel(this, 1)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.5);color:white;border:none;border-radius:50%;width:40px;height:40px;cursor:pointer;z-index:10;">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        <div class="carousel-dots" style="position:absolute;bottom:10px;left:50%;transform:translateX(-50%);display:flex;gap:5px;">
                            @foreach($allImages as $i => $img)
                            <span class="dot {{ $i == 0 ? 'active' : '' }}" onclick="goToSlide(this, {{ $i }})" style="width:10px;height:10px;border-radius:50%;background:rgba(255,255,255,0.5);cursor:pointer;"></span>
                            @endforeach
                        </div>
                        @endif
                        @else
                        <div style="height:100%;background:var(--gradient-accent);display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-image" style="font-size:4rem;opacity:0.5;"></i>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge" style="background:rgba(230,126,34,0.2);color:var(--accent);border:1px solid var(--accent);">{{ ucfirst($portfolio->category) }}</span>
                            @if($portfolio->client_name)
                            <small class="text-white-50"><i class="bi bi-person me-1"></i>{{ $portfolio->client_name }}</small>
                            @endif
                        </div>
                        
                        <h4 class="mb-2">{{ $portfolio->title }}</h4>
                        <p class="text-white-50 small mb-3">{{ Str::limit($portfolio->description, 120) }}</p>
                        
                        <!-- Tech Stack -->
                        @if($portfolio->tech_stack)
                        <div class="mb-3">
                            <small class="text-white-50 d-block mb-2"><i class="bi bi-code-slash me-1"></i>Dikembangkan dengan:</small>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach(explode(',', $portfolio->tech_stack) as $tech)
                                <span class="badge" style="background:rgba(255,255,255,0.1);font-size:0.75rem;">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Expand Button -->
                        <button class="btn btn-glass-admin btn-sm w-100 mt-2" onclick="toggleDetail(this)" data-id="{{ $portfolio->id }}">
                            <i class="bi bi-chevron-down me-1"></i>Lihat Detail
                        </button>
                        
                        <!-- Detail Content (Hidden by default) -->
                        <div class="portfolio-detail" id="detail-{{ $portfolio->id }}" style="max-height:0;overflow:hidden;transition:max-height 0.5s ease;">
                            <div class="mt-3 pt-3" style="border-top:1px solid var(--glass-border);">
                                @if($portfolio->features && count($portfolio->features) > 0)
                                <div class="mb-3">
                                    <h6 class="small" style="color:var(--accent);"><i class="bi bi-check-circle me-1"></i>Fitur Utama:</h6>
                                    <ul class="list-unstyled small text-white-50">
                                        @foreach($portfolio->features as $feature)
                                        <li class="mb-1"><i class="bi bi-check2 me-1" style="color:var(--accent);"></i>{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                
                                @if($portfolio->challenge)
                                <div class="mb-3">
                                    <h6 class="small" style="color:var(--accent);"><i class="bi bi-exclamation-triangle me-1"></i>Tantangan:</h6>
                                    <p class="small text-white-50 mb-0">{{ $portfolio->challenge }}</p>
                                </div>
                                @endif
                                
                                @if($portfolio->solution)
                                <div class="mb-3">
                                    <h6 class="small" style="color:var(--accent);"><i class="bi bi-lightbulb me-1"></i>Solusi:</h6>
                                    <p class="small text-white-50 mb-0">{{ $portfolio->solution }}</p>
                                </div>
                                @endif
                                
                                @if($portfolio->result)
                                <div class="mb-3">
                                    <h6 class="small" style="color:var(--accent);"><i class="bi bi-trophy me-1"></i>Hasil:</h6>
                                    <p class="small text-white-50 mb-0">{{ $portfolio->result }}</p>
                                </div>
                                @endif
                                
                                <div class="d-flex gap-2 mt-3">
                                    @if($portfolio->link_demo)
                                    <a href="{{ $portfolio->link_demo }}" class="btn btn-primary-custom btn-sm flex-grow-1" target="_blank">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>Live Demo
                                    </a>
                                    @endif
                                    @if($portfolio->link_github)
                                    <a href="{{ $portfolio->link_github }}" class="btn btn-outline-custom btn-sm flex-grow-1" target="_blank">
                                        <i class="bi bi-github me-1"></i>GitHub
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('frontend.portfolio') }}" class="btn-primary-custom">
                View All Projects <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>




<!-- Education Section -->
@if($educations->count() > 0)
<section class="section" id="education" style="background: rgba(10, 14, 26, 0.5);">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">My <span>Education</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Educational Background</p>
        
        <div class="row g-4">
            <div class="col-lg-8 mx-auto">
                <div class="timeline">
                    @foreach($educations as $index => $edu)
                    <div class="glass timeline-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <span class="timeline-year">{{ $edu->year_start }} - {{ $edu->year_end ?? 'Present' }}</span>
                        <h4 class="mb-2">{{ $edu->degree }}</h4>
                        <h6 class="text-white-50 mb-3"><i class="bi bi-building me-2"></i>{{ $edu->institution }}</h6>
                        @if($edu->description)<p class="text-white-50">{{ $edu->description }}</p>@endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Experience Section -->

<!-- Experience Section -->
@if($experiences->count() > 0)
<section class="section" id="experience">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">My Journey</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Work Experience</p>
        
        <div class="row g-4">
            <div class="col-lg-8 mx-auto">
                <div class="timeline">
                    @foreach($experiences as $index => $exp)
                    <div class="glass timeline-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <span class="timeline-year">{{ $exp->year_start }} - {{ $exp->year_end ?? 'Present' }}</span>
                        <h4 class="mb-2">{{ $exp->position }}</h4>
                        <h6 class="text-white-50 mb-3"><i class="bi bi-building me-2"></i>{{ $exp->company }}</h6>
                        @if($exp->description)<p class="text-white-50">{{ $exp->description }}</p>@endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Services Section -->
<section class="section" id="services" style="background: rgba(10, 14, 39, 0.5);">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">What I Offer</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">My Services</p>
        
        <div class="row g-4">
            @foreach($services as $index => $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="glass service-card">
                    <span class="service-icon">{{ $service->icon == 'bi-camera-video' ? '📹' : ($service->icon == 'bi-code-slash' ? '💻' : '🔧') }}</span>
                    <h4 class="mb-3">{{ $service->title }}</h4>
                    <p class="text-white-50 mb-3">{{ Str::limit($service->description, 120) }}</p>
                    <div class="service-price">{{ $service->price_label ?? 'Tergantung Kebutuhan' }}</div>
                    <a href="{{ route('frontend.order.create', $service->slug) }}" class="btn-primary-custom w-100 text-center">
                        Order Now
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Contact Section -->
<section class="section" id="contact" style="background: rgba(10, 14, 39, 0.5);">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Get In Touch</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Contact Me</p>
        
        <div class="row g-4">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="glass p-5 h-100">
                    <h4 class="mb-4">Let's Talk About Your Project!</h4>
                    <p class="text-white-50 mb-4">Hubungi saya untuk konsultasi gratis mengenai kebutuhan IT Anda. Saya siap membantu 24/7!</p>
                    
                    @if($contact_email)
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width:55px;height:55px;background:rgba(0,212,255,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-envelope" style="color:var(--accent);font-size:1.5rem;"></i>
                        </div>
                        <div>
                            <div class="text-white-50 small">Email</div>
                            <div class="fw-bold">{{ $contact_email }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($contact_phone)
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width:55px;height:55px;background:rgba(0,212,255,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-phone" style="color:var(--accent);font-size:1.5rem;"></i>
                        </div>
                        <div>
                            <div class="text-white-50 small">Phone</div>
                            <div class="fw-bold">{{ $contact_phone }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($whatsapp_number)
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width:55px;height:55px;background:rgba(0,212,255,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-whatsapp" style="color:var(--accent);font-size:1.5rem;"></i>
                        </div>
                        <div>
                            <div class="text-white-50 small">WhatsApp</div>
                            <div class="fw-bold">{{ $whatsapp_number }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($contact_address)
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:55px;height:55px;background:rgba(0,212,255,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-geo-alt" style="color:var(--accent);font-size:1.5rem;"></i>
                        </div>
                        <div>
                            <div class="text-white-50 small">Location</div>
                            <div class="fw-bold">{{ $contact_address }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-7" data-aos="fade-left">
                <div class="glass p-5">
                    <h4 class="mb-4">Send Message</h4>
                    
                    @if(session('success'))
                    <div class="alert" style="background:rgba(25,135,84,0.2);border:1px solid rgba(25,135,84,0.5);color:#75b798;border-radius:12px;padding:12px 20px;">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    </div>
                    @endif
                    
                    <form action="{{ route('frontend.contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control-glass w-100" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control-glass w-100" placeholder="Your Email" required>
                            </div>
                            <div class="col-12">
                                <input type="text" name="subject" class="form-control-glass w-100" placeholder="Subject">
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control-glass w-100" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-primary-custom w-100">
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