<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Cravecourt</title>
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

        .split-wrapper { display: flex; width: 100%; min-height: 100vh; }

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
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 24px;
        }

        .brand-name { font-size: 26px; font-weight: 800; margin-bottom: 14px; }

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

        .brand-points li::before { content: '•'; margin-right: 8px; }

        .form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        .form-card {
            width: 100%;
            max-width: 400px;
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

        .divider { height: 1px; background: var(--line); margin-bottom: 22px; }
        .field { margin-bottom: 18px; }

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

        .status-msg {
            background: #e9f6ea;
            color: #2f7a3a;
            font-size: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 18px;
            text-align: center;
        }

        .field-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: -6px;
            margin-bottom: 22px;
            font-size: 11.5px;
        }

        .remember-me { display: flex; align-items: center; gap: 6px; }
        .remember-me input { accent-color: var(--maroon); }

        .forgot-link {
            color: var(--maroon);
            font-weight: 600;
            text-decoration: none;
        }

        .btn-signin {
            width: 100%;
            margin-top: 8px;
            background: var(--maroon);
            color: #f3e6c8;
            border: none;
            border-radius: 999px;
            padding: 14px 0;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
        }

        .btn-signin:hover { background: var(--maroon-dark); }
        .btn-signin svg { width: 16px; height: 16px; }

        .register-hint { text-align: center; font-size: 12px; margin-top: 18px; }
        .register-hint a { color: var(--maroon); font-weight: 700; text-decoration: none; }
        .register-hint a:hover { text-decoration: underline; }

        @media (max-width: 820px) {
            .split-wrapper { flex-direction: column; }
            .brand-panel { flex: none; min-height: 270px; padding: 36px 28px; }
            .brand-logo { width: 52px; height: 52px; margin-bottom: 16px; }
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
        }
    </style>
</head>
<body>
    @php
        $isUserKita = ($loginRoute ?? 'login.store') === 'userkita.login.store';
        $fieldName = $loginField ?? 'email';
        $fieldLabel = $loginLabel ?? ($isUserKita ? 'Username' : 'Email');
        $fieldType = $isUserKita ? 'text' : 'email';
        $fieldPlaceholder = $loginPlaceholder ?? ($isUserKita ? 'Masukkan username' : 'Masukkan email');
    @endphp

    <div class="split-wrapper">
        <section class="brand-panel" aria-label="Tentang Cravecourt">
            <div class="brand-logo">
                <img src="{{ asset('assets/images/LOGO CRAVECOURT.png') }}" alt="Logo" style="width: 45px; height: 45px;">
            </div>
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
                <h1>Masuk</h1>
                <div class="divider"></div>

                @if (session('status'))
                    <div class="status-msg">{{ session('status') }}</div>
                @endif

                <form action="{{ route($loginRoute ?? 'login.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label for="{{ $fieldName }}">{{ $fieldLabel }}</label>
                        <input type="{{ $fieldType }}" id="{{ $fieldName }}" name="{{ $fieldName }}" value="{{ old($fieldName) }}" placeholder="{{ $fieldPlaceholder }}" required autofocus autocomplete="username">
                        @error($fieldName) <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required autocomplete="current-password">
                        @error('password') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="field-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember"> Ingat saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-signin">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                        Sign In
                    </button>
                </form>

                <p class="register-hint">
                    Belum punya akun?
                    <a href="{{ route($registerRoute ?? 'register') }}">Daftar</a>
                </p>
            </div>
        </main>
    </div>
</body>
</html>