@extends('layouts.admin')
@section('title', isset($service) ? 'Edit Service' : 'Add Service')
@section('page-title', isset($service) ? 'Edit Service' : 'Add New Service')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ isset($service) ? route('admin.service.update', $service) : route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($service)) @method('PUT') @endif
                
                <div class="mb-3">
                    <label class="form-label">Service Title *</label>
                    <input type="text" name="title" class="form-control form-control-admin @error('title') is-invalid @enderror" 
                           value="{{ old('title', $service->title ?? '') }}" required placeholder="Web Development / CCTV Installation">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-white-50">Nama layanan (wajib)</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control form-control-admin @error('description') is-invalid @enderror" rows="4" required placeholder="Deskripsi lengkap tentang layanan Anda...">{{ old('description', $service->description ?? '') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Icon (Bootstrap Icon class)</label>
                        <input type="text" name="icon" class="form-control form-control-admin" 
                               value="{{ old('icon', $service->icon ?? 'bi-gear') }}" placeholder="bi-code-slash">
                        <small class="text-white-50">Cari icon di: <a href="https://icons.getbootstrap.com" target="_blank" class="text-info">icons.getbootstrap.com</a></small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control form-control-admin" required>
                            <option value="active" @selected(old('status', $service->status ?? 'active') == 'active')>Active (tampilkan)</option>
                            <option value="inactive" @selected(old('status', $service->status ?? '') == 'inactive')>Inactive (sembunyikan)</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Service Image</label>
                    @if(isset($service) && $service->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$service->image) }}" style="max-height:150px;border-radius:10px;">
                    </div>
                    @endif
                    <input type="file" name="image" class="form-control form-control-admin" accept="image/*">
                    <small class="text-white-50">Gambar layanan (opsional)</small>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Price Label</label>
                        <input type="text" name="price_label" class="form-control form-control-admin" 
                               value="{{ old('price_label', $service->price_label ?? '') }}" placeholder="Start from Rp 2jt">
                        <small class="text-white-50">Label harga (contoh: "Start from Rp 2jt")</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control form-control-admin" 
                               value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0">
                        <small class="text-white-50">Urutan tampilan (angka kecil = muncul duluan)</small>
                    </div>
                </div>
                
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Price Min (Rp)</label>
                        <input type="number" name="price_min" class="form-control form-control-admin" 
                               value="{{ old('price_min', $service->price_min ?? '') }}" placeholder="2000000">
                        <small class="text-white-50">Harga minimum (opsional)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Price Max (Rp)</label>
                        <input type="number" name="price_max" class="form-control form-control-admin" 
                               value="{{ old('price_max', $service->price_max ?? '') }}" placeholder="50000000">
                        <small class="text-white-50">Harga maksimum (opsional)</small>
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Features (Fitur Layanan)</label>
                    <div id="featuresContainer">
                        @php
                            $features = old('features', $service->features ?? []);
                            if(empty($features)) $features = [''];
                        @endphp
                        @foreach($features as $index => $feature)
                        <div class="feature-item mb-2">
                            <div class="input-group">
                                <input type="text" name="features[]" class="form-control form-control-admin" 
                                       value="{{ $feature }}" placeholder="Contoh: Responsive Design, SEO Optimized">
                                <button type="button" class="btn btn-danger remove-feature" style="border-radius:0 8px 8px 0;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-glass-admin btn-sm mt-2" id="addFeature">
                        <i class="bi bi-plus-lg me-1"></i>Add Feature
                    </button>
                    <small class="text-white-50 d-block mt-2">Tambahkan fitur-fitur yang termasuk dalam layanan</small>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-save me-2"></i>Save Service
                    </button>
                    <a href="{{ route('admin.service.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Tips</h6>
            <ul class="text-white-50 small">
                <li class="mb-2">✓ <strong>Title</strong> dan <strong>Description</strong> wajib diisi</li>
                <li class="mb-2">✓ Gunakan icon yang relevan dari Bootstrap Icons</li>
                <li class="mb-2">✓ <strong>Price Label</strong> untuk tampilan cepat (contoh: "Start from Rp 2jt")</li>
                <li class="mb-2">✓ Atau isi <strong>Price Min/Max</strong> untuk range harga</li>
                <li class="mb-2">✓ Tambahkan <strong>Features</strong> untuk detail layanan</li>
                <li class="mb-2">✓ <strong>Sort Order</strong> untuk mengatur urutan tampilan</li>
                <li>✓ Set <strong>Status</strong> ke Active untuk menampilkan di frontend</li>
            </ul>
            
            <div class="mt-4 p-3" style="background:rgba(230,126,34,0.1);border:1px solid rgba(230,126,34,0.3);border-radius:10px;">
                <h6 class="small mb-2" style="color:var(--accent);"><i class="bi bi-lightbulb me-1"></i>Contoh Icon</h6>
                <div class="text-white-50 small">
                    <code>bi-code-slash</code> - Web Development<br>
                    <code>bi-camera-video</code> - CCTV Installation<br>
                    <code>bi-laptop</code> - Laptop Service<br>
                    <code>bi-phone</code> - Mobile App<br>
                    <code>bi-shield-check</code> - Security
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add feature
document.getElementById('addFeature').addEventListener('click', function() {
    const container = document.getElementById('featuresContainer');
    const newFeature = document.createElement('div');
    newFeature.className = 'feature-item mb-2';
    newFeature.innerHTML = `
        <div class="input-group">
            <input type="text" name="features[]" class="form-control form-control-admin" placeholder="Contoh: Responsive Design, SEO Optimized">
            <button type="button" class="btn btn-danger remove-feature" style="border-radius:0 8px 8px 0;">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(newFeature);
});

// Remove feature
document.addEventListener('click', function(e) {
    if(e.target.closest('.remove-feature')) {
        e.target.closest('.feature-item').remove();
    }
});
</script>
@endsection