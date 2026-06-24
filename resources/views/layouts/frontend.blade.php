<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - {{ $site_name ?? 'Maul-Tech' }}</title>
<link rel="icon" type="image/png" href="{{ !empty($site_logo) ? asset('storage/'.$site_logo) : asset('maultechlogo/maultechlogo.png') }}">
<link rel="shortcut icon" href="{{ !empty($site_logo) ? asset('storage/'.$site_logo) : asset('maultechlogo/maultechlogo.png') }}">
<link rel="icon" type="image/png" href="{{ asset('maultechlogo/maultechlogo.png') }}">
    <meta name="description" content="@yield('meta_description', 'Maul-Tech: Build, Code, Solve')">
<link rel="icon" type="image/png" href="{{ asset('maultechlogo/maultechlogo.png') }}">
<link rel="shortcut icon" href="{{ asset('maultechlogo/maultechlogo.png') }}">
<link rel="apple-touch-icon" href="{{ asset('maultechlogo/maultechlogo.png') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}?v={{ time() }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
<link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #E67E22;
            --accent-dark: #D35400;
            --accent-light: #F39C12;
            --silver: #BDC3C7;
            --silver-light: #ECF0F1;
            --text-primary: #ffffff;
            --text-secondary: #a0aec0;
            --glass-bg: rgba(30, 41, 59, 0.6);
            --glass-border: rgba(230, 126, 34, 0.25);
            --gradient-1: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --gradient-2: linear-gradient(135deg, #E67E22 0%, #D35400 100%);
            --gradient-3: linear-gradient(135deg, #F39C12 0%, #E67E22 50%, #D35400 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--gradient-1);
            color: var(--text-primary);
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(230, 126, 34, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(211, 84, 0, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(243, 156, 18, 0.1) 0%, transparent 50%);
            z-index: -1;
            animation: bgFloat 30s ease infinite;
        }

        @keyframes bgFloat {
            0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.8; }
            33% { transform: scale(1.1) rotate(120deg); opacity: 1; }
            66% { transform: scale(1.05) rotate(240deg); opacity: 0.9; }
        }

        /* Floating Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--accent);
            animation: float 20s infinite;
            opacity: 0.6;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(100vh) translateX(0) rotate(0deg); 
                opacity: 0; 
            }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { 
                transform: translateY(-100vh) translateX(100px) rotate(720deg); 
                opacity: 0; 
            }
        }

        /* Glassmorphism Enhanced */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(230, 126, 34, 0.1), transparent);
            transition: left 0.7s;
        }

        .glass:hover::before {
            left: 100%;
        }

        .glass:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(230, 126, 34, 0.3);
            border-color: rgba(230, 126, 34, 0.5);
        }

        /* Navbar Modern */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.9) !important;
            backdrop-filter: blur(25px);
            border-bottom: 1px solid var(--glass-border);
            padding: 15px 0;
            transition: all 0.4s;
        }

        .navbar-custom.scrolled {
            background: rgba(15, 23, 42, 0.98) !important;
            padding: 10px 0;
            box-shadow: 0 5px 30px rgba(230, 126, 34, 0.2);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 900;
            font-size: 1.4rem;
            transition: all 0.3s;
            text-decoration: none;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
            filter: drop-shadow(0 2px 8px rgba(230, 126, 34, 0.3));
            transition: all 0.3s;
        }

        .navbar-brand:hover img {
            filter: drop-shadow(0 4px 15px rgba(230, 126, 34, 0.5));
        }

        .navbar-brand-text {
            background: var(--gradient-3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 900;
            letter-spacing: 0.5px;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 600;
            margin: 0 12px;
            position: relative;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--gradient-2);
            transition: all 0.4s;
            transform: translateX(-50%);
            border-radius: 10px;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 0 80px;
            position: relative;
        }

        .hero-title {
            font-size: clamp(2.8rem, 6vw, 4.5rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease;
        }

        .hero-title .highlight {
            background: var(--gradient-3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { filter: hue-rotate(0deg); }
            50% { filter: hue-rotate(15deg); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
            line-height: 1.8;
            animation: fadeInUp 1s ease 0.2s backwards;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 24px;
            background: rgba(230, 126, 34, 0.15);
            border: 2px solid rgba(230, 126, 34, 0.4);
            border-radius: 50px;
            font-size: 0.95rem;
            color: var(--accent-light);
            margin-bottom: 2rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(230, 126, 34, 0.4); }
            50% { box-shadow: 0 0 0 15px rgba(230, 126, 34, 0); }
        }

        .hero-image {
            position: relative;
            animation: fadeInRight 1s ease 0.4s backwards;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-image img {
            width: 100%;
            max-width: 450px;
            border-radius: 30px;
            box-shadow: 0 30px 80px rgba(230, 126, 34, 0.4);
            transition: all 0.5s;
        }

        .hero-image img:hover {
            transform: scale(1.05) rotate(2deg);
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
            margin-top: 3rem;
            animation: fadeInUp 1s ease 0.6s backwards;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            background: var(--gradient-3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
            font-weight: 500;
        }

        /* Buttons Modern */
        .btn-primary-custom {
            background: var(--gradient-2);
            border: none;
            color: white;
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(230, 126, 34, 0.3);
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary-custom:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(230, 126, 34, 0.5);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-custom:hover {
            background: var(--accent);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(230, 126, 34, 0.4);
        }

        /* Section Styles */
        .section {
            padding: 120px 0;
            position: relative;
        }

        .section-title {
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 900;
            margin-bottom: 1rem;
            text-align: center;
            background: var(--gradient-3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            color: var(--text-secondary);
            text-align: center;
            margin-bottom: 5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.1rem;
        }

        /* Skills Section */
        .skill-item {
            margin-bottom: 2.5rem;
        }

        .skill-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .skill-name {
            font-weight: 700;
            font-size: 1.05rem;
        }

        .skill-percentage {
            color: var(--accent);
            font-weight: 700;
            font-size: 1.05rem;
        }

        .skill-bar {
            height: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .skill-progress {
            height: 100%;
            background: var(--gradient-2);
            border-radius: 10px;
            transition: width 2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .skill-progress::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Services Section */
        .service-card {
            padding: 3rem;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient-2);
            transform: scaleX(0);
            transition: transform 0.5s;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-icon {
            font-size: 3.5rem;
            margin-bottom: 2rem;
            display: block;
            transition: all 0.4s;
        }

        .service-card:hover .service-icon {
            transform: scale(1.2) rotate(10deg);
        }

        .service-price {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--accent);
            margin: 1.5rem 0;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 50px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--gradient-2);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 3.5rem;
            padding: 2.5rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -38px;
            top: 35px;
            width: 20px;
            height: 20px;
            background: var(--accent);
            border-radius: 50%;
            border: 4px solid var(--primary);
            box-shadow: 0 0 0 6px rgba(230, 126, 34, 0.3);
            animation: pulse 2s infinite;
        }

        .timeline-year {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(230, 126, 34, 0.2);
            border: 1px solid rgba(230, 126, 34, 0.4);
            border-radius: 20px;
            font-size: 0.9rem;
            color: var(--accent-light);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        /* Contact Form */
        .form-control-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid var(--glass-border);
            border-radius: 14px;
            color: white;
            padding: 14px 22px;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .form-control-glass:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(230, 126, 34, 0.2);
            color: white;
            outline: none;
        }

        .form-control-glass::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        /* Footer */
        .footer {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(25px);
            border-top: 1px solid var(--glass-border);
            padding: 80px 0 40px;
            margin-top: 100px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .footer-brand img {
            height: 50px;
            width: auto;
        }

        .footer-brand-text {
            font-size: 1.5rem;
            font-weight: 900;
            background: var(--gradient-3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--glass-bg);
            border: 2px solid var(--glass-border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.4s;
            margin-right: 12px;
            font-size: 1.3rem;
        }

        .social-icon:hover {
            background: var(--gradient-2);
            transform: translateY(-5px) rotate(360deg);
            color: white;
            box-shadow: 0 10px 30px rgba(230, 126, 34, 0.4);
        }

        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, #25d366, #128c7e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            text-decoration: none;
            box-shadow: 0 10px 40px rgba(37, 211, 102, 0.5);
            z-index: 999;
            animation: bounce 2s infinite;
            transition: all 0.3s;
        }

        .whatsapp-float:hover {
            transform: scale(1.15);
            color: white;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--accent);
            font-size: 1rem;
            animation: scrollBounce 2s infinite;
            font-weight: 600;
        }

        @keyframes scrollBounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(15px); }
        }

        /* Loading Screen */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-content {
            text-align: center;
        }

        .loader-content img {
            height: 80px;
            width: auto;
            animation: pulse 2s infinite;
        }

        .loader-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(230, 126, 34, 0.3);
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto 0;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-stats {
                flex-direction: column;
                gap: 1.5rem;
            }
            .stat-number {
                font-size: 2.5rem;
            }
            .navbar-brand img {
                height: 35px;
            }
            .navbar-brand-text {
                font-size: 1.2rem;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--primary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-2);
            border-radius: 10px;
        }


/* Portfolio Landscape Layout */
.portfolio-card {
    height: 100%;
    transition: all 0.4s ease;
}

.portfolio-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(230, 126, 34, 0.3);
}

.portfolio-card img {
    transition: transform 0.5s ease;
}

.portfolio-card:hover img {
    transform: scale(1.05);
}

/* Detail Page Carousel */
.portfolio-carousel {
    position: relative;
}

.carousel-slides {
    display: flex;
    transition: transform 0.5s ease;
}

.carousel-prev, .carousel-next {
    transition: all 0.3s;
}

.carousel-prev:hover, .carousel-next:hover {
    background: var(--accent) !important;
    transform: translateY(-50%) scale(1.1);
}

/* Sticky Sidebar */
.sticky-top {
    position: sticky;
    z-index: 100;
}



    </style>
    @stack('styles')
</head>
<body>
    <!-- Loader -->
    <div class="loader" id="loader">
        <div class="loader-content">
            <img src="{{ asset('maultechlogo/maultechlogo.png') }}" alt="Maul-Tech">
            <div class="loader-spinner"></div>
        </div>
    </div>

    <!-- Particles -->
    <div class="particles" id="particles"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('login') }}">
    @php
        $logoSrc = null;
        if(!empty($site_logo) && file_exists(storage_path('app/public/' . $site_logo))) {
            $logoSrc = asset('storage/' . $site_logo);
        } else {
            $logoSrc = asset('maultechlogo/maultechlogo.png');
        }
    @endphp
    <img src="{{ $logoSrc }}" alt="Logo" style="height:40px;margin-right:8px;" onerror="this.style.display='none'">
    <span style="font-weight: 800; font-size: 1.2rem; background: linear-gradient(to right, #bdc3c7, #e67e22); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $site_name ?? 'Maul-Tech' }}</span>
</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('services*') ? 'active' : '' }}" href="{{ route('frontend.services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('portfolio*') ? 'active' : '' }}" href="{{ route('frontend.portfolio') }}">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('frontend.contact') }}">Contact</a></li>
                    @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <img src="{{ asset('maultechlogo/maultechlogo.png') }}" alt="Maul-Tech">
                        <span class="footer-brand-text">{{ $site_name ?? 'Maul-Tech' }}</span>
                    </div>
                    <p class="text-white-50">{{ $footer_text ?? 'Build • Code • Solve - Professional solutions for your digital and physical infrastructure needs.' }}</p>
                    <div class="mt-3">
                        @if(!empty($social_facebook))<a href="{{ $social_facebook }}" class="social-icon" target="_blank"><i class="bi bi-facebook"></i></a>@endif
                        @if(!empty($social_instagram))<a href="{{ $social_instagram }}" class="social-icon" target="_blank"><i class="bi bi-instagram"></i></a>@endif
                        @if(!empty($social_linkedin))<a href="{{ $social_linkedin }}" class="social-icon" target="_blank"><i class="bi bi-linkedin"></i></a>@endif
                        @if(!empty($social_github))<a href="{{ $social_github }}" class="social-icon" target="_blank"><i class="bi bi-github"></i></a>@endif
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('frontend.services') }}" class="text-white-50 text-decoration-none">Services</a></li>
                        <li class="mb-2"><a href="{{ route('frontend.portfolio') }}" class="text-white-50 text-decoration-none">Portfolio</a></li>
                        <li class="mb-2"><a href="{{ route('frontend.contact') }}" class="text-white-50 text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="mb-3">Services</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Web Development</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">CCTV Installation</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Laptop Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="mb-3">Contact Info</h6>
                    @if(!empty($contact_email))<p class="text-white-50 mb-2"><i class="bi bi-envelope me-2"></i>{{ $contact_email }}</p>@endif
                    @if(!empty($contact_phone))<p class="text-white-50 mb-2"><i class="bi bi-phone me-2"></i>{{ $contact_phone }}</p>@endif
                    @if(!empty($contact_address))<p class="text-white-50 mb-2"><i class="bi bi-geo-alt me-2"></i>{{ $contact_address }}</p>@endif
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center text-white-50">
                <small>&copy; {{ date('Y') }} {{ $site_name ?? 'Maul-Tech' }}. All rights reserved. | Build • Code • Solve</small>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float -->
    @if(!empty($whatsapp_number))
    <a href="https://wa.me/{{ str_replace(['+',' ','-'],'',$whatsapp_number) }}" class="whatsapp-float" target="_blank" title="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
    @endif

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Loader
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('loader').classList.add('hidden');
            }, 500);
        });

        // AOS Init
        AOS.init({ duration: 1000, once: true, offset: 100 });

        // Navbar scroll
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            if(window.scrollY > 50) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        });

        // Particles
        function createParticles() {
            const container = document.getElementById('particles');
            for(let i = 0; i < 40; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 15 + 15) + 's';
                container.appendChild(particle);
            }
        }
        createParticles();

        // Skill bars animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.style.width = entry.target.dataset.width + '%';
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.skill-progress').forEach(bar => {
            observer.observe(bar);
        });
    </script>
    @stack('scripts')
</body>
</html>