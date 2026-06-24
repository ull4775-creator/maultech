<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Maul-Tech Admin</title>
<link rel="icon" type="image/png" href="{{ asset('maultechlogo/maultechlogo.png') }}">
<link rel="shortcut icon" href="{{ asset('maultechlogo/maultechlogo.png') }}">
<link rel="apple-touch-icon" href="{{ asset('maultechlogo/maultechlogo.png') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}?v={{ time() }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
<link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px;
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #E67E22;
            --accent-dark: #D35400;
            --accent-light: #F39C12;
            --silver: #BDC3C7;
            --dark: #0a0e1a;
            --glass-bg: rgba(30, 41, 59, 0.4);
            --glass-border: rgba(230, 126, 34, 0.25);
            --gradient-1: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --gradient-2: linear-gradient(135deg, #E67E22 0%, #D35400 100%);
            --gradient-3: linear-gradient(135deg, #F39C12 0%, #E67E22 50%, #D35400 100%);
        }
        * { font-family: 'Poppins', sans-serif; }
        body { background: var(--gradient-1); color: white; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-width); height: 100vh;
            background: rgba(10, 14, 26, 0.95);
            backdrop-filter: blur(25px);
            border-right: 1px solid var(--glass-border);
            padding: 20px 0;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar-brand {
            padding: 0 20px 20px;
            border-bottom: 1px solid var(--glass-border);
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar-brand img {
            height: 60px;
            width: auto;
            margin-bottom: 10px;
            filter: drop-shadow(0 2px 8px rgba(230, 126, 34, 0.3));
        }
        .sidebar-brand h4 { 
            margin: 0; 
            font-weight: 800; 
            background: var(--gradient-3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.3rem;
        }
        .sidebar-brand small { color: rgba(255,255,255,0.5); }
        .sidebar-menu { list-style: none; padding: 0; margin: 0; }
        .sidebar-menu li a {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 20px; color: rgba(255,255,255,0.7);
            text-decoration: none; transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .sidebar-menu li a:hover, .sidebar-menu li a.active {
            background: rgba(230, 126, 34, 0.15);
            color: white; border-left-color: var(--accent);
        }
        .sidebar-menu li a i { font-size: 1.2rem; width: 24px; }
        .sidebar-divider { padding: 10px 20px; font-size: 0.75rem; text-transform: uppercase; color: rgba(255,255,255,0.4); letter-spacing: 1px; margin-top: 10px; }
        
        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); padding: 20px; min-height: 100vh; }
        
        /* Topbar */
        .topbar {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 15px 25px;
            margin-bottom: 25px;
            display: flex; justify-content: space-between; align-items: center;
        }
        
        /* Cards */
        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 25px;
            transition: all 0.3s;
        }
        .stat-card:hover { transform: translateY(-3px); border-color: var(--accent); }
        .stat-card .stat-icon {
            width: 50px; height: 50px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; margin-bottom: 15px;
            background: rgba(230, 126, 34, 0.2);
            color: var(--accent);
        }
        .stat-card h3 { font-size: 2rem; font-weight: 700; margin: 0; }
        .stat-card p { color: rgba(255,255,255,0.6); margin: 0; font-size: 0.9rem; }
        
        /* Table */
        .table-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            overflow: hidden;
        }
        .table-glass table { color: white; margin: 0; }
        .table-glass thead { background: rgba(230, 126, 34, 0.2); }
        .table-glass th { border: none; padding: 15px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .table-glass td { border-color: var(--glass-border); padding: 15px; vertical-align: middle; }
        .table-glass tbody tr:hover { background: rgba(230, 126, 34, 0.1); }
        
        /* Buttons */
        .btn-glass-admin {
            background: rgba(230, 126, 34, 0.2);
            border: 1px solid rgba(230, 126, 34, 0.5);
            color: white; padding: 8px 16px; border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-glass-admin:hover { background: rgba(230, 126, 34, 0.4); color: white; }
        .btn-primary-admin { background: var(--gradient-2); border: none; color: white; padding: 8px 16px; border-radius: 8px; }
        .btn-primary-admin:hover { background: var(--accent-dark); color: white; }
        
        /* Form */
        .form-control-admin {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--glass-border);
            border-radius: 8px; color: white; padding: 10px 15px;
        }
        .form-control-admin:focus { background: rgba(255,255,255,0.1); border-color: var(--accent); box-shadow: 0 0 0 3px rgba(230,126,34,0.2); color: white; }
        .form-control-admin::placeholder { color: rgba(255,255,255,0.4); }
        
        /* Badge */
        .badge-glass { background: rgba(230, 126, 34, 0.3); border: 1px solid rgba(230, 126, 34, 0.5); }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 10px; }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('maultechlogo/maultechlogo.png') }}" alt="Maul-Tech">
            <h4>{{ $site_name ?? 'Maul-Tech' }}</h4>
            <small>Admin Panel</small>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            
            <div class="sidebar-divider">Content</div>
            <li><a href="{{ route('admin.portfolio.index') }}" class="{{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}"><i class="bi bi-grid"></i> Portfolio</a></li>
            <li><a href="{{ route('admin.service.index') }}" class="{{ request()->routeIs('admin.service.*') ? 'active' : '' }}"><i class="bi bi-gear"></i> Services</a></li>
            <li><a href="{{ route('admin.skill.index') }}" class="{{ request()->routeIs('admin.skill.*') ? 'active' : '' }}"><i class="bi bi-lightning"></i> Skills</a></li>
            
            <div class="sidebar-divider">Profile</div>
            <li><a href="{{ route('admin.experience.index') }}" class="{{ request()->routeIs('admin.experience.*') ? 'active' : '' }}"><i class="bi bi-briefcase"></i> Experience</a></li>
            <li><a href="{{ route('admin.education.index') }}" class="{{ request()->routeIs('admin.education.*') ? 'active' : '' }}"><i class="bi bi-mortarboard"></i> Education</a></li>
            <li><a href="{{ route('admin.certification.index') }}" class="{{ request()->routeIs('admin.certification.*') ? 'active' : '' }}"><i class="bi bi-patch-check"></i> Certifications</a></li>
            <li><a href="{{ route('admin.testimonial.index') }}" class="{{ request()->routeIs('admin.testimonial.*') ? 'active' : '' }}"><i class="bi bi-chat-quote"></i> Testimonials</a></li>
            
            <div class="sidebar-divider">Management</div>
            <li><a href="{{ route('admin.contact.index') }}" class="{{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Contacts
                @php $unread = \App\Models\Contact::where('is_read',false)->count(); @endphp
                @if($unread > 0)<span class="badge bg-danger ms-auto">{{ $unread }}</span>@endif
            </a></li>
            <li><a href="{{ route('admin.order.index') }}" class="{{ request()->routeIs('admin.order.*') ? 'active' : '' }}"><i class="bi bi-cart"></i> Orders</a></li>
            <li><a href="{{ route('admin.visitors') }}" class="{{ request()->routeIs('admin.visitors') ? 'active' : '' }}"><i class="bi bi-people"></i> Visitors</a></li>
            
            <div class="sidebar-divider">System</div>
            <li><a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}"><i class="bi bi-sliders"></i> Settings</a></li>
<li><a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}"><i class="bi bi-people"></i> User Management</a></li>
            <li><a href="{{ route('home') }}" target="_blank"><i class="bi bi-box-arrow-up-right"></i> View Site</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-white-50 text-decoration-none p-0 d-flex align-items-center gap-2" style="padding:12px 20px !important;">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </aside>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-glass-admin d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white-50 small">{{ auth()->user()->name ?? 'Admin' }}</span>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:var(--gradient-2);">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </div>
        
        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" style="background:rgba(25,135,84,0.2);border:1px solid rgba(25,135,84,0.5);color:#75b798;border-radius:10px;">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" style="background:rgba(220,53,69,0.2);border:1px solid rgba(220,53,69,0.5);color:#ea868f;border-radius:10px;">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>