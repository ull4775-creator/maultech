<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Maul-Tech Admin</title>
<link rel="icon" type="image/png" href="{{ asset('maultechlogo/maultechlogo.png') }}">
<link rel="shortcut icon" href="{{ asset('maultechlogo/maultechlogo.png') }}">
<link rel="apple-touch-icon" href="{{ asset('maultechlogo/maultechlogo.png') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}?v={{ time() }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
<link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #E67E22;
            --accent-dark: #D35400;
            --accent-light: #F39C12;
            --silver: #BDC3C7;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
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
                radial-gradient(circle at 80% 70%, rgba(211, 84, 0, 0.12) 0%, transparent 50%);
            z-index: -1;
            animation: bgFloat 20s ease infinite;
        }

        @keyframes bgFloat {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(2deg); }
        }

        /* Glassmorphism */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            padding: 3rem;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo {
            margin-bottom: 1.5rem;
        }

        .login-logo img {
            height: 80px;
            width: auto;
            filter: drop-shadow(0 4px 15px rgba(230, 126, 34, 0.4));
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: var(--gradient-3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        /* Form */
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .form-control-custom {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid var(--glass-border);
            border-radius: 14px;
            color: white;
            padding: 14px 20px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(230, 126, 34, 0.2);
            color: white;
            outline: none;
        }

        .form-control-custom::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .input-group-custom {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            font-size: 1.2rem;
            z-index: 10;
        }

        .input-group-custom .form-control-custom {
            padding-left: 45px;
        }

        /* Button */
        .btn-login {
            background: var(--gradient-2);
            border: none;
            color: white;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all 0.4s;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(230, 126, 34, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
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

        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(230, 126, 34, 0.5);
        }

        /* Alert */
        .alert-custom {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.5);
            color: #ea868f;
            border-radius: 14px;
            padding: 12px 20px;
            margin-bottom: 1.5rem;
        }

        .alert-custom i {
            margin-right: 8px;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .login-footer a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .login-footer a:hover {
            color: var(--accent-light);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem;
            }
            .login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="glass login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('maultechlogo/maultechlogo.png') }}" alt="Maul-Tech">
                </div>
                <h1 class="login-title">Welcome Back!</h1>
                <p class="login-subtitle">Login to Maul-Tech Admin Panel</p>
            </div>

            <!-- Error Alert -->
            @if ($errors->any())
            <div class="alert-custom">
                <i class="bi bi-exclamation-circle"></i>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope input-icon"></i>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control-custom w-100" 
                            placeholder="admin@maultech.com" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group-custom">
                        <i class="bi bi-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control-custom w-100" 
                            placeholder="••••••••" 
                            required
                        >
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="mb-4">
                    <div class="form-check">
                        <input 
                            type="checkbox" 
                            class="form-check-input" 
                            id="remember" 
                            name="remember"
                            style="background: rgba(255,255,255,0.05); border-color: var(--glass-border);"
                        >
                        <label class="form-check-label" for="remember" style="color: var(--text-secondary);">
                            Remember me
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p>
                    <a href="{{ route('home') }}">
                        <i class="bi bi-arrow-left me-1"></i>Back to Home
                    </a>
                </p>
                <p class="mt-2" style="font-size: 0.85rem;">
                    <strong>Demo Credentials:</strong><br>
                    Email: admin@portfolio.com<br>
                    Password: password123
                </p>
                <p class="mt-3" style="font-size: 0.8rem; color: var(--accent);">
                    Build • Code • Solve
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>