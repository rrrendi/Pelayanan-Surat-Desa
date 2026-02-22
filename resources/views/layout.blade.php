<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Pelayanan') - Desa Sayati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-green: #2d6a4f;
            --secondary-green: #40916c;
            --gold: #f59e0b;
            --bg-body: #f8fafc;
            --transition-smooth: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        body {
            background-color: var(--bg-body);
            font-family: 'Poppins', sans-serif;
            color: #2c3e50;
            padding-top: 100px;
        }
        
        /* Navbar Dinamis */
        .navbar-dash {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            box-shadow: 0 4px 30px rgba(0,0,0,0.03);
            padding: 15px 0;
        }
        .navbar-brand { font-weight: 800; color: var(--primary-green) !important; font-size: 1.3rem; }
        .nav-link { font-weight: 500; border-radius: 50px; padding: 8px 20px !important; margin: 0 5px; color: #495057 !important; transition: var(--transition-smooth); }
        .nav-link:hover, .nav-link.active { background-color: rgba(45, 106, 79, 0.08); color: var(--primary-green) !important; }

        /* Buttons Organic */
        .btn-gold {
            background: var(--gold); color: white; border: none; font-weight: 600; padding: 10px 25px; border-radius: 50px; transition: var(--transition-smooth); box-shadow: 0 8px 15px rgba(245, 158, 11, 0.2);
        }
        .btn-gold:hover { background: #d97706; transform: translateY(-3px); box-shadow: 0 12px 20px rgba(245, 158, 11, 0.3); color: white; }
        .btn-green {
            background: var(--primary-green); color: white; border: none; font-weight: 600; padding: 10px 25px; border-radius: 50px; transition: var(--transition-smooth); box-shadow: 0 8px 15px rgba(45, 106, 79, 0.2);
        }
        .btn-green:hover { background: var(--secondary-green); transform: translateY(-3px); box-shadow: 0 12px 20px rgba(45, 106, 79, 0.3); color: white; }

        /* General Card Organic */
        .card-organic {
            background: #ffffff;
            border: none;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        /* Custom SweetAlert */
        .swal2-popup { border-radius: 30px !important; font-family: 'Poppins', sans-serif !important; }

        /* --- FIX TUNTAS BUG LINGKARAN HITAM SWEETALERT VS TAILWIND --- */
        .swal2-popup { 
            border-radius: 24px !important; 
        }
        
        /* 1. Warnai lingkaran luar ikon dengan hijau */
        .swal2-icon.swal2-success {
            border-color: #10b981 !important;
        }
        
        /* 2. HANCURKAN semua border hitam paksaan dari Tailwind di dalam ikon */
        .swal2-icon.swal2-success * {
            border: none !important;
            box-shadow: none !important;
        }
        
        /* 3. Kembalikan border HANYA untuk cincin (ring) hijau yang beranimasi */
        .swal2-icon.swal2-success .swal2-success-ring {
            border: 4px solid rgba(16, 185, 129, 0.3) !important;
            box-sizing: content-box !important;
        }
        
        /* 4. Warnai garis centang (checkmark) dengan hijau utama */
        .swal2-icon.swal2-success [class^=swal2-success-line] {
            background-color: #10b981 !important;
        }
        
        /* 5. Paksa elemen "penutup" animasi menjadi putih (warna background popup) */
        .swal2-icon.swal2-success .swal2-success-circular-line-left,
        .swal2-icon.swal2-success .swal2-success-circular-line-right,
        .swal2-icon.swal2-success .swal2-success-fix {
            background-color: #ffffff !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dash fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logokap.png') }}" alt="Logo" width="35" onerror="this.style.display='none'">
                Sayati Digital
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-grid-fill me-1"></i> Dasbor</a>
                    </li>
                    @if(Auth::user()->role === 'warga')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('surat.create') ? 'active' : '' }}" href="{{ route('surat.create') }}"><i class="bi bi-file-earmark-plus-fill me-1"></i> Buat Surat</a>
                        </li>
                    @endif
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}"><i class="bi bi-people-fill me-1"></i> Kelola Warga</a>
                        </li>
                    @endif
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-light rounded-pill border-0 d-flex align-items-center gap-2 px-3 py-2 shadow-sm" type="button" data-bs-toggle="dropdown" style="background: white;">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 30px; height: 30px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="fw-semibold">{{ explode(' ', Auth::user()->name)[0] }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3" style="border-radius: 20px; padding: 10px;">
                            <li><a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-2"></i> Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item rounded-3 py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    @yield('modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                // Simpan pesan ke variabel JS secara aman dari bug tanda kutip
                let pesanSukses = {!! json_encode(session('success')) !!};
                
                Swal.fire({
                    icon: 'success',
                    title: '<h4 style="font-family:\'Poppins\', sans-serif; font-weight:700; color: var(--primary-green); margin-bottom: 0;">Berhasil!</h4>',
                    html: '<p style="font-family:\'Poppins\', sans-serif; color: #64748b; font-size: 0.95rem; margin-top: 5px;">' + pesanSukses + '</p>',
                    timer: 3000,
                    showConfirmButton: false,
                    background: '#ffffff',
                    iconColor: '#10b981',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0'
                    }
                });
            @endif

            @if(session('error'))
                // Simpan pesan error secara aman
                let pesanError = {!! json_encode(session('error')) !!};

                Swal.fire({
                    icon: 'error',
                    title: '<h4 style="font-family:\'Poppins\', sans-serif; font-weight:700; color: #dc3545; margin-bottom: 0;">Gagal!</h4>',
                    html: '<p style="font-family:\'Poppins\', sans-serif; color: #64748b; font-size: 0.95rem; margin-top: 5px;">' + pesanError + '</p>',
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0'
                    }
                });
            @endif
        });
    </script>
</body>
</html>