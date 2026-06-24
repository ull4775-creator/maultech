@extends('layouts.frontend')
@section('title', 'Portfolio')

@section('content')
<section class="section" style="padding-top: 120px;">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">My <span>Portfolio Project</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">A collection of my best projects and works</p>
        
        <!-- Filter Buttons -->
        
        <div class="row g-4" id="portfolioGrid">
            @foreach($portfolios as $portfolio)
            <div class="col-lg-6 portfolio-item" data-category="{{ $portfolio->category }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <a href="{{ route('frontend.portfolio.show', $portfolio->slug) }}" class="text-decoration-none">
                    <div class="glass portfolio-card" style="overflow:hidden;transition:all 0.4s;">
                        <!-- Landscape Image -->
                        <div style="height:280px;overflow:hidden;">
                            @if($portfolio->image)
                            <img src="{{ asset('storage/'.$portfolio->image) }}" alt="{{ $portfolio->title }}" 
                                 style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s;">
                            @else
                            <div style="height:100%;background:var(--gradient-accent);display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-image" style="font-size:4rem;opacity:0.5;"></i>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge" style="background:rgba(230,126,34,0.2);color:var(--accent);border:1px solid var(--accent);">
                                    {{ ucfirst($portfolio->category) }}
                                </span>
                                @if($portfolio->client_name)
                                <small class="text-white-50"><i class="bi bi-person me-1"></i>{{ $portfolio->client_name }}</small>
                                @endif
                            </div>
                            
                            <h4 class="mb-2">{{ $portfolio->title }}</h4>
                            <p class="text-white-50 small mb-3">{{ Str::limit($portfolio->description, 100) }}</p>
                            
                            <!-- Tech Stack -->
                            @if($portfolio->tech_stack)
                            <div class="mb-3">
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach(explode(',', $portfolio->tech_stack) as $tech)
                                    <span class="badge" style="background:rgba(255,255,255,0.1);font-size:0.75rem;">{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                            <!-- Click Detail Button -->
                            <div class="text-center mt-3">
                                <span class="btn btn-primary-custom btn-sm" style="pointer-events:none;">
                                    <i class="bi bi-eye me-2"></i>Klik untuk detail
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ $portfolios->links() }}
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        document.querySelectorAll('.portfolio-item').forEach(item => {
            if(filter === 'all' || item.dataset.category === filter) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endpush