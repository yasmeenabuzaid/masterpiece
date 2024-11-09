@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        overflow: hidden; /* منع التمرير */
    }

    .containe {
        position: relative; /* لجعل النموذج فوق الصورة */
        height: 100vh; /* جعل ارتفاع الحاوية يملأ الشاشة */
        display: flex;
        justify-content: center; /* توسيط المحتوى أفقياً */
        align-items: flex-start; /* محاذاة المحتوى لأعلى */
        padding-top: 50px; /* إضافة مسافة من الأعلى */
    }

    .image-container {
        position: absolute; /* جعل الصورة في الخلف */
        top: -20px; /* رفع الصورة لأعلى */
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
        background-color: rgba(0, 0, 0, 0.596); /* فلتر أسود خفيف */
    }

    .form-container {
        z-index: 1; /* جعل النموذج في المقدمة */
        padding: 40px; /* تقليص الحشو */
        background-color: #ffffff; /* تغيير لون الخلفية إلى الأبيض */
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        width: 600px; /* تصغير عرض النموذج */
        border: 2px solid #000; /* تغيير الحدود إلى خط مستقيم */
        margin-top: 20px; /* رفع النموذج عن الحافة */
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
        font-size: 16px;
        color: #666666;
        text-align: center;
    }

    .signup-form label {
        margin-bottom: 8px; /* زيادة المسافة بين الحقل والعنوان */
        font-size: 16px; /* زيادة حجم الخط */
        color: #333333;
    }

    .signup-form input {
        padding: 12px; /* زيادة الحشو */
        border: 2px solid #ccc; /* سمك الحدود */
        border-radius: 8px; /* زيادة الانحناء */
        font-size: 16px; /* زيادة حجم الخط داخل الحقول */
        width: 100%;
        margin-bottom: 20px; /* زيادة المسافة بين الحقول */
        height: 45px; /* زيادة الارتفاع */
    }

    .password-row {
        display: flex;
        justify-content: space-between; /* توزيع المساحة بين الحقول */
    }

    .signin {
        text-align: right;
        margin-top: 15px;
        color: #555;
    }

    .signin a {
        font-size: 16px;
        color: #e74c3c;
        text-decoration: none;
    }

    .signin a:hover {
        text-decoration: underline;
    }

    .btn-login {
        background-color: #1d1d1d; /* لون الزر الأسود */
        color: white;
        border: none;
        padding: 14px;
        font-size: 18px; /* زيادة حجم الخط في الزر */
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .btn-login:hover {
        background-color: #333333; /* لون عند التحويم */
    }

    .signup-form input::placeholder {
        color: #bbb; /* لون النص في placeholder */
        opacity: 1; /* تأكد من وضوح النص */
        font-style: normal; /* اجعل النص مستقيمًا */
    }
</style>

<div class="containe">
    <div class="image-container">
        <img src="salon-landing.png" alt="Background Image"> <!-- استبدل بالمسار الصحيح للصورة -->
        <div class="image-overlay"></div> <!-- فلتر الصورة -->
    </div>
    <div class="form-container">
        <form method="POST" action="{{ route('register') }}" class="signup-form">
            @csrf

            <h2>{{ __('Register') }}</h2>
            <p class="welcome-message">Welcome to salonak ! Please register here.</p>

            <div class="row mb-3">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Insert your name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Insert your email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="password-row mb-3">
                <div style="flex: 1; margin-right: 10px;">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Insert your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div style="flex: 1;">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                </div>
            </div>

            <div class="row mb-0">
                <button type="submit" class="btn-login">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
