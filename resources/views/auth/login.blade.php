<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Surat Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary: #0f172a;
            --primary-light: #1e293b;
            --accent: #3b82f6;
            --accent-dark: #2563eb;
            --success: #10b981;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #0f172a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            animation: float 20s infinite linear;
        }

        @keyframes float {
            from { transform: translate(0, 0); }
            to { transform: translate(-100px, 100px); }
        }

        .login-container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-left {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 3rem;
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
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            animation: pulse 4s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .logo-section {
            position: relative;
            z-index: 1;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: var(--accent);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }

        .logo-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .login-left h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .login-left p {
            font-size: 1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features {
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: var(--accent);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon i {
            font-size: 1.2rem;
        }

        .login-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-header h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 0.9rem 1rem 0.9rem 3.2rem;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            background: white;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .input-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            z-index: 10;
            font-size: 1.1rem;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 1rem;
            margin-top: 0.5rem;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .demo-section {
            margin-top: 2rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
        }

        .demo-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .demo-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .demo-tab {
            flex: 1;
            padding: 0.7rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .demo-tab:hover {
            border-color: var(--accent);
            background: #f8fafc;
        }

        .demo-tab.active {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .demo-content {
            display: none;
        }

        .demo-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .credential-item {
            margin-bottom: 0.8rem;
        }

        .credential-label {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 0.3rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .credential-field {
            display: flex;
            gap: 0.5rem;
        }

        .credential-text {
            flex: 1;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            font-family: 'Courier New', monospace;
            color: var(--dark);
            user-select: all;
            transition: all 0.2s ease;
        }

        .credential-text:hover {
            border-color: var(--accent);
            background: #f8fafc;
        }

        .btn-copy {
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-weight: 600;
        }

        .btn-copy:hover {
            background: var(--accent-dark);
            transform: scale(1.05);
        }

        .btn-copy.copied {
            background: var(--success);
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-danger {
            background: #fef2f2;
            color: var(--danger);
            border-left-color: var(--danger);
        }

        @media (max-width: 992px) {
            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .login-left {
                padding: 2rem;
            }

            .features {
                display: none;
            }

            .login-left h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .login-right {
                padding: 2rem 1.5rem;
            }

            .login-header h3 {
                font-size: 1.5rem;
            }

            .demo-tab {
                font-size: 0.75rem;
                padding: 0.6rem;
            }

            .credential-text {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-wrapper">
            <div class="login-left">
                <div class="logo-section">
                    <div class="logo-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <h2>Sistem Surat Desa</h2>
                    <p>Solusi Digital untuk Pelayanan Administrasi Desa yang Modern dan Efisien</p>
                </div>

                <div class="features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <div>
                            <strong>Proses Cepat</strong>
                            <p style="font-size: 0.85rem; margin: 0; opacity: 0.8;">Pengajuan surat dalam hitungan menit</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <strong>Aman & Terpercaya</strong>
                            <p style="font-size: 0.85rem; margin: 0; opacity: 0.8;">Data Anda terlindungi dengan baik</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <strong>Tracking Real-time</strong>
                            <p style="font-size: 0.85rem; margin: 0; opacity: 0.8;">Pantau status surat Anda kapan saja</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="login-right">
                <div class="login-header">
                    <h3>Selamat Datang! 👋</h3>
                    <p>Silakan login untuk melanjutkan ke dashboard</p>
                </div>

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong>Login Gagal!</strong>
                    <p style="margin: 0.5rem 0 0 0; font-size: 0.9rem;">{{ $errors->first() }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="input-group">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right"></i> Login to Dashboard
                    </button>
                </form>

                <div class="demo-section">
                    <div class="demo-header">
                        <i class="bi bi-key-fill"></i>
                        Demo Accounts
                    </div>

                    <div class="demo-tabs">
                        <div class="demo-tab active" onclick="switchTab('admin')">
                            <i class="bi bi-shield-check"></i> Admin
                        </div>
                        <div class="demo-tab" onclick="switchTab('warga1')">
                            <i class="bi bi-person"></i> Warga 1
                        </div>
                        <div class="demo-tab" onclick="switchTab('warga2')">
                            <i class="bi bi-person"></i> Warga 2
                        </div>
                    </div>

                    <div id="admin-content" class="demo-content active">
                        <div class="credential-item">
                            <div class="credential-label">Email</div>
                            <div class="credential-field">
                                <span class="credential-text" id="adminEmail">admin@desa.com</span>
                                <button class="btn-copy" onclick="copyText('adminEmail', this)">
                                    <i class="bi bi-clipboard"></i> Copy
                                </button>
                            </div>
                        </div>
                        <div class="credential-item">
                            <div class="credential-label">Password</div>
                            <div class="credential-field">
                                <span class="credential-text" id="adminPass">admin123</span>
                                <button class="btn-copy" onclick="copyText('adminPass', this)">
                                    <i class="bi bi-clipboard"></i> Copy
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="warga1-content" class="demo-content">
                        <div class="credential-item">
                            <div class="credential-label">Email</div>
                            <div class="credential-field">
                                <span class="credential-text" id="warga1Email">budi@gmail.com</span>
                                <button class="btn-copy" onclick="copyText('warga1Email', this)">
                                    <i class="bi bi-clipboard"></i> Copy
                                </button>
                            </div>
                        </div>
                        <div class="credential-item">
                            <div class="credential-label">Password</div>
                            <div class="credential-field">
                                <span class="credential-text" id="warga1Pass">budi123</span>
                                <button class="btn-copy" onclick="copyText('warga1Pass', this)">
                                    <i class="bi bi-clipboard"></i> Copy
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="warga2-content" class="demo-content">
                        <div class="credential-item">
                            <div class="credential-label">Email</div>
                            <div class="credential-field">
                                <span class="credential-text" id="warga2Email">siti@gmail.com</span>
                                <button class="btn-copy" onclick="copyText('warga2Email', this)">
                                    <i class="bi bi-clipboard"></i> Copy
                                </button>
                            </div>
                        </div>
                        <div class="credential-item">
                            <div class="credential-label">Password</div>
                            <div class="credential-field">
                                <span class="credential-text" id="warga2Pass">siti123</span>
                                <button class="btn-copy" onclick="copyText('warga2Pass', this)">
                                    <i class="bi bi-clipboard"></i> Copy
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchTab(tab) {
            document.querySelectorAll('.demo-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.demo-content').forEach(c => c.classList.remove('active'));
            
            event.target.closest('.demo-tab').classList.add('active');
            document.getElementById(tab + '-content').classList.add('active');
        }

        function copyText(elementId, button) {
            const textElement = document.getElementById(elementId);
            const text = textElement.textContent;

            navigator.clipboard.writeText(text).then(() => {
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="bi bi-check2"></i> Copied!';
                button.classList.add('copied');

                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('copied');
                }, 2000);
            });
        }
    </script>
</body>
</html>