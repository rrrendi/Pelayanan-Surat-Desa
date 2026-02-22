<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Desa Sayati</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Latar belakang sama dengan Welcome */
            background: linear-gradient(135deg, rgba(45, 106, 79, 0.92), rgba(27, 67, 50, 0.85)), 
                        url('https://images.unsplash.com/photo-1599059813005-11265ba4b4ce?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
            background-attachment: fixed;
            padding: 2rem 0;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: none;
            border-radius: 30px; /* Sudut organik */
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
        }
        .auth-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 8px;
            background: linear-gradient(90deg, var(--gold), #fbbf24);
        }
        .form-control {
            border-radius: 15px;
            padding: 12px 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: var(--transition-smooth);
        }
        .form-control:focus {
            background: #fff;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        }
        .btn-custom-primary {
            background: var(--primary-green);
            color: white;
            border: none;
            font-weight: 600;
            padding: 14px;
            border-radius: 50px;
            transition: var(--transition-smooth);
            width: 100%;
            box-shadow: 0 10px 20px rgba(45, 106, 79, 0.2);
        }
        .btn-custom-primary:hover {
            background: var(--secondary-green);
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(45, 106, 79, 0.3);
            color: white;
        }
        .back-link {
            position: absolute; top: 20px; left: 20px;
            color: rgba(255,255,255,0.8); text-decoration: none; font-weight: 500;
            transition: var(--transition-smooth);
            background: rgba(0,0,0,0.2); padding: 8px 15px; border-radius: 50px;
        }
        .back-link:hover { background: rgba(0,0,0,0.4); color: white; }
    </style>
</head>
<body>

    <a href="{{ url('/') }}" class="back-link"><i class="bi bi-arrow-left"></i> Kembali</a>

    <div class="container d-flex justify-content-center">
        <div class="auth-card">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logokap.png') }}" width="60" alt="Logo" class="mb-3 drop-shadow" onerror="this.src='https://via.placeholder.com/60'">
                <h3 class="fw-bold" style="color: var(--primary-green);">Masuk Sistem</h3>
                <p class="text-muted small">Silakan masuk menggunakan akun Warga Anda.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4 border-0 small">
                    <ul class="mb-0 ps-3">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted fw-semibold small px-2">Alamat Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between px-2">
                        <label class="form-label text-muted fw-semibold small">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-decoration-none fw-bold" style="color: var(--gold);">Lupa Sandi?</a>
                        @endif
                    </div>
                    <input type="password" class="form-control" name="password" required>
                </div>
                
                <button type="submit" class="btn-custom-primary mt-2">Masuk Sekarang</button>
                
                <div class="text-center mt-4">
                    <p class="text-muted small mb-0">Belum memiliki akun? 
                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--gold);">Daftar Baru</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>