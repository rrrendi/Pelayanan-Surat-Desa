<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Surat Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2d5016;
            --primary-light: #3d6b1f;
            --accent: #d4af37;
            --light: #f5f5f0;
        }

        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            padding: 15px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
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

        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 3rem 2rem 2.5rem;
            text-align: center;
            color: white;
            position: relative;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 30px;
            background: white;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            background: var(--accent);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
        }

        .logo-container i {
            font-size: 3rem;
            color: white;
        }

        .login-header h3 {
            font-weight: 700;
            margin: 0 0 0.5rem;
            font-size: 1.8rem;
        }

        .login-header p {
            margin: 0;
            opacity: 0.95;
            font-size: 0.95rem;
        }

        .login-body {
            padding: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e8e5dc;
            padding: 0.8rem 1rem 0.8rem 3rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(45, 80, 22, 0.15);
            background: white;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            z-index: 10;
            font-size: 1.2rem;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border: none;
            border-radius: 10px;
            padding: 0.9rem;
            font-weight: 700;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(45, 80, 22, 0.3);
        }

        .demo-accounts {
            background: linear-gradient(to bottom right, #faf8f3, #f5f5f0);
            border: 2px solid #e8e5dc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .demo-accounts h6 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .demo-item {
            background: white;
            border: 1px solid #e8e5dc;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.8rem;
            transition: all 0.3s ease;
        }

        .demo-item:last-child {
            margin-bottom: 0;
        }

        .demo-item:hover {
            border-color: var(--accent);
            box-shadow: 0 2px 8px rgba(212, 175, 55, 0.2);
        }

        .demo-item strong {
            color: var(--primary);
            display: block;
            margin-bottom: 0.6rem;
            font-size: 0.9rem;
        }

        .copy-field {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0.4rem;
        }

        .copy-field:last-child {
            margin-bottom: 0;
        }

        .copy-text {
            flex: 1;
            background: #fafafa;
            border: 1px solid #e8e5dc;
            border-radius: 6px;
            padding: 0.5rem 0.7rem;
            font-size: 0.85rem;
            font-family: 'Courier New', monospace;
            color: #2c2416;
            user-select: all;
            cursor: text;
        }

        .copy-text:hover {
            background: white;
            border-color: var(--accent);
        }

        .btn-copy {
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 0.9rem;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-weight: 600;
        }

        .btn-copy:hover {
            background: #c29d2f;
            transform: scale(1.05);
        }

        .btn-copy:active {
            transform: scale(0.95);
        }

        .btn-copy.copied {
            background: #4a7c2c;
        }

        @media (max-width: 576px) {
            .login-header {
                padding: 2rem 1.5rem;
            }

            .logo-container {
                width: 70px;
                height: 70px;
            }

            .logo-container i {
                font-size: 2.5rem;
            }

            .login-header h3 {
                font-size: 1.5rem;
            }

            .login-body {
                padding: 1.5rem;
            }

            .copy-text {
                font-size: 0.8rem;
            }

            .btn-copy {
                font-size: 0.7rem;
                padding: 0.4rem 0.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <i class="bi bi-building"></i>
                </div>
                <h3>Sistem Surat Desa</h3>
                <p>Pelayanan Administrasi Desa Digital</p>
            </div>
            
            <div class="login-body">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong>Login Gagal!</strong>
                    <p class="mb-0 mt-1">{{ $errors->first() }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="input-group">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
                    </button>
                </form>

                <div class="demo-accounts">
                    <h6>
                        <i class="bi bi-key-fill"></i>
                        Akun Demo untuk Testing
                    </h6>
                    
                    <div class="demo-item">
                        <strong><i class="bi bi-shield-check"></i> Administrator</strong>
                        <div class="copy-field">
                            <span class="copy-text" id="adminEmail">admin@desa.com</span>
                            <button class="btn-copy" onclick="copyText('adminEmail', this)">
                                <i class="bi bi-clipboard"></i> Copy
                            </button>
                        </div>
                        <div class="copy-field">
                            <span class="copy-text" id="adminPass">admin123</span>
                            <button class="btn-copy" onclick="copyText('adminPass', this)">
                                <i class="bi bi-clipboard"></i> Copy
                            </button>
                        </div>
                    </div>

                    <div class="demo-item">
                        <strong><i class="bi bi-person-fill"></i> Warga Desa</strong>
                        <div class="copy-field">
                            <span class="copy-text" id="wargaEmail">budi@gmail.com</span>
                            <button class="btn-copy" onclick="copyText('wargaEmail', this)">
                                <i class="bi bi-clipboard"></i> Copy
                            </button>
                        </div>
                        <div class="copy-field">
                            <span class="copy-text" id="wargaPass">budi123</span>
                            <button class="btn-copy" onclick="copyText('wargaPass', this)">
                                <i class="bi bi-clipboard"></i> Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
            }).catch(err => {
                console.error('Failed to copy: ', err);
                alert('Gagal menyalin text');
            });
        }

        document.querySelectorAll('.copy-text').forEach(element => {
            element.addEventListener('click', function() {
                const range = document.createRange();
                range.selectNodeContents(this);
                const selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);
            });
        });
    </script>
</body>
</html>