<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Pelayanan Surat Desa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #2d6a4f;
            --secondary-green: #40916c;
            --light-green: #52b788;
            --cream: #f8f4e8;
            --brown: #6b4423;
            --gold: #d4a574;
            --dark: #1b4332;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #d4f1f4 0%, #b5e7a0 50%, #95d5b2 100%);
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--dark);
            min-height: 100vh;
            position: relative;
        }

        /* Decorative Background Pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 15 L60 35 L80 35 L65 50 L70 70 L50 55 L30 70 L35 50 L20 35 L40 35 Z' fill='%23ffffff' opacity='0.03'/%3E%3C/svg%3E"),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='20' fill='none' stroke='%23ffffff' stroke-width='1' opacity='0.05'/%3E%3C/svg%3E");
            background-size: 100px 100px, 60px 60px;
            background-position: 0 0, 50px 50px;
            animation: drift 40s infinite linear;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes drift {
            from { background-position: 0 0, 50px 50px; }
            to { background-position: 100px 100px, 150px 150px; }
        }

        /* Modern Navbar with Village Theme */
        .navbar-village {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(45, 106, 79, 0.15);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 3px solid var(--gold);
        }

        /* Lower z-index when modal is open */
        body.modal-open .navbar-village {
            z-index: 10;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--primary-green) !important;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);
            position: relative;
            overflow: hidden;
            border: 3px solid var(--gold);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 2px;
        }

        .brand-logo::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 17px;
            background: linear-gradient(135deg, var(--gold), transparent);
            z-index: -1;
            opacity: 0.5;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .brand-name {
            font-size: 1.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-tagline {
            font-size: 0.7rem;
            color: var(--brown);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .navbar-nav .nav-link {
            color: var(--dark) !important;
            font-weight: 600;
            padding: 0.6rem 1.2rem !important;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            position: relative;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 80%;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--primary-green));
            border-radius: 2px;
            transition: transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(82, 183, 136, 0.1);
            color: var(--primary-green) !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link:hover::before {
            transform: translateX(-50%) scaleX(1);
        }

        .navbar-nav .nav-link.active {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white !important;
            box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);
        }

        .navbar-nav .nav-link.active::before {
            display: none;
        }

        /* User Dropdown */
        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: linear-gradient(135deg, rgba(82, 183, 136, 0.1), rgba(45, 106, 79, 0.1));
            padding: 0.5rem 1rem !important;
            border-radius: 50px !important;
            border: 2px solid var(--light-green);
        }

        .user-avatar-nav {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary-green), var(--light-green));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.95rem;
            border: 2px solid var(--gold);
        }

        .dropdown-menu {
            border-radius: 16px;
            border: 2px solid var(--light-green);
            box-shadow: 0 10px 40px rgba(45, 106, 79, 0.2);
            padding: 0.75rem;
            margin-top: 0.5rem;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .dropdown-header {
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 12px;
            margin-bottom: 0.5rem;
            color: white;
        }

        .dropdown-item {
            padding: 0.8rem 1rem;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 0.25rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(82, 183, 136, 0.15), rgba(45, 106, 79, 0.1));
            transform: translateX(5px);
            color: var(--primary-green);
        }

        .dropdown-divider {
            border-top: 2px solid rgba(82, 183, 136, 0.2);
            margin: 0.5rem 0;
        }

        /* Content Area */
        .content-wrapper {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(45, 106, 79, 0.15);
            padding: 2.5rem;
            margin: 2rem auto;
            max-width: 1400px;
            position: relative;
            z-index: 1;
            border: 3px solid var(--gold);
        }

        .content-wrapper::before {
            content: '';
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 8px;
            background: linear-gradient(90deg, var(--gold), var(--primary-green), var(--gold));
            border-radius: 4px;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-green);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(45, 106, 79, 0.1);
        }

        .page-title i {
            color: var(--gold);
            font-size: 2.2rem;
            filter: drop-shadow(2px 2px 4px rgba(212, 165, 116, 0.3));
        }

        /* Buttons */
        .btn {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
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

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-green), var(--light-green));
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(45, 106, 79, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #40916c, #52b788);
            color: white;
            box-shadow: 0 4px 15px rgba(64, 145, 108, 0.3);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #52b788, #74c69d);
            transform: translateY(-3px);
        }

        .btn-outline-secondary {
            background: transparent;
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
        }

        .btn-outline-secondary:hover {
            background: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            border-left: 5px solid;
            margin-bottom: 1.5rem;
            animation: slideDown 0.4s ease;
            backdrop-filter: blur(10px);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(82, 183, 136, 0.2), rgba(116, 198, 157, 0.15));
            color: var(--primary-green);
            border-left-color: var(--secondary-green);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(239, 68, 68, 0.1));
            color: #991b1b;
            border-left-color: #dc3545;
        }

        /* Footer */
        .footer {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            padding: 2.5rem 0;
            margin-top: 3rem;
            border-top: 3px solid var(--gold);
            position: relative;
            z-index: 100;
        }

        /* Lower z-index when modal is open */
        body.modal-open .footer {
            z-index: 10;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-brand {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .footer-logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--gold);
            padding: 5px;
        }

        .footer-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .footer-text {
            text-align: left;
        }

        .footer-text h4 {
            color: var(--primary-green);
            font-weight: 700;
            margin: 0;
            font-size: 1.3rem;
        }

        .footer-text p {
            color: var(--brown);
            margin: 0;
            font-size: 0.85rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 1.5rem 0;
            flex-wrap: wrap;
        }

        .footer-link {
            color: var(--brown);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .footer-link:hover {
            color: var(--primary-green);
            transform: translateY(-2px);
        }

        .footer-copyright {
            color: var(--brown);
            font-size: 0.85rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid rgba(82, 183, 136, 0.2);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(45, 106, 79, 0.1);
            overflow: hidden;
            background: white;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border: none;
            padding: 1.5rem;
            color: white;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .content-wrapper {
                padding: 2rem;
                margin: 1.5rem;
                border-radius: 20px;
            }

            .page-title {
                font-size: 1.6rem;
            }

            .brand-name {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.1rem;
            }

            .brand-logo {
                width: 42px;
                height: 42px;
            }

            .content-wrapper {
                padding: 1.5rem;
                margin: 1rem;
            }

            .page-title {
                font-size: 1.4rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 0.75rem;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cream);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 6px;
            border: 2px solid var(--cream);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--secondary-green), var(--light-green));
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-village">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <div class="brand-logo">
                    <img src="{{ asset('images/logokap.png') }}" alt="Logo Desa" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <i class="bi bi-houses-fill" style="display: none;"></i>
                </div>
                <div class="brand-text">
                    <span class="brand-name">Sistem Surat Desa</span>
                    <span class="brand-tagline">Pelayanan Digital</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    @if(Auth::user()->role === 'warga')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('surat.create') ? 'active' : '' }}" href="{{ route('surat.create') }}">
                            <i class="bi bi-file-earmark-plus-fill"></i> Ajukan Surat
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="bi bi-people-fill"></i> Kelola Warga
                        </a>
                    </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar-nav">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">
                                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.8);">Login sebagai</div>
                                <strong style="color: white; font-size: 1.1rem;">{{ ucfirst(Auth::user()->role) }}</strong>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; width: 100%; text-align: left;">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="content-wrapper">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill"></i>
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logokap.png') }}" alt="Logo Desa" onerror="this.style.display='none';">
                    </div>
                    <div class="footer-text">
                        <h4>Sistem Surat Desa</h4>
                        <p>Melayani Dengan Hati untuk Desa yang Maju</p>
                    </div>
                </div>
                
                <div class="footer-links">
                    <a href="#" class="footer-link">
                        <i class="bi bi-info-circle"></i> Tentang Kami
                    </a>
                    <a href="#" class="footer-link">
                        <i class="bi bi-question-circle"></i> Bantuan
                    </a>
                    <a href="#" class="footer-link">
                        <i class="bi bi-shield-check"></i> Kebijakan Privasi
                    </a>
                    <a href="#" class="footer-link">
                        <i class="bi bi-envelope"></i> Kontak
                    </a>
                </div>
                
                <div class="footer-copyright">
                    <p>&copy; 2026 Sistem Surat Desa. Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> untuk kemajuan desa</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const timeoutId = setTimeout(() => {
                    if (document.body.contains(alert)) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
                
                alert.addEventListener('closed.bs.alert', () => {
                    clearTimeout(timeoutId);
                });
            });
        });
    </script>
</body>
</html>