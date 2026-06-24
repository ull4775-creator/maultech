@extends('layouts.frontend')
@section('title', $portfolio->title)

@section('content')
<section class="section" style="padding-top: 120px; padding-bottom: 80px;">
    <div class="container">
        <!-- Back Button - Visible -->
        <div class="mb-4">
            <a href="{{ route('frontend.portfolio') }}" class="btn btn-glass-admin">
                <i class="bi bi-arrow-left me-2"></i>Back to Portfolio
            </a>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Image Gallery -->
                <div class="glass mb-4" style="overflow:hidden;">
                    @php
                        $allImages = [];
                        if($portfolio->image) $allImages[] = $portfolio->image;
                        if($portfolio->images) $allImages = array_merge($allImages, $portfolio->images);
                    @endphp
                    
                    @if(count($allImages) > 0)
                    <div class="portfolio-carousel position-relative" style="height:450px;">
                        <div class="carousel-slides" style="display:flex;transition:transform 0.5s ease;height:100%;">
                            @foreach($allImages as $img)
                            <div style="min-width:100%;height:100%;">
                                <img src="{{ asset('storage/'.$img) }}" alt="{{ $portfolio->title }}" 
                                     style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            @endforeach
                        </div>
                        
                        @if(count($allImages) > 1)
                        <button class="carousel-prev" onclick="slideCarousel(this, -1)" 
                                style="position:absolute;left:10px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.5);color:white;border:none;border-radius:50%;width:40px;height:40px;cursor:pointer;z-index:10;">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="carousel-next" onclick="slideCarousel(this, 1)" 
                                style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.5);color:white;border:none;border-radius:50%;width:40px;height:40px;cursor:pointer;z-index:10;">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        @endif
                    </div>
                    @endif
                </div>
                
                <!-- Project Details -->
                <div class="glass p-4 mb-4">
                    <h4 class="mb-3" style="color:var(--accent);"><i class="bi bi-info-circle me-2"></i>Project Details</h4>
                    
                    <div class="row g-3">
                        @if($portfolio->client_name)
                        <div class="col-md-6">
                            <small class="text-white-50 d-block mb-1">Client</small>
                            <strong>{{ $portfolio->client_name }}</strong>
                        </div>
                        @endif
                        
                        @if($portfolio->start_date || $portfolio->end_date)
                        <div class="col-md-6">
                            <small class="text-white-50 d-block mb-1">Timeline</small>
                            <strong>{{ $portfolio->start_date ?? '-' }} - {{ $portfolio->end_date ?? 'Present' }}</strong>
                        </div>
                        @endif
                        
                        @if($portfolio->tech_stack)
                        <div class="col-12">
                            <small class="text-white-50 d-block mb-2">Technologies Used</small>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(explode(',', $portfolio->tech_stack) as $tech)
                                <span class="badge" style="background:rgba(230,126,34,0.2);color:var(--accent);border:1px solid var(--accent);">
                                    {{ trim($tech) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        @if($portfolio->tech_stack_detail && count($portfolio->tech_stack_detail) > 0)
                        <div class="col-12">
                            <small class="text-white-50 d-block mb-2">Tech Details</small>
                            <ul class="list-unstyled mb-0">
                                @foreach($portfolio->tech_stack_detail as $tech)
                                <li class="mb-1"><i class="bi bi-check2 me-2" style="color:var(--accent);"></i>{{ $tech }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Challenge, Solution, Result -->
                @if($portfolio->challenge || $portfolio->solution || $portfolio->result)
                <div class="glass p-4 mb-4">
                    <h4 class="mb-3" style="color:var(--accent);"><i class="bi bi-journal-text me-2"></i>Project Story</h4>
                    
                    @if($portfolio->challenge)
                    <div class="mb-4">
                        <h6 class="small mb-2" style="color:var(--accent);">
                            <i class="bi bi-exclamation-triangle me-1"></i>Challenge
                        </h6>
                        <p class="text-white-50 mb-0">{{ $portfolio->challenge }}</p>
                    </div>
                    @endif
                    
                    @if($portfolio->solution)
                    <div class="mb-4">
                        <h6 class="small mb-2" style="color:var(--accent);">
                            <i class="bi bi-lightbulb me-1"></i>Solution
                        </h6>
                        <p class="text-white-50 mb-0">{{ $portfolio->solution }}</p>
                    </div>
                    @endif
                    
                    @if($portfolio->result)
                    <div>
                        <h6 class="small mb-2" style="color:var(--accent);">
                            <i class="bi bi-trophy me-1"></i>Result
                        </h6>
                        <p class="text-white-50 mb-0">{{ $portfolio->result }}</p>
                    </div>
                    @endif
                </div>
                @endif
                
                <!-- Features -->
                @if($portfolio->features && count($portfolio->features) > 0)
                <div class="glass p-4">
                    <h4 class="mb-3" style="color:var(--accent);"><i class="bi bi-check-circle me-2"></i>Key Features</h4>
                    <div class="row g-3">
                        @foreach($portfolio->features as $feature)
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-check2-all mt-1" style="color:var(--accent);"></i>
                                <span class="text-white-50">{{ $feature }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Info -->
                <div class="glass p-4 mb-4 sticky-top" style="top:100px;">
                    <h5 class="mb-3">Project Info</h5>
                    
                    @if($portfolio->category)
                    <div class="mb-3">
                        <small class="text-white-50 d-block mb-1">Category</small>
                        <span class="badge" style="background:rgba(230,126,34,0.2);color:var(--accent);border:1px solid var(--accent);">
                            {{ ucfirst($portfolio->category) }}
                        </span>
                    </div>
                    @endif
                    
                    @if($portfolio->views)
                    <div class="mb-3">
                        <small class="text-white-50 d-block mb-1">Views</small>
                        <strong><i class="bi bi-eye me-1"></i>{{ number_format($portfolio->views) }}</strong>
                    </div>
                    @endif
                    
                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 mt-4">
                        @if($portfolio->link_demo)
                        <a href="{{ $portfolio->link_demo }}" class="btn btn-primary-custom" target="_blank">
                            <i class="bi bi-box-arrow-up-right me-2"></i>Live Demo
                        </a>
                        @endif
                        
                        @if($portfolio->link_github)
                        <a href="{{ $portfolio->link_github }}" class="btn btn-glass-admin" target="_blank">
                            <i class="bi bi-github me-2"></i>View on GitHub
                        </a>
                        @endif
                        
                        @if($portfolio->project_url)
                        <a href="{{ $portfolio->project_url }}" class="btn btn-outline-custom" target="_blank">
                            <i class="bi bi-link-45deg me-2"></i>Visit Website
                        </a>
                        @endif
                    </div>
                    
                    <!-- Back Button - Visible -->
                    <div class="mt-3">
                        <a href="{{ route('frontend.portfolio') }}" class="btn btn-glass-admin w-100">
                            <i class="bi bi-arrow-left me-2"></i>Back to Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Carousel functionality
let currentIndex = 0;
const slides = document.querySelector('.carousel-slides');
const totalSlides = document.querySelectorAll('.carousel-slides > div').length;

function slideCarousel(btn, direction) {
    currentIndex += direction;
    if(currentIndex < 0) currentIndex = totalSlides - 1;
    if(currentIndex >= totalSlides) currentIndex = 0;
    updateCarousel();
}

function updateCarousel() {
    if(slides) {
        slides.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
}

// Auto-slide
setInterval(() => {
    if(totalSlides > 1) {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateCarousel();
    }
}, 5000);
</script>
@endpush