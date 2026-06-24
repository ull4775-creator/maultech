@extends('layouts.admin')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')
@section('page-title', isset($testimonial) ? 'Edit Testimonial' : 'Add New Testimonial')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ isset($testimonial) ? route('admin.testimonial.update', $testimonial) : route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($testimonial)) @method('PUT') @endif
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Client Name *</label>
                        <input type="text" name="client_name" class="form-control form-control-admin @error('client_name') is-invalid @enderror" 
                               value="{{ old('client_name', $testimonial->client_name ?? '') }}" required placeholder="John Doe">
                        @error('client_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Client Position</label>
                        <input type="text" name="client_position" class="form-control form-control-admin" 
                               value="{{ old('client_position', $testimonial->client_position ?? '') }}" placeholder="CEO, Business Owner">
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Client Avatar</label>
                    @if(isset($testimonial) && $testimonial->client_avatar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$testimonial->client_avatar) }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;">
                    </div>
                    @endif
                    <input type="file" name="client_avatar" class="form-control form-control-admin" accept="image/*">
                    <small class="text-white-50">Foto profil klien (opsional)</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Testimonial Message *</label>
                    <textarea name="message" class="form-control form-control-admin @error('message') is-invalid @enderror" rows="5" required placeholder="Pelayanan sangat profesional! Website yang dibuat sangat modern dan cepat...">{{ old('message', $testimonial->message ?? '') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Rating *</label>
                    <select name="rating" class="form-control form-control-admin" required>
                        @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('rating', $testimonial->rating ?? 5) == $i)>
                            {{ $i }} Star{{ $i > 1 ? 's' : '' }} 
                            @if($i == 5) ⭐⭐⭐⭐⭐ Excellent
                            @elseif($i == 4) ⭐⭐⭐⭐ Very Good
                            @elseif($i == 3) ⭐⭐⭐ Good
                            @elseif($i == 2) ⭐⭐ Fair
                            @else ⭐ Poor
                            @endif
                        </option>
                        @endfor
                    </select>
                </div>
                
                <div class="form-check mb-3">
                    <input type="checkbox" name="is_published" class="form-check-input" id="isPublished" value="1" @checked(old('is_published', $testimonial->is_published ?? true))>
                    <label class="form-check-label" for="isPublished">
                        Published (tampilkan di halaman utama)
                    </label>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-save me-2"></i>Save Testimonial
                    </button>
                    <a href="{{ route('admin.testimonial.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Tips</h6>
            <ul class="text-white-50 small">
                <li class="mb-2">✓ Testimonial yang <strong>Published</strong> akan muncul di halaman home</li>
                <li class="mb-2">✓ Rating 5 bintang untuk pengalaman terbaik</li>
                <li class="mb-2">✓ Avatar klien opsional - bisa upload foto</li>
                <li class="mb-2">✓ Pesan testimonial harus autentik dan relevan</li>
                <li>✓ Tampilkan posisi/jabatan klien untuk kredibilitas</li>
            </ul>
        </div>
    </div>
</div>
@endsection