@extends('layouts.admin')
@section('title', isset($user) ? 'Edit User' : 'Add User')
@section('page-title', isset($user) ? 'Edit User' : 'Add New User')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ isset($user) ? route('admin.user.update', $user) : route('admin.user.store') }}" method="POST">
                @csrf
                @if(isset($user)) @method('PUT') @endif
                
                <div class="mb-3">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control form-control-admin @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name ?? '') }}" required placeholder="John Doe">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control form-control-admin @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email ?? '') }}" required placeholder="admin@example.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">
                        Password 
                        @if(isset($user))
                        <span class="text-white-50 small">(Kosongkan jika tidak ingin mengubah)</span>
                        @else
                        <span class="text-danger">*</span>
                        @endif
                    </label>
                    <div class="position-relative">
                        <input type="password" name="password" id="password" class="form-control form-control-admin @error('password') is-invalid @enderror" 
                               placeholder="Minimum 8 characters" {{ isset($user) ? '' : 'required' }} style="padding-right:45px;">
                        <span class="toggle-password" onclick="togglePassword('password', this)" style="position:absolute;right:15px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--text-secondary);">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-white-50">Minimum 8 karakter</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">
                        Confirm Password 
                        @if(isset($user))
                        <span class="text-white-50 small">(Kosongkan jika tidak ingin mengubah)</span>
                        @else
                        <span class="text-danger">*</span>
                        @endif
                    </label>
                    <div class="position-relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-admin" 
                               placeholder="Repeat password" {{ isset($user) ? '' : 'required' }} style="padding-right:45px;">
                        <span class="toggle-password" onclick="togglePassword('password_confirmation', this)" style="position:absolute;right:15px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--text-secondary);">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-save me-2"></i>Save User
                    </button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-glass-admin ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Information</h6>
            <ul class="text-white-50 small">
                <li class="mb-2">✓ Semua user memiliki role <strong>Admin</strong></li>
                <li class="mb-2">✓ Password minimal <strong>8 karakter</strong></li>
                <li class="mb-2">✓ Saat edit, kosongkan password jika tidak ingin mengubah</li>
                <li class="mb-2">✓ Anda tidak bisa menghapus akun sendiri</li>
                <li>✓ Gunakan password yang kuat (huruf besar, kecil, angka)</li>
            </ul>
            
            <div class="mt-4 p-3" style="background:rgba(230,126,34,0.1);border:1px solid rgba(230,126,34,0.3);border-radius:10px;">
                <h6 class="small mb-2" style="color:var(--accent);"><i class="bi bi-shield-check me-1"></i>Security Tips</h6>
                <small class="text-white-50">
                    • Jangan gunakan password yang sama di banyak tempat<br>
                    • Ganti password secara berkala<br>
                    • Gunakan kombinasi huruf, angka, dan simbol<br>
                    • Klik icon <i class="bi bi-eye"></i> untuk lihat password
                </small>
            </div>
        </div>
    </div>
</div>

<style>
.toggle-password:hover {
    color: var(--accent) !important;
}
</style>

<script>
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    const i = icon.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        i.classList.remove('bi-eye');
        i.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        i.classList.remove('bi-eye-slash');
        i.classList.add('bi-eye');
    }
}
</script>
@endsection