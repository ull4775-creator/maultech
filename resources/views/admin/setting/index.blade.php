@extends('layouts.admin')
@section('title', 'Settings')
@section('page-title', 'Site Settings')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <!-- General Settings -->
    <div class="stat-card mb-4">
        <h5 class="mb-4"><i class="bi bi-gear me-2"></i>General Settings</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Site Name / Logo Text</label>
                <input type="text" name="site_name" class="form-control form-control-admin" value="{{ $settings['general']->where('key','site_name')->first()->value ?? 'Maul-Tech' }}">
                <small class="text-white-50">Ini akan muncul di navbar dan footer</small>
            </div>
            <div class="col-md-6">
                <label class="form-label">Site Logo (Navbar)</label>
                @php $logo = $settings['general']->where('key','site_logo')->first(); @endphp
                @if($logo && $logo->value)
                <div class="mb-2"><img src="{{ asset('storage/'.$logo->value) }}" style="max-height:60px;border-radius:8px;"></div>
                @endif
                <input type="file" name="site_logo" class="form-control form-control-admin" accept="image/*">
            </div>
            <div class="col-md-6">
                <label class="form-label">Favicon (Logo Browser Tab)</label>
                @php $favicon = $settings['general']->where('key','favicon')->first(); @endphp
                @if($favicon && $favicon->value)
                <div class="mb-2"><img src="{{ asset('storage/'.$favicon->value) }}" style="max-height:40px;border-radius:4px;"></div>
                @endif
                <input type="file" name="favicon" class="form-control form-control-admin" accept="image/*,.ico">
                <small class="text-white-50">Logo kecil di tab browser (disarankan PNG/ICO 32x32)</small>
            </div>
            <div class="col-md-6">
                <label class="form-label">Profile Photo (Halaman Utama)</label>
                @php $profile = $settings['general']->where('key','profile_photo')->first(); @endphp
                @if($profile && $profile->value)
                <div class="mb-2"><img src="{{ asset('storage/'.$profile->value) }}" style="max-height:100px;border-radius:8px;"></div>
                @endif
                <input type="file" name="profile_photo" class="form-control form-control-admin" accept="image/*">
                <small class="text-white-50">Foto profil yang muncul di hero section</small>
            </div>
            <div class="col-12">
                <label class="form-label">Footer Text</label>
                <textarea name="footer_text" class="form-control form-control-admin" rows="2">{{ $settings['general']->where('key','footer_text')->first()->value ?? '' }}</textarea>
            </div>
        </div>
    </div>
    
    <!-- Hero Section -->
    <div class="stat-card mb-4">
        <h5 class="mb-4"><i class="bi bi-house me-2"></i>Hero Section</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Hero Title</label>
                <input type="text" name="hero_title" class="form-control form-control-admin" value="{{ $settings['general']->where('key','hero_title')->first()->value ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Hero Image (Background)</label>
                @php $hero = $settings['general']->where('key','hero_image')->first(); @endphp
                @if($hero && $hero->value)
                <div class="mb-2"><img src="{{ asset('storage/'.$hero->value) }}" style="max-height:100px;border-radius:8px;"></div>
                @endif
                <input type="file" name="hero_image" class="form-control form-control-admin" accept="image/*">
            </div>
            <div class="col-12">
                <label class="form-label">Hero Subtitle</label>
                <textarea name="hero_subtitle" class="form-control form-control-admin" rows="2">{{ $settings['general']->where('key','hero_subtitle')->first()->value ?? '' }}</textarea>
            </div>
        </div>
    </div>

    <!-- About -->
    <div class="stat-card mb-4">
        <h5 class="mb-4"><i class="bi bi-person me-2"></i>About Section</h5>
        <textarea name="about_text" class="form-control form-control-admin" rows="4">{{ $settings['general']->where('key','about_text')->first()->value ?? '' }}</textarea>
    </div>
    
    <!-- Contact -->
    <div class="stat-card mb-4">
        <h5 class="mb-4"><i class="bi bi-telephone me-2"></i>Contact Information</h5>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="contact_email" class="form-control form-control-admin" value="{{ $settings['general']->where('key','contact_email')->first()->value ?? '' }}"></div>
            <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="contact_phone" class="form-control form-control-admin" value="{{ $settings['general']->where('key','contact_phone')->first()->value ?? '' }}"></div>
            <div class="col-md-6"><label class="form-label">WhatsApp</label><input type="text" name="whatsapp_number" class="form-control form-control-admin" value="{{ $settings['general']->where('key','whatsapp_number')->first()->value ?? '' }}"></div>
            <div class="col-md-6"><label class="form-label">Address</label><input type="text" name="contact_address" class="form-control form-control-admin" value="{{ $settings['general']->where('key','contact_address')->first()->value ?? '' }}"></div>
        </div>
    </div>
    
    <!-- Social -->
    <div class="stat-card mb-4">
        <h5 class="mb-4"><i class="bi bi-share me-2"></i>Social Media</h5>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Facebook</label><input type="url" name="social_facebook" class="form-control form-control-admin" value="{{ $settings['general']->where('key','social_facebook')->first()->value ?? '' }}"></div>
            <div class="col-md-6"><label class="form-label">Instagram</label><input type="url" name="social_instagram" class="form-control form-control-admin" value="{{ $settings['general']->where('key','social_instagram')->first()->value ?? '' }}"></div>
            <div class="col-md-6"><label class="form-label">LinkedIn</label><input type="url" name="social_linkedin" class="form-control form-control-admin" value="{{ $settings['general']->where('key','social_linkedin')->first()->value ?? '' }}"></div>
            <div class="col-md-6"><label class="form-label">GitHub</label><input type="url" name="social_github" class="form-control form-control-admin" value="{{ $settings['general']->where('key','social_github')->first()->value ?? '' }}"></div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary-admin btn-lg"><i class="bi bi-save me-2"></i>Save All Settings</button>
</form>
@endsection