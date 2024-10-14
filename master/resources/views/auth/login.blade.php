@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f4f4f4;
            overflow: hidden; /* منع التمرير */
        }

        .containe {
            position: relative; /* لجعل النموذج فوق الفيديو */
            height: 100vh; /* جعل ارتفاع الحاوية يملأ الشاشة */
            display: flex;
            justify-content: center; /* توسيط المحتوى أفقياً */
            align-items: center; /* توسيط المحتوى عمودياً */
        }

        .video-container {
            position: absolute; /* جعل الفيديو في الخلف */
            top: -50px; /* سحب الفيديو لأعلى */
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(27, 27, 27, 0.773); /* فلتر أسود خفيف */
        }

        .form-container {
            z-index: 1; /* جعل النموذج في المقدمة */
            padding: 40px;
            background-color: #6262627a;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 700px; /* عرض النموذج */
            margin-top: -100px; /* رفع النموذج للأعلى أكثر */
            border: #ffecec solid 2px;
        }

        .signup-form {
            display: flex;
            flex-direction: column;
        }

        .signup-form h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #ffffff;
            font-size: 46px;
            font-weight: bold;
        }

        .welcome-message {
            font-size: 18px;
            color: #ffffff;
            margin: 20px;
            text-align: center;
        }

        .signup-form label {
            margin-bottom: 5px;
            font-size: 12px;
            color: #fff1f1;
        }

        .signup-form input {
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #e74c3c;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
            transition: border 0.3s ease;
        }

        .signup-form input:focus {
            border: 1px solid #c0392b;
            outline: none;
        }

        input::placeholder {
            font-style: normal; /* اجعل النص مستقيمًا */
        }

        .btn-login {
            background-color: #1d1d1d; /* لون الزر الأسود */
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #333333; /* لون عند التحويم */
        }

        .signin {
            text-align: right;
            margin-top: 10px;
            color: #555;
        }

        .signin a {
            font-size: 14px;
            font-weight: bold;
            color: #e74c3c;
            text-decoration: none;
        }

        .signin a:hover {
            text-decoration: none;
            color: #ca541d;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="containe">
        <div class="video-container">
            <video autoplay muted loop>
                <source src="../salon_f.mp4" type="video/mp4">
            </video>
            <div class="video-overlay"></div> <!-- فلتر الفيديو -->
        </div>
        <div class="form-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h2 style="color: white;text-align:center ;font-size: 44px;">{{ __('Login') }}</h2>
                <p class="welcome-message">Welcome to Beauty Connect! Please login here.</p>

                <div class="row mb-3">
                    <label for="email" class="col-form-label" style="color: white">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-form-label" style="color: white">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember" style="color: white">{{ __('Remember Me') }}</label>
                    </div>
                </div>

                <div class="row mb-0">
                    <div style="margin-left: auto;">
                        <button type="submit" class="btn-login">{{ __('Login') }}</button>
                    </div>
                </div>

                <div class="signin">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</body>
</html>
@endsection
