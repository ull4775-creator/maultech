@extends('layouts.admin')
@section('title', isset($portfolio) ? 'Edit Portfolio' : 'Add Portfolio')
@section('page-title', isset($portfolio) ? 'Edit Portfolio' : 'Add New Portfolio')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ isset($portfolio) ? route('admin.portfolio.update', $portfolio) : route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($portfolio)) @method('PUT') @endif
                
                <div class="mb-3">
                    <label class="form-label">Project Title *</label>
                    <input type="text" name="title" class="form-control form-control-admin @error('title') is-invalid @enderror" 
                           value="{{ old('title', $portfolio->title ?? '') }}" required placeholder="E-Commerce Website">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-white-50">Judul project (wajib)</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control form-control-admin" rows="4" placeholder="Deskripsi singkat project...">{{ old('description', $portfolio->description ?? '') }}</textarea>
                    <small class="text-white-50">Deskripsi project (opsional)</small>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-control form-control-admin">
                            <option value="web" @selected(old('category', $portfolio->category ?? 'web') == 'web')>Web Development</option>
                            <option value="cctv" @selected(old('category', $portfolio->category ?? '') == 'cctv')>CCTV Installation</option>
                            <option value="hardware" @selected(old('category', $portfolio->category ?? '') == 'hardware')>Hardware</option>
                            <option value="other" @selected(old('category', $portfolio->category ?? '') == 'other')>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Client Name</label>
                        <input type="text" name="client_name" class="form-control form-control-admin" 
                               value="{{ old('client_name', $portfolio->client_name ?? '') }}" placeholder="PT. Example">
                    </div>
                </div>
                
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Start Date</label>
                        <input type="text" name="start_date" class="form-control form-control-admin" 
                               value="{{ old('start_date', $portfolio->start_date ?? '') }}" placeholder="Jan 2024">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <input type="text" name="end_date" class="form-control form-control-admin" 
                               value="{{ old('end_date', $portfolio->end_date ?? '') }}" placeholder="Mar 2024">
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Tech Stack (comma separated)</label>
                    <input type="text" name="tech_stack" class="form-control form-control-admin" 
                           value="{{ old('tech_stack', $portfolio->tech_stack ?? '') }}" placeholder="Laravel, React, MySQL">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Tech Stack Detail</label>
                    <div id="techStackContainer">
                        @php
                            $techs = old('tech_stack_detail', $portfolio->tech_stack_detail ?? []);
                            if(empty($techs)) $techs = [''];
                        @endphp
                        @foreach($techs as $tech)
                        <div class="tech-item mb-2">
                            <div class="input-group">
                                <input type="text" name="tech_stack_detail[]" class="form-control form-control-admin" 
                                       value="{{ $tech }}" placeholder="Contoh: Laravel 10">
                                <button type="button" class="btn btn-danger remove-item"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-glass-admin btn-sm mt-2" id="addTech">
                        <i class="bi bi-plus-lg me-1"></i>Add Tech
                    </button>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Features</label>
                    <div id="featuresContainer">
                        @php
                            $features = old('features', $portfolio->features ?? []);
                            if(empty($features)) $features = [''];
                        @endphp
                        @foreach($features as $feature)
                        <div class="feature-item mb-2">
                            <div class="input-group">
                                <input type="text" name="features[]" class="form-control form-control-admin" 
                                       value="{{ $feature }}" placeholder="Contoh: Responsive Design">
                                <button type="button" class="btn btn-danger remove-item"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-glass-admin btn-sm mt-2" id="addFeature">
                        <i class="bi bi-plus-lg me-1"></i>Add Feature
                    </button>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Demo Link</label>
                        <input type="text" name="link_demo" class="form-control form-control-admin" 
                               value="{{ old('link_demo', $portfolio->link_demo ?? '') }}" placeholder="https://...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">GitHub Link</label>
                        <input type="text" name="link_github" class="form-control form-control-admin" 
                               value="{{ old('link_github', $portfolio->link_github ?? '') }}" placeholder="https://github.com/...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Project URL</label>
                        <input type="text" name="project_url" class="form-control form-control-admin" 
                               value="{{ old('project_url', $portfolio->project_url ?? '') }}" placeholder="https://...">
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Cover Image</label>
                    @if(isset($portfolio) && $portfolio->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$portfolio->image) }}" style="max-height:150px;border-radius:8px;">
                    </div>
                    @endif
                    <input type="file" name="image" class="form-control form-control-admin" accept="image/*">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Gallery Images (Multiple)</label>
                    @if(isset($portfolio) && $portfolio->images)
                    <div class="mb-2 d-flex gap-2 flex-wrap">
                        @foreach($portfolio->images as $img)
                        <img src="{{ asset('storage/'.$img) }}" style="max-height:100px;border-radius:8px;">
                        @endforeach
                    </div>
                    @endif
                    <input type="file" name="images[]" class="form-control form-control-admin" accept="image/*" multiple>
                    <small class="text-white-50">Upload banyak gambar untuk gallery</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Challenge (Tantangan)</label>
                    <textarea name="challenge" class="form-control form-control-admin" rows="3" placeholder="Apa tantangan dalam project ini?">{{ old('challenge', $portfolio->challenge ?? '') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Solution (Solusi)</label>
                    <textarea name="solution" class="form-control form-control-admin" rows="3" placeholder="Bagaimana Anda menyelesaikannya?">{{ old('solution', $portfolio->solution ?? '') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Result (Hasil)</label>
                    <textarea name="result" class="form-control form-control-admin" rows="3" placeholder="Apa hasil yang dicapai?">{{ old('result', $portfolio->result ?? '') }}</textarea>
                </div>
                
                <div class="d-flex gap-3 mt-4">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" value="1" @checked(old('is_featured', $portfolio->is_featured ?? false))>
                        <label class="form-check-label" for="isFeatured">Featured (tampilkan di home)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" id="isPublished" value="1" @checked(old('is_published', $portfolio->is_published ?? true))>
                        <label class="form-check-label" for="isPublished">Published</label>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin"><i class="bi bi-save me-2"></i>Save</button>
                    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Tips</h6>
            <ul class="text-white-50 small">
                <li class="mb-2">✓ Hanya <strong>Title</strong> yang wajib</li>
                <li class="mb-2">✓ Semua field lain bersifat <strong>opsional</strong></li>
                <li class="mb-2">✓ Cover image untuk thumbnail</li>
                <li class="mb-2">✓ Gallery images untuk slideshow</li>
                <li class="mb-2">✓ Tech stack detail untuk detail teknologi</li>
                <li>✓ Featured akan muncul di homepage</li>
            </ul>
        </div>
    </div>
</div>

<script>
// Add tech stack
document.getElementById('addTech').addEventListener('click', function() {
    const container = document.getElementById('techStackContainer');
    const newItem = document.createElement('div');
    newItem.className = 'tech-item mb-2';
    newItem.innerHTML = `<div class="input-group"><input type="text" name="tech_stack_detail[]" class="form-control form-control-admin" placeholder="Contoh: Laravel 10"><button type="button" class="btn btn-danger remove-item"><i class="bi bi-trash"></i></button></div>`;
    container.appendChild(newItem);
});

// Add feature
document.getElementById('addFeature').addEventListener('click', function() {
    const container = document.getElementById('featuresContainer');
    const newItem = document.createElement('div');
    newItem.className = 'feature-item mb-2';
    newItem.innerHTML = `<div class="input-group"><input type="text" name="features[]" class="form-control form-control-admin" placeholder="Contoh: Responsive Design"><button type="button" class="btn btn-danger remove-item"><i class="bi bi-trash"></i></button></div>`;
    container.appendChild(newItem);
});

// Remove item
document.addEventListener('click', function(e) {
    if(e.target.closest('.remove-item')) {
        e.target.closest('.tech-item, .feature-item').remove();
    }
});
</script>
@endsection