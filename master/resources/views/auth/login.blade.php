@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        /* إعدادات أساسية للنمط العام */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f4f4f4;
            margin: 0; /* إزالة الهامش من الجسم */
            padding: 0; /* إزالة الحشو من الجسم */
            overflow: hidden; /* منع التمرير */
        }

        .containe {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0; /* تأكد من عدم وجود هامش */
        }

        .image-container {
            position: absolute;
            top: -30px; /* رفع الصورة للأعلى بمقدار 30 بكسل */
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* تغطي الصورة المساحة بالكامل */
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(27, 27, 27, 0.773); /* فلتر أسود خفيف */
        }

        /* تنسيق النموذج */
        .form-container {
            z-index: 1;
            padding: 30px; /* تقليص الحشوة */
            background-color: #ffffff; /* تغيير لون الخلفية إلى الأبيض */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 2px solid #000; /* تغيير الحدود إلى خط مستقيم */
            width: 600px; /* تصغير عرض النموذج */
            position: relative;
            top: -30px; /* رفع الفورم قليلاً */
        }

        .signup-form {
            display: flex;
            flex-direction: column;
        }

        .signup-form h2 {
        font-size: 36px; /* تقليل حجم الخط */
        text-align: center;
        color: #333333;
        margin-bottom: 20px; /* زيادة المسافة السفلية */
    }


        .welcome-message {
            font-size: 14px; /* تصغير حجم الرسالة الترحيبية */
            color: #666666;
            margin: 15px 0;
            text-align: center;
        }

        .signup-form label {
            margin-bottom: 5px;
            font-size: 14px; /* تصغير حجم الخط */
            color: #333333;
        }

        .signup-form input {
            margin-bottom: 12px; /* تقليص المسافة بين الحقول */
            padding: 10px; /* تقليص الحشوة داخل الحقول */
            border: 1px solid #e74c3c;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
            transition: border 0.3s ease;
        }

        /* تغيير لون الحقول عند التفاعل */
        .signup-form input:focus {
            border: 1px solid #3498db; /* تغيير اللون عند الفوكس */
            outline: none;
            background-color: #f0f8ff; /* تغيير لون الخلفية عند التفاعل */
        }

        .btn-login {
            background-color: #1d1d1d;
            color: white;
            border: none;
            padding: 10px; /* تقليص الحشوة داخل الزر */
            font-size: 14px; /* تصغير حجم الخط داخل الزر */
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #333333;
        }

        .signin {
            text-align: right;
            margin-top: 10px;
            color: #555;
        }

        .signin a {
            font-size: 12px; /* تصغير حجم رابط "نسيت كلمة المرور" */
            font-weight: bold;
            color: #e74c3c;
            text-decoration: none;
        }

        .signin a:hover {
            text-decoration: none;
            color: #ca541d;
            font-weight: bold;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 10px; /* تقليص المسافة بين الزر والحقول الأخرى */
        }

        .form-check-input {
            margin-right: 10px; /* زيادة المسافة بين الزر والتسمية */
            width: 16px;
            height: 16px;
        }

        .form-check-label {
            font-size: 14px;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="containe">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="image-container">
            <img src="salon-landing.png" alt="Background Image"> <!-- استبدل بالمسار الصحيح للصورة -->
            <div class="image-overlay"></div> <!-- فلتر الصورة -->
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('login') }}" class="signup-form">
                @csrf

                <h2>{{ __('Login') }}</h2>
                <p class="welcome-message">Welcome to salonak ! Please login here.</p>

                <div class="row mb-3">
                    <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
