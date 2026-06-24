@extends('layouts.admin')
@section('title', isset($education) ? 'Edit Education' : 'Add Education')
@section('page-title', isset($education) ? 'Edit Education' : 'Add New Education')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ isset($education) ? route('admin.education.update', $education) : route('admin.education.store') }}" method="POST">
                @csrf
                @if(isset($education)) @method('PUT') @endif
                
                <div class="mb-3">
                    <label class="form-label">Degree *</label>
                    <input type="text" name="degree" class="form-control form-control-admin @error('degree') is-invalid @enderror" 
                           value="{{ old('degree', $education->degree ?? '') }}" required placeholder="S1 Teknik Informatika">
                    @error('degree')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Institution *</label>
                    <input type="text" name="institution" class="form-control form-control-admin @error('institution') is-invalid @enderror" 
                           value="{{ old('institution', $education->institution ?? '') }}" required placeholder="Universitas Teknologi">
                    @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Year Start *</label>
                        <input type="text" name="year_start" class="form-control form-control-admin @error('year_start') is-invalid @enderror" 
                               value="{{ old('year_start', $education->year_start ?? '') }}" required placeholder="2018">
                        @error('year_start')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Year End</label>
                        <input type="text" name="year_end" class="form-control form-control-admin" 
                               value="{{ old('year_end', $education->year_end ?? '') }}" placeholder="2022 (kosongkan jika masih kuliah)">
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control form-control-admin" rows="4" placeholder="Fokus pada Software Engineering dan Sistem Terdistribusi">{{ old('description', $education->description ?? '') }}</textarea>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-save me-2"></i>Save
                    </button>
                    <a href="{{ route('admin.education.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Tips</h6>
            <ul class="text-white-50 small">
                <li class="mb-2">Isi tahun dengan format YYYY (contoh: 2018)</li>
                <li class="mb-2">Kosongkan Year End jika masih berstatus mahasiswa</li>
                <li class="mb-2">Deskripsi singkat tentang jurusan/fokus studi</li>
                <li>Urutan akan otomatis dari tahun terbaru</li>
            </ul>
        </div>
    </div>
</div>
@endsection