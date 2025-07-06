<!DOCTYPE html>
@php
    $locale = App::getLocale();
    $direction = $locale === 'ar' ? 'rtl' : 'ltr';
    $localePrefix = $locale === 'ar' ? '' : 'ltr_';
    $languages = [
        'en' => 'English',
        'ar' => 'العربية',
        'fr' => 'Français',
    ];
@endphp

<html lang="{{ $locale }}" dir="{{ $direction }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">

    <title>الوكالة المصرية للشراكة من أجل التنمية</title>

    <link rel="icon" type="image/png" href="{{ asset($localePrefix . 'assets/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Cairo', sans-serif;
        }

        .login-row {
            height: 100vh;
        }

        .login-left {
            background: rgba(0, 0, 0, 0.55);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            z-index: 2;
        }

        .login-logo {
            max-width: 180px;
            margin-bottom: 1.5rem;
        }

        .agency-title {
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .agency-subtitle {
            font-size: 1.1rem;
            font-weight: 400;
            margin-bottom: 2.5rem;
        }

        .login-form {
            width: 100%;
            max-width: 340px;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group .fa {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1.1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 0.75rem 0.75rem 2.5rem;
            border: none;
            border-bottom: 2px solid #fff;
            border-radius: 0;
            background: transparent;
            color: #fff;
            font-size: 1rem;
        }

        .form-control:focus {
            border: none;
            border-color: transparent;
            outline: none;
            background: transparent;
        }

        .form-control::placeholder {
            color: #ffffff;
            opacity: 1;
        }

        .btn-login {
            width: 100%;
            background: #2660A4;
            color: #fff;
            border: none;
            border-radius: 28px;
            padding: 0.75rem;
            font-size: 1.1rem;
            font-weight: 700;
            margin-top: 0.5rem;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .login-right {
            background: url('{{ asset('assets/img/login-img.png') }}') center center no-repeat;
            background-size: cover;
            min-height: 100vh;
        }

        @media (max-width: 767.98px) {
            .login-row {
                flex-direction: column;
            }

            .login-left,
            .login-right {
                min-height: 50vh;
                width: 100%;
            }

            .login-left {
                padding: 2rem 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid h-100 login-right">
        <div class="row login-row">
            <!-- Left: Overlay with logo, agency name, and login form -->
            <div class="col-md-5 login-left">
                <img src="{{ asset($localePrefix . 'assets/img/login-logo.png') }}" alt="Logo" class="login-logo">
                {{-- <div class="agency-title">EAPD</div>
                <div class="agency-subtitle">EGYPTIAN AGENCY<br>OF PARTNERSHIP FOR DEVELOPMENT</div> --}}
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="User Name">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-login">LOG IN</button>
                </form>
            </div>
            <!-- Right: Background image -->
            <div class="col-md-7 d-none d-md-block"></div>
        </div>
    </div>
</body>

</html>
