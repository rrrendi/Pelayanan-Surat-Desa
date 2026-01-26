<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Surat Desa</title>
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
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #d4f1f4 0%, #b5e7a0 50%, #95d5b2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative Background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 15 L60 35 L80 35 L65 50 L70 70 L50 55 L30 70 L35 50 L20 35 L40 35 Z' fill='%23ffffff' opacity='0.05'/%3E%3C/svg%3E"),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='20' fill='none' stroke='%23ffffff' stroke-width='1' opacity='0.05'/%3E%3C/svg%3E");
            background-size: 100px 100px, 60px 60px;
            background-position: 0 0, 50px 50px;
            animation: drift 40s infinite linear;
        }

        @keyframes drift {
            from { background-position: 0 0, 50px 50px; }
            to { background-position: 100px 100px, 150px 150px; }
        }

        .login-container {
            width: 100%;
            max-width: 1100px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-wrapper {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 0;
            background: white;
            border-radius: 30px;
            box-shadow: 0 30px 80px rgba(45, 106, 79, 0.3);
            overflow: hidden;
            animation: slideUp 0.6s ease;
            border: 4px solid var(--gold);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left Side - Welcome Section */
        .login-left {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            padding: 3.5rem;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(82, 183, 136, 0.2) 0%, transparent 70%);
            animation: pulse 6s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 0.8; }
        }

        /* Village Icon Pattern */
        .login-left::after {
            content: '🏘️';
            position: absolute;
            font-size: 15rem;
            opacity: 0.05;
            right: -50px;
            bottom: -50px;
            transform: rotate(-15deg);
        }

        .welcome-section {
            position: relative;
            z-index: 1;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-icon {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border: 3px solid var(--gold);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .logo-icon i {
            font-size: 3.5rem;
            color: white;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .welcome-section p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .features {
            display: grid;
            gap: 1.25rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.25rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateX(10px);
            border-color: var(--gold);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: var(--gold);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(212, 165, 116, 0.4);
        }

        .feature-icon i {
            font-size: 1.5rem;
            color: var(--dark);
        }

        .feature-content strong {
            display: block;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .feature-content p {
            font-size: 0.9rem;
            margin: 0;
            opacity: 0.9;
        }

        /* Right Side - Login Form */
        .login-right {
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .login-header p {
            color: var(--brown);
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-green);
            font-size: 1.2rem;
            z-index: 10;
        }

        .form-control {
            border-radius: 14px;
            border: 2px solid #e0e0e0;
            padding: 0.95rem 1rem 0.95rem 3.5rem;
            transition: all 0.3s ease;
            background: white;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
            background: white;
            outline: none;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border: none;
            border-radius: 14px;
            padding: 1.1rem;
            font-weight: 700;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 1.05rem;
            margin-top: 0.5rem;
            box-shadow: 0 6px 20px rgba(45, 106, 79, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.4);
            background: linear-gradient(135deg, var(--secondary-green), var(--light-green));
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .alert {
            border: none;
            border-radius: 14px;
            padding: 1.1rem;
            margin-bottom: 1.5rem;
            border-left: 5px solid;
            animation: slideDown 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-left-color: #dc2626;
        }

        .alert i {
            font-size: 1.3rem;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f1f5f9;
        }

        .register-link a {
            color: var(--primary-green);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: var(--secondary-green);
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                border-radius: 25px;
            }

            .login-left {
                padding: 2.5rem;
                text-align: center;
            }

            .login-left::after {
                display: none;
            }

            .features {
                display: none;
            }

            .welcome-section h1 {
                font-size: 2rem;
            }

            .login-right {
                padding: 2.5rem 2rem;
            }
        }

        @media (max-width: 576px) {
            .login-right {
                padding: 2rem 1.5rem;
            }

            .login-header h2 {
                font-size: 1.6rem;
            }

            .welcome-section h1 {
                font-size: 1.75rem;
            }

            .logo-icon {
                width: 80px;
                height: 80px;
            }

            .logo-icon i {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="login-wrapper">
            <div class="login-left">
                <div class="welcome-section">
                    <div class="logo-section">
                        <div class="logo-icon">
                            <i class="bi bi-houses-fill"></i>
                        </div>
                    </div>
                    
                    <h1>Sistem Surat Desa</h1>
                    <p>Solusi Digital Modern untuk Pelayanan Administrasi Desa yang Cepat, Mudah, dan Terpercaya</p>

                    <div class="features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-lightning-charge-fill"></i>
                            </div>
                            <div class="feature-content">
                                <strong>Proses Instan</strong>
                                <p>Pengajuan surat dalam hitungan menit</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="feature-content">
                                <strong>Aman Terpercaya</strong>
                                <p>Data Anda terlindungi dengan enkripsi</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="feature-content">
                                <strong>Tracking Real-time</strong>
                                <p>Pantau status surat kapan saja</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="login-right">
                <div class="login-header">
                    <h2>
                        <i class="bi bi-door-open-fill"></i>
                        Selamat Datang
                    </h2>
                    <p>Silakan login untuk melanjutkan</p>
                </div>

                @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        <strong>Login Gagal!</strong><br>
                        <small>{{ $errors->first() }}</small>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-envelope-fill"></i>
                            Email Address
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope-fill input-icon"></i>
                            <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-lock-fill"></i>
                            Password
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Masuk ke Dashboard
                    </button>

                    <div class="register-link">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>