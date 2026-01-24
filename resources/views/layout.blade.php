<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pelayanan Surat Desa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2d5016;
            --primary-light: #3d6b1f;
            --secondary: #8b6914;
            --accent: #d4af37;
            --success: #4a7c2c;
            --danger: #c62828;
            --warning: #f57c00;
            --light: #f5f5f0;
            --dark: #2c2416;
            --cream: #faf8f3;
        }

        body {
            background-color: var(--light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark);
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 2px 15px rgba(45, 80, 22, 0.2);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand .logo {
            width: 40px;
            height: 40px;
            background: var(--accent);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white !important;
        }

        .navbar-nav .nav-link i {
            margin-right: 5px;
        }

        /* Content Wrapper */
        .content-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        /* Card Styles */
        .card {
            border: 1px solid #e8e5dc;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border: none;
            padding: 1.2rem 1.5rem;
            color: white;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #3d6b1f;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #a31e1e;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        /* Badge */
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .badge.bg-warning {
            background-color: var(--warning) !important;
            color: white;
        }

        .badge.bg-success {
            background-color: var(--success) !important;
        }

        .badge.bg-danger {
            background-color: var(--danger) !important;
        }

        /* Table */
        .table {
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #f0ede5;
        }

        .table tbody tr:hover {
            background-color: #faf8f3;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* Alert */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: var(--success);
            border-left-color: var(--success);
        }

        .alert-danger {
            background-color: #ffebee;
            color: var(--danger);
            border-left-color: var(--danger);
        }

        .alert-info {
            background-color: #e3f2fd;
            color: #1976d2;
            border-left-color: #1976d2;
        }

        .alert-warning {
            background-color: #fff3e0;
            color: var(--secondary);
            border-left-color: var(--warning);
        }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e8e5dc;
            padding: 0.7rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(45, 80, 22, 0.15);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        /* Stats Card */
        .stats-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }

        .stats-card p {
            margin: 0;
            opacity: 0.95;
            font-size: 1rem;
        }

        .stats-card.warning {
            background: linear-gradient(135deg, var(--warning) 0%, var(--secondary) 100%);
        }

        .stats-card.success {
            background: linear-gradient(135deg, var(--success) 0%, var(--primary-light) 100%);
        }

        .stats-card.danger {
            background: linear-gradient(135deg, var(--danger) 0%, #b71c1c 100%);
        }

        /* Modal */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 1.2rem 1.5rem;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        /* Dropdown */
        .dropdown-menu {
            border-radius: 10px;
            border: 1px solid #e8e5dc;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 0.7rem 1.2rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--light);
            color: var(--primary);
        }

        /* Page Title */
        .page-title {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 1rem;
            border-bottom: 3px solid var(--accent);
        }

        .page-title i {
            color: var(--accent);
            font-size: 1.8rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 5rem;
            color: #d4d4d0;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #8e8e88;
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1.5rem;
                margin-top: 1rem;
                border-radius: 10px;
            }

            .stats-card h3 {
                font-size: 2rem;
            }

            .table {
                font-size: 0.9rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .card-header h5 {
                font-size: 1rem;
            }

            .stats-card {
                padding: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <span class="logo">
                    <i class="bi bi-building"></i>
                </span>
                <span>Sistem Surat Desa</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-fill"></i> Dashboard
                        </a>
                    </li>
                    @if(Auth::user()->role === 'warga')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('surat.create') }}">
                            <i class="bi bi-file-earmark-plus-fill"></i> Ajukan Surat
                        </a>
                    </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">
                                <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>