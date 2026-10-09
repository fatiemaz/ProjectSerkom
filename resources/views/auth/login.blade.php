<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login - SMPN 1 Mangunreja</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            color: #fff;
            overflow-x: hidden;
        }

        /* ===== BACKGROUND FOTO + OVERLAY BIRU ===== */
        .bg {
            position: fixed;
            inset: 0;
            background: url("{{ asset('assets/img/sekolah.jpg') }}") center / cover no-repeat;
            transform: scale(1.05);
            animation: zoom 25s ease-in-out infinite alternate;
            z-index: -3;
        }
        .bg-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(6, 22, 68, 0.92) 0%, rgba(12, 44, 112, 0.82) 55%, rgba(8, 30, 84, 0.90) 100%);
            z-index: -2;
        }
        @keyframes zoom {
            from { transform: scale(1.05); }
            to   { transform: scale(1.15); }
        }

        /* ===== BULATAN DEKORASI MELAYANG ===== */
        .orb {
            position: fixed;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(74, 144, 255, 0.35), transparent 70%);
            z-index: -1;
            animation: float 9s ease-in-out infinite;
        }
        .orb.o1 { width: 340px; height: 340px; top: -90px; left: -90px; }
        .orb.o2 { width: 420px; height: 420px; bottom: -140px; right: 8%; animation-delay: -4s; }
        .orb.o3 { width: 200px; height: 200px; top: 55%; left: 38%; animation-delay: -2s; opacity: .6; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-28px); }
        }

        /* ===== LAYOUT ===== */
        .wrapper {
            min-height: 100vh;
            max-width: 1180px;
            margin: 0 auto;
            padding: 32px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 48px;
        }

        /* ===== SISI KIRI: SAMBUTAN ===== */
        .welcome {
            flex: 1;
            animation: slideLeft .9s ease both;
        }
        .welcome .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 44px;
        }
        .welcome .brand img {
            width: 58px;
            height: 58px;
            object-fit: contain;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, .35));
        }
        .welcome .brand span {
            font-weight: 600;
            font-size: 17px;
            letter-spacing: .5px;
        }
        .welcome h1 {
            font-size: 54px;
            font-weight: 700;
            line-height: 1.15;
        }
        .welcome h1 small {
            display: block;
            font-size: 22px;
            font-weight: 400;
            color: #9ec3ff;
            margin-bottom: 8px;
        }
        .welcome .line {
            width: 70px;
            height: 4px;
            border-radius: 4px;
            background: linear-gradient(90deg, #4a90ff, #9ec3ff);
            margin: 26px 0;
        }
        .welcome p {
            max-width: 430px;
            color: rgba(255, 255, 255, .78);
            font-size: 14.5px;
            line-height: 1.8;
        }

        /* ===== KARTU FORM TRANSPARAN ===== */
        .card {
            width: 100%;
            max-width: 400px;
            padding: 38px 34px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(16px) saturate(140%);
            -webkit-backdrop-filter: blur(16px) saturate(140%);
            box-shadow: 0 25px 60px rgba(0, 10, 40, .55);
            animation: slideRight .9s ease both;
        }
        .card h2 {
            text-align: center;
            font-size: 30px;
            font-weight: 600;
        }
        .card .sub {
            text-align: center;
            color: rgba(255, 255, 255, .7);
            font-size: 13.5px;
            margin: 6px 0 28px;
        }

        /* ===== ALERT ===== */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 18px;
            animation: shake .4s ease;
        }
        .alert.error   { background: rgba(255, 82, 82, .22); border: 1px solid rgba(255, 120, 120, .5); }
        .alert.success { background: rgba(40, 199, 111, .22); border: 1px solid rgba(90, 220, 150, .5); animation: none; }

        /* ===== INPUT ===== */
        .field { margin-bottom: 20px; }
        .field label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, .9);
        }
        .input-wrap { position: relative; }
        .input-wrap .ico {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 17px;
            color: rgba(255, 255, 255, .65);
            transition: color .25s;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: 13px 46px 13px 46px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .25);
            background: rgba(255, 255, 255, .10);
            color: #fff;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: all .25s;
        }
        .input-wrap input::placeholder { color: rgba(255, 255, 255, .5); }
        .input-wrap input:focus {
            border-color: #6aa8ff;
            background: rgba(255, 255, 255, .16);
            box-shadow: 0 0 0 4px rgba(74, 144, 255, .25);
        }
        .input-wrap input:focus ~ .ico,
        .input-wrap:focus-within .ico { color: #9ec3ff; }
        .input-wrap.invalid input { border-color: #ff7b7b; }

        /* Perbaiki warna autofill browser */
        .input-wrap input:-webkit-autofill {
            -webkit-text-fill-color: #fff;
            transition: background-color 9999s ease-in-out 0s;
        }

        /* Sembunyikan tombol mata bawaan Edge/IE */
        .input-wrap input::-ms-reveal,
        .input-wrap input::-ms-clear {
            display: none;
        }

        .toggle-pass {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border: 0;
            background: transparent;
            color: rgba(255, 255, 255, .65);
            font-size: 17px;
            cursor: pointer;
            border-radius: 50%;
            transition: all .2s;
        }
        .toggle-pass:hover { color: #fff; background: rgba(255, 255, 255, .12); }

        /* ===== TOMBOL ===== */
        .btn-login {
            width: 100%;
            margin-top: 8px;
            padding: 14px;
            border: 0;
            border-radius: 12px;
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .5px;
            color: #fff;
            cursor: pointer;
            background: linear-gradient(135deg, #2f6df6, #1a3fae);
            box-shadow: 0 10px 25px rgba(30, 80, 220, .45);
            transition: transform .2s, box-shadow .2s, filter .2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            filter: brightness(1.12);
            box-shadow: 0 14px 32px rgba(30, 80, 220, .6);
        }
        .btn-login:active { transform: translateY(0); }
        .btn-login:disabled { opacity: .75; cursor: not-allowed; transform: none; }
        .btn-login .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
            margin-right: 8px;
            vertical-align: -3px;
        }
        .btn-login.loading .spinner { display: inline-block; }

        .footer-note {
            text-align: center;
            margin-top: 22px;
            font-size: 12px;
            color: rgba(255, 255, 255, .55);
        }

        /* ===== ANIMASI ===== */
        @keyframes slideLeft  { from { opacity: 0; transform: translateX(-40px); } to { opacity: 1; transform: none; } }
        @keyframes slideRight { from { opacity: 0; transform: translateX(40px); }  to { opacity: 1; transform: none; } }
        @keyframes spin  { to { transform: rotate(360deg); } }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }

        /* ===== RESPONSIF ===== */
        @media (max-width: 900px) {
            .wrapper { justify-content: center; }
            .welcome { display: none; }
        }
        @media (max-width: 420px) {
            .card { padding: 30px 22px; }
        }
    </style>
</head>

<body>

    <div class="bg"></div>
    <div class="bg-overlay"></div>
    <div class="orb o1"></div>
    <div class="orb o2"></div>
    <div class="orb o3"></div>

    <div class="wrapper">

        {{-- SISI KIRI --}}
        <div class="welcome">
            <div class="brand">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                <span>SMPN 1 MANGUNREJA</span>
            </div>

            <h1>
                <small>Halaman Administrator</small>
                Selamat Datang!
            </h1>

            <div class="line"></div>

            <p>
                Kelola profil sekolah, data guru, siswa, prestasi, berita, dan
                galeri dalam satu tempat. Silakan masuk untuk melanjutkan.
            </p>
        </div>

        {{-- FORM LOGIN --}}
        <div class="card">
 
            <h2>LOGIN</h2>
            <div class="sub">Masuk dengan akun admin atau operator</div>

            @if ($errors->any())
                <div class="alert error">
                    <i class="feather icon-alert-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert success">
                    <i class="feather icon-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" id="formLogin">
                @csrf

                <div class="field">
                    <label for="username">Username</label>
                    <div class="input-wrap {{ $errors->has('username') ? 'invalid' : '' }}">
                        <i class="feather icon-user ico"></i>
                        <input type="text" id="username" name="username"
                               value="{{ old('username') }}" placeholder="Masukkan username"
                               maxlength="30" autocomplete="username" autofocus required>
                    </div>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="feather icon-lock ico"></i>
                        <input type="password" id="password" name="password"
                               placeholder="Masukkan password" autocomplete="current-password" required>
                        <button type="button" class="toggle-pass" id="togglePass" title="Lihat password">
                            <i class="feather icon-eye" id="iconEye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="btnLogin">
                    <span class="spinner"></span>
                    <span id="btnText">Login</span>
                </button>
            </form>

            <div class="footer-note">&copy; {{ date('Y') }} SMPN 1 Mangunreja</div>

        </div>

    </div>

    <script>
        // Tampilkan / sembunyikan password
        const passInput = document.getElementById('password');
        const iconEye   = document.getElementById('iconEye');

        document.getElementById('togglePass').addEventListener('click', function () {
            const show = passInput.type === 'password';
            passInput.type = show ? 'text' : 'password';
            iconEye.className = show ? 'feather icon-eye-off' : 'feather icon-eye';
        });

        // Efek loading saat submit
        document.getElementById('formLogin').addEventListener('submit', function () {
            const btn = document.getElementById('btnLogin');
            btn.classList.add('loading');
            btn.disabled = true;
            document.getElementById('btnText').textContent = 'MEMPROSES...';
        });
    </script>

</body>

</html>
