<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Cravecourt</title>
    <style>
        :root {
            --maroon: #8c2b2b;
            --maroon-dark: #6e1f1f;
            --cream: #fdf6f1;
            --text-dark: #2b2020;
            --input-bg: #cf7d7d;
            --input-bg-dark: #c46f6f;
            --line: #e6dede;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .split-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .brand-panel {
            flex: 0 0 42%;
            background: linear-gradient(160deg, #f0b3ae 0%, #c8615a 55%, #a83f3f 100%);
            padding: 48px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        }

        .brand-logo {
            width: 62px;
            height: 62px;
            border-radius: 16px;
            background: #1c1414;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 24px;
        }

        .brand-name {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .brand-tagline {
            font-size: 14px;
            line-height: 1.6;
            max-width: 320px;
            margin-bottom: 22px;
            opacity: .95;
        }

        .brand-points {
            list-style: none;
            font-size: 11.5px;
            line-height: 1.9;
            opacity: .9;
        }

        .brand-points li::before {
            content: '•';
            margin-right: 8px;
        }

        .form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        .form-card {
            width: 100%;
            max-width: 440px;
            background: #fff;
            border-radius: 22px;
            padding: 34px 38px 38px;
            box-shadow: 0 20px 40px rgba(140, 43, 43, .12);
        }

        .form-card h1 {
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .divider {
            height: 1px;
            background: var(--line);
            margin-bottom: 22px;
        }

        .field { margin-bottom: 16px; }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .field input {
            width: 100%;
            border: none;
            outline: none;
            border-radius: 10px;
            padding: 15px 16px;
            background: var(--input-bg);
            color: #fff;
            font: inherit;
            font-size: 13px;
        }

        .field input::placeholder { color: rgba(255, 255, 255, .75); }
        .field input:focus { background: var(--input-bg-dark); }

        .error-text {
            display: block;
            color: var(--maroon-dark);
            font-size: 11px;
            margin-top: 6px;
        }

        .password-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-signup {
            width: 100%;
            margin-top: 8px;
            padding: 14px 0;
            border: none;
            border-radius: 999px;
            background: var(--maroon);
            color: #f3e6c8;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-signup:hover { background: var(--maroon-dark); }
        .btn-signup svg { width: 16px; height: 16px; }

        .login-hint {
            text-align: center;
            font-size: 12px;
            margin-top: 18px;
        }

        .login-hint a {
            color: var(--maroon);
            font-weight: 700;
            text-decoration: none;
        }

        .login-hint a:hover { text-decoration: underline; }

        @media (max-width: 820px) {
            .split-wrapper { flex-direction: column; }

            .brand-panel {
                flex: none;
                min-height: 270px;
                padding: 36px 28px;
            }

            .brand-logo {
                width: 52px;
                height: 52px;
                margin-bottom: 16px;
            }

            .brand-name { font-size: 24px; }
            .brand-tagline { margin-bottom: 14px; }
            .form-panel { padding: 32px 20px 48px; }
        }

        @media (max-width: 480px) {
            .brand-panel { min-height: 240px; padding: 28px 22px; }
            .brand-points { display: none; }
            .form-panel { padding: 24px 14px 36px; }
            .form-card { padding: 28px 20px 30px; border-radius: 18px; }
            .form-card h1 { font-size: 24px; }
            .password-fields { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
</head>
<body>
    <div class="split-wrapper">
        <section class="brand-panel" aria-label="Tentang Cravecourt">
            <div class="brand-logo">🌺</div>
            <div class="brand-name">Cravecourt</div>
            <p class="brand-tagline">
                Sistem koperasi sekolah modern. Pesan online, bayar mudah, ambil tanpa antre.
            </p>
            <ul class="brand-points">
                <li>Pemesanan online untuk siswa</li>
                <li>Struk digital tersimpan otomatis</li>
            </ul>
        </section>

        <main class="form-panel">
            <div class="form-card">
                <h1>Daftar</h1>
                <div class="divider"></div>

                <form action="{{ route($registerRoute ?? 'register.store') }}" method="POST">
                    @csrf

                    <div class="field">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus autocomplete="name">
                        @error('name') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required autocomplete="username">
                        @error('username') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label for="email">Gmail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@gmail.com" required autocomplete="email">
                        @error('email') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="password-fields">
                        <div class="field">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan password" required autocomplete="new-password">
                            @error('password') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="field">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required autocomplete="new-password">
                            @error('password_confirmation') <span class="error-text">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-signup">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                        Sign Up
                    </button>
                </form>

                <p class="login-hint">
                    Sudah punya akun? <a href="{{ route($loginRoute ?? 'login') }}">Masuk</a>
                </p>
            </div>
        </main>
    </div>
</body>
</html>
