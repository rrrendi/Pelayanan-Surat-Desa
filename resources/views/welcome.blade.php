<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelayanan Desa Sayati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #2d6a4f;
            --secondary-green: #40916c;
            --gold: #f59e0b;
            --transition-smooth: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        body {
            font-family: 'Poppins', sans-serif;
            color: #2c3e50;
            overflow-x: hidden;
            background-color: #f8fafc;
        }

        /* --- Keyframe Animations (Penghilang Kaku) --- */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }

        /* --- Navbar Glass Dinamis --- */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 4px 30px rgba(0,0,0,0.05);
            padding: 15px 0;
            transition: var(--transition-smooth);
        }
        .navbar-brand {
            color: var(--primary-green) !important;
            font-weight: 800;
            font-size: 1.4rem;
        }
        .nav-link {
            font-weight: 500;
            color: #495057;
            margin: 0 10px;
            border-radius: 50px;
            padding: 8px 18px !important;
            transition: var(--transition-smooth);
        }
        .nav-link:hover {
            color: var(--primary-green);
            background-color: rgba(45, 106, 79, 0.05);
        }

        /* --- Hero Section with Parallax --- */
        .hero-section {
            /* Efek Parallax (fixed) dan overlay gradien transparan */
            background: linear-gradient(135deg, rgba(45, 106, 79, 0.92), rgba(27, 67, 50, 0.85)), 
                        url('https://images.unsplash.com/photo-1599059813005-11265ba4b4ce?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
            background-attachment: fixed; /* Ini membuat gambar diam saat discroll */
            color: white;
            padding: 180px 0 120px;
            min-height: 90vh;
            display: flex;
            align-items: center;
            position: relative;
        }
        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            text-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .hero-subtitle {
            font-size: 1.1rem;
            line-height: 1.8;
            opacity: 0.9;
            margin-bottom: 2.5rem;
        }
        .floating-img {
            animation: float 6s ease-in-out infinite;
            filter: drop-shadow(0 25px 35px rgba(0,0,0,0.3));
        }

        /* --- Feature Cards (Super Smooth) --- */
        .feature-card {
            background: #ffffff;
            border: none;
            border-radius: 30px; /* Sudut sangat membulat */
            padding: 2.5rem 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: var(--transition-smooth);
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        /* Efek hover dinamis */
        .feature-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 100%;
            background: linear-gradient(180deg, rgba(45, 106, 79, 0.02) 0%, rgba(255,255,255,0) 100%);
            z-index: -1; opacity: 0; transition: var(--transition-smooth);
        }
        .feature-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(45, 106, 79, 0.12);
        }
        .feature-card:hover::before { opacity: 1; }
        
        .icon-box {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, rgba(45, 106, 79, 0.1), rgba(64, 145, 108, 0.1));
            color: var(--primary-green);
            border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 1.8rem;
            transition: var(--transition-smooth);
        }
        .feature-card:hover .icon-box {
            background: var(--primary-green);
            color: white;
            transform: rotate(-10deg) scale(1.1);
        }

        /* --- Premium Buttons --- */
        .btn-custom-primary {
            background: var(--gold);
            color: white;
            border: none;
            font-weight: 600;
            padding: 14px 35px;
            border-radius: 50px;
            transition: var(--transition-smooth);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        .btn-custom-primary:hover {
            background: #d97706;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(245, 158, 11, 0.4);
        }
        .btn-custom-outline {
            background-color: transparent;
            border: 2px solid rgba(255,255,255,0.8);
            color: white;
            font-weight: 600;
            padding: 12px 35px;
            border-radius: 50px;
            transition: var(--transition-smooth);
        }
        .btn-custom-outline:hover {
            background-color: white;
            color: var(--primary-green);
            border-color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Badge glow */
        .badge-glow {
            animation: pulse-glow 2s infinite;
        }

        /* --- Footer --- */
        footer {
            background-color: #1b4332;
            color: white;
            padding: 4rem 0 2rem;
            position: relative;
        }
        .footer-wave {
            position: absolute; top: -50px; left: 0; width: 100%; height: 50px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg"><path fill="%231b4332" fill-opacity="1" d="M0,160L48,160C96,160,192,160,288,181.3C384,203,480,245,576,234.7C672,224,768,160,864,138.7C960,117,1056,139,1152,160C1248,181,1344,203,1392,213.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar">

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logokap.png') }}" alt="Logo" width="40" class="me-2 drop-shadow" onerror="this.src='https://via.placeholder.com/40'">
                Desa Sayati
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#informasi">Informasi</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-custom-primary py-2 px-4 shadow-sm" style="font-size: 0.8rem;">Dasbor Saya</a>
                    @else
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: var(--primary-green);">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-custom-primary py-2 px-4 shadow-sm" style="font-size: 0.8rem;">Daftar Akun</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section id="beranda" class="hero-section">
        <div class="container text-center text-lg-start z-1">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <span class="badge bg-warning text-dark mb-4 px-4 py-2 rounded-pill fs-6 badge-glow">
                        ✨ Sistem Pelayanan Digital Cerdas
                    </span>
                    <h1 class="hero-title">Akses Layanan Desa <br>Lebih Mudah & Dekat</h1>
                    <p class="hero-subtitle pe-lg-5">Tinggalkan antrean panjang. Kini Anda dapat mengajukan berbagai dokumen administrasi Desa Sayati secara online kapan saja, dari mana saja.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-custom-primary"><i class="bi bi-grid-fill me-2"></i> Buka Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-custom-primary"><i class="bi bi-arrow-right-circle me-2"></i> Mulai Sekarang</a>
                            <a href="#layanan" class="btn-custom-outline"><i class="bi bi-play-circle me-2"></i> Lihat Fitur</a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <div class="position-relative">
                        <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-circle opacity-10" style="width: 350px; height: 350px; filter: blur(40px);"></div>
                        <img src="{{ asset('images/logokap.png') }}" alt="Ilustrasi Desa" class="img-fluid floating-img position-relative" style="max-height: 380px;" onerror="this.style.display='none'">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="py-5">
        <div class="container py-5 my-4">
            <div class="text-center mb-5 pb-3">
                <span class="text-success fw-bold text-uppercase tracking-wider rounded-pill bg-success bg-opacity-10 px-3 py-1 small">Layanan Terpadu</span>
                <h2 class="fw-bold mt-3 display-6" style="color: var(--primary-green);">Apa yang dapat Anda lakukan?</h2>
                <div class="mx-auto mt-4" style="height: 5px; width: 80px; background-color: var(--gold); border-radius: 5px;"></div>
            </div>

            <div class="row g-4 px-2">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="icon-box mx-auto">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Pengajuan Digital</h4>
                        <p class="text-muted mb-0">Ajukan surat seperti SKTM, Keterangan Usaha, dan Domisili secara paperless. Cukup isi form dari smartphone Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="icon-box mx-auto">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Notifikasi Real-Time</h4>
                        <p class="text-muted mb-0">Pantau pergerakan status surat Anda. Anda akan tahu persis kapan surat sedang diproses atau sudah ditandatangani.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="icon-box mx-auto">
                            <i class="bi bi-printer"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Cetak Mandiri</h4>
                        <p class="text-muted mb-0">Surat yang telah disetujui akan diubah menjadi format PDF resmi yang siap Anda unduh dan cetak di rumah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="informasi">
        <div class="footer-wave"></div>
        <div class="container pt-4">
            <div class="row gy-4 mb-4">
                <div class="col-lg-5 pe-lg-5">
                    <h4 class="fw-bold text-white mb-4 d-flex align-items-center gap-3">
                        <div class="bg-white rounded-circle p-1">
                            <img src="{{ asset('images/logokap.png') }}" width="35" onerror="this.style.display='none'"> 
                        </div>
                        Desa Sayati
                    </h4>
                    <p class="text-white-50" style="line-height: 1.8;">Sistem Pelayanan Administrasi Desa Sayati hadir untuk mendobrak birokrasi yang panjang. Kami berkomitmen memberikan layanan cepat, transparan, dan dapat diandalkan oleh seluruh lapisan masyarakat.</p>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <h5 class="text-white fw-bold mb-4">Akses Cepat</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3">
                        <li><a href="#beranda" class="text-white-50 text-decoration-none hover-white" style="transition: 0.3s;">Beranda System</a></li>
                        <li><a href="#layanan" class="text-white-50 text-decoration-none hover-white" style="transition: 0.3s;">Panduan Layanan</a></li>
                        <li><a href="{{ route('login') }}" class="text-white-50 text-decoration-none hover-white" style="transition: 0.3s;">Masuk Akun Warga</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="text-white fw-bold mb-4">Hubungi Kami</h5>
                    <ul class="list-unstyled text-white-50 d-flex flex-column gap-3">
                        <li class="d-flex align-items-center"><i class="bi bi-geo-alt fs-5 me-3 text-warning"></i> Jl. Raya Kopo Sayati No. 123</li>
                        <li class="d-flex align-items-center"><i class="bi bi-envelope fs-5 me-3 text-warning"></i> pemdes@sayati.desa.id</li>
                        <li class="d-flex align-items-center"><i class="bi bi-telephone fs-5 me-3 text-warning"></i> (022) 1234567</li>
                    </ul>
                </div>
            </div>
            <div class="border-top border-secondary pt-4 text-center mt-5">
                <p class="text-white-50 small mb-0">&copy; {{ date('Y') }} Pemerintah Desa Sayati. Dirancang untuk kenyamanan warga.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Efek shrink navbar saat di scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.style.padding = '10px 0';
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            } else {
                navbar.style.padding = '15px 0';
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.85)';
            }
        });
    </script>
</body>
</html>