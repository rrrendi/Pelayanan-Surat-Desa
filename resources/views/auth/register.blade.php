<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - Sistem Surat Desa</title>
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
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #d4f1f4 0%, #b5e7a0 50%, #95d5b2 100%);
            min-height: 100vh;
            padding: 2rem 0;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 15 L60 35 L80 35 L65 50 L70 70 L50 55 L30 70 L35 50 L20 35 L40 35 Z' fill='%23ffffff' opacity='0.05'/%3E%3C/svg%3E");
            background-size: 100px 100px;
            animation: drift 40s infinite linear;
        }

        @keyframes drift {
            from { background-position: 0 0; }
            to { background-position: 100px 100px; }
        }

        .register-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .register-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 30px 80px rgba(45, 106, 79, 0.3);
            overflow: hidden;
            border: 4px solid var(--gold);
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            color: white;
            padding: 2.5rem;
            text-align: center;
            position: relative;
        }

        .register-header::before {
            content: '🏘️';
            position: absolute;
            font-size: 10rem;
            opacity: 0.1;
            right: -30px;
            top: -20px;
        }

        .register-header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .register-header p {
            font-size: 1.05rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .register-body {
            padding: 2.5rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--primary-green);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid var(--gold);
        }

        .section-title i {
            font-size: 1.5rem;
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

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 0.85rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
        }

        .input-status {
            font-size: 0.85rem;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            display: none;
            align-items: center;
            gap: 0.5rem;
        }

        .input-valid {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .input-invalid {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border: none;
            border-radius: 14px;
            padding: 1.1rem;
            font-weight: 700;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 1.05rem;
            box-shadow: 0 6px 20px rgba(45, 106, 79, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.4);
            background: linear-gradient(135deg, var(--secondary-green), var(--light-green));
        }

        .alert {
            border: none;
            border-radius: 14px;
            padding: 1.1rem;
            margin-bottom: 1.5rem;
            border-left: 5px solid;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-left-color: #dc2626;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f1f5f9;
        }

        .login-link a {
            color: var(--primary-green);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: var(--secondary-green);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .register-header h1 {
                font-size: 1.75rem;
            }
            
            .register-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="register-card">
            <div class="register-header">
                <h1><i class="bi bi-person-plus-fill"></i> Daftar Akun Baru</h1>
                <p>Lengkapi data diri Anda untuk mendaftar sebagai warga</p>
            </div>

            <div class="register-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="bi bi-exclamation-triangle-fill"></i> Terjadi Kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Section: Identitas Diri -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="bi bi-person-vcard"></i>
                            Identitas Diri
                        </h3>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-person"></i> Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" 
                                       required placeholder="Sesuai KTP">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-credit-card"></i> NIK <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nik" id="nikInput" class="form-control" 
                                       value="{{ old('nik') }}" required placeholder="16 digit NIK" 
                                       maxlength="16" pattern="[0-9]{16}">
                                <div class="input-status" id="nikStatus"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-geo-alt"></i> Tempat Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tempat_lahir" class="form-control" 
                                       value="{{ old('tempat_lahir') }}" required placeholder="Kota/Kabupaten">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-calendar"></i> Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" class="form-control" 
                                       value="{{ old('tanggal_lahir') }}" required max="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-gender-ambiguous"></i> Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-bookmark"></i> Agama <span class="text-danger">*</span>
                                </label>
                                <select name="agama" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Data Tambahan -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="bi bi-card-checklist"></i>
                            Data Tambahan
                        </h3>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-briefcase"></i> Pekerjaan <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="pekerjaan" class="form-control" 
                                       value="{{ old('pekerjaan') }}" required placeholder="Contoh: Wiraswasta">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-heart"></i> Status Perkawinan <span class="text-danger">*</span>
                                </label>
                                <select name="status_perkawinan" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                    <option value="{{ $status }}" {{ old('status_perkawinan') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-house"></i> Alamat Lengkap <span class="text-danger">*</span>
                            </label>
                            <textarea name="alamat" class="form-control" rows="3" required 
                                      placeholder="Jl. Nama Jalan No. X, RT/RW, Kelurahan, Kecamatan">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <!-- Section: Akun -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="bi bi-shield-lock"></i>
                            Akun & Keamanan
                        </h3>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" id="emailInput" class="form-control" 
                                       value="{{ old('email') }}" required placeholder="email@example.com">
                                <div class="input-status" id="emailStatus"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-lock"></i> Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password" id="password" class="form-control" 
                                       required placeholder="Minimal 8 karakter" minlength="8">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-lock-fill"></i> Konfirmasi Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password_confirmation" id="passwordConfirmation" 
                                       class="form-control" required placeholder="Ulangi password">
                                <div class="input-status" id="passwordStatus"></div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-register" id="btnSubmit">
                        <i class="bi bi-person-plus"></i> Daftar Sekarang
                    </button>

                    <div class="login-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // NIK Validation
        const nikInput = document.getElementById('nikInput');
        const nikStatus = document.getElementById('nikStatus');
        let nikTimeout;

        nikInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            
            clearTimeout(nikTimeout);
            
            if (this.value.length === 16) {
                nikTimeout = setTimeout(() => checkNik(this.value), 500);
            } else if (this.value.length > 0) {
                nikStatus.style.display = 'flex';
                nikStatus.className = 'input-status input-invalid';
                nikStatus.innerHTML = '<i class="bi bi-x-circle"></i> NIK harus tepat 16 digit';
            } else {
                nikStatus.style.display = 'none';
            }
        });

        function checkNik(nik) {
            fetch('/check-nik', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ nik: nik })
            })
            .then(res => res.json())
            .then(data => {
                nikStatus.style.display = 'flex';
                if (data.available) {
                    nikStatus.className = 'input-status input-valid';
                    nikStatus.innerHTML = '<i class="bi bi-check-circle"></i> ' + data.message;
                } else {
                    nikStatus.className = 'input-status input-invalid';
                    nikStatus.innerHTML = '<i class="bi bi-x-circle"></i> ' + data.message;
                }
            });
        }

        // Email Validation
        const emailInput = document.getElementById('emailInput');
        const emailStatus = document.getElementById('emailStatus');
        let emailTimeout;

        emailInput.addEventListener('input', function() {
            clearTimeout(emailTimeout);
            
            const email = this.value.trim();
            if (email && email.includes('@')) {
                emailTimeout = setTimeout(() => checkEmail(email), 500);
            } else {
                emailStatus.style.display = 'none';
            }
        });

        function checkEmail(email) {
            fetch('/check-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ email: email })
            })
            .then(res => res.json())
            .then(data => {
                emailStatus.style.display = 'flex';
                if (data.available) {
                    emailStatus.className = 'input-status input-valid';
                    emailStatus.innerHTML = '<i class="bi bi-check-circle"></i> ' + data.message;
                } else {
                    emailStatus.className = 'input-status input-invalid';
                    emailStatus.innerHTML = '<i class="bi bi-x-circle"></i> ' + data.message;
                }
            });
        }

        // Password Match
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('passwordConfirmation');
        const passwordStatus = document.getElementById('passwordStatus');

        function checkPasswordMatch() {
            if (passwordConfirmation.value) {
                passwordStatus.style.display = 'flex';
                if (password.value === passwordConfirmation.value) {
                    passwordStatus.className = 'input-status input-valid';
                    passwordStatus.innerHTML = '<i class="bi bi-check-circle"></i> Password cocok';
                } else {
                    passwordStatus.className = 'input-status input-invalid';
                    passwordStatus.innerHTML = '<i class="bi bi-x-circle"></i> Password tidak cocok';
                }
            } else {
                passwordStatus.style.display = 'none';
            }
        }

        password.addEventListener('input', checkPasswordMatch);
        passwordConfirmation.addEventListener('input', checkPasswordMatch);

        // Form Submission
        const form = document.getElementById('registerForm');
        const btnSubmit = document.getElementById('btnSubmit');

        form.addEventListener('submit', function(e) {
            if (nikInput.value.length !== 16) {
                e.preventDefault();
                alert('NIK harus tepat 16 digit!');
                nikInput.focus();
                return;
            }

            if (password.value !== passwordConfirmation.value) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                passwordConfirmation.focus();
                return;
            }

            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="bi bi-hourglass-split"></i> Mendaftar...';
        });
    </script>
</body>
</html>