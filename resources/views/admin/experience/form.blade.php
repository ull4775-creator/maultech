@extends('layouts.admin')
@section('title', isset($experience) ? 'Edit Experience' : 'Add Experience')
@section('page-title', isset($experience) ? 'Edit Experience' : 'Add New Experience')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ isset($experience) ? route('admin.experience.update', $experience) : route('admin.experience.store') }}" method="POST">
                @csrf
                @if(isset($experience)) @method('PUT') @endif
                
                <div class="mb-3">
                    <label class="form-label">Position / Job Title *</label>
                    <input type="text" name="position" class="form-control form-control-admin @error('position') is-invalid @enderror" 
                           value="{{ old('position', $experience->position ?? '') }}" required placeholder="Full Stack Developer">
                    @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-white-50">Jabatan/posisi kerja (wajib)</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Company / Organization *</label>
                    <input type="text" name="company" class="form-control form-control-admin @error('company') is-invalid @enderror" 
                           value="{{ old('company', $experience->company ?? '') }}" required placeholder="PT. Maul-Tech Indonesia">
                    @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-white-50">Nama perusahaan/organisasi (wajib)</small>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Year Start *</label>
                        <input type="text" name="year_start" class="form-control form-control-admin @error('year_start') is-invalid @enderror" 
                               value="{{ old('year_start', $experience->year_start ?? '') }}" required placeholder="2022">
                        @error('year_start')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-white-50">Tahun mulai (format YYYY)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Year End</label>
                        <input type="text" name="year_end" class="form-control form-control-admin" 
                               value="{{ old('year_end', $experience->year_end ?? '') }}" placeholder="2024 (kosongkan jika masih bekerja)">
                        <small class="text-white-50">Tahun selesai (opsional)</small>
                    </div>
                </div>
                
                <div class="mb-3 mt-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control form-control-admin" rows="5" placeholder="Deskripsikan tanggung jawab, pencapaian, dan teknologi yang digunakan...">{{ old('description', $experience->description ?? '') }}</textarea>
                    <small class="text-white-50">Deskripsi pekerjaan (opsional)</small>
                </div>
                
                <div class="form-check mb-3">
                    <input type="checkbox" name="is_current" class="form-check-input" id="isCurrent" value="1" @checked(old('is_current', $experience->is_current ?? false))>
                    <label class="form-check-label" for="isCurrent">
                        <strong>Currently working here</strong> (pekerjaan saat ini)
                    </label>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-save me-2"></i>Save Experience
                    </button>
                    <a href="{{ route('admin.experience.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Tips</h6>
            <ul class="text-white-50 small">
                <li class="mb-2">✓ Isi <strong>Position</strong> dan <strong>Company</strong> wajib</li>
                <li class="mb-2">✓ Centang <strong>Currently working here</strong> jika masih bekerja</li>
                <li class="mb-2">✓ Jika masih bekerja, kosongkan <strong>Year End</strong></li>
                <li class="mb-2">✓ Deskripsi singkat tentang tanggung jawab & pencapaian</li>
                <li>✓ Urutan otomatis dari tahun terbaru</li>
            </ul>
            
            <div class="mt-4 p-3" style="background:rgba(230,126,34,0.1);border:1px solid rgba(230,126,34,0.3);border-radius:10px;">
                <h6 class="small mb-2" style="color:var(--accent);"><i class="bi bi-lightbulb me-1"></i>Contoh Deskripsi</h6>
                <small class="text-white-50">
                    "Membangun aplikasi web menggunakan Laravel dan React. Bertanggung jawab atas development fitur baru, code review, dan deployment ke production."
                </small>
            </div>
        </div>
    </div>
</div>
@endsection