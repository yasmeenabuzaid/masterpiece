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
        overflow: hidden;
    }

    .containe {
        position: relative;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding-top: 20px;
    }

    .image-container {
        position: absolute;
        top: -20px;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.596);
    }

    .form-container {
        z-index: 1;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        width: 600px;
        border: 2px solid #000;
        margin-top: 20px;
    }

    .signup-form {
        display: flex;
        flex-direction: column;
    }

    .signup-form h2 {
        font-size: 36px;
        text-align: center;
        color: #333333;
        margin-bottom: 20px;
    }

    .welcome-message {
        font-size: 16px;
        color: #666666;
        text-align: center;
    }

    .signup-form label {
        margin-bottom: 8px;
        font-size: 16px;
        color: #333333;
    }

    .signup-form input {
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        width: 100%;
        margin-bottom: 20px;
        height: 45px;
    }

    .password-row {
        display: flex;
        justify-content: space-between;
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
        background-color: #007bff;
        color: white;
        border: none;
        padding: 14px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .btn-login:hover {
        background-color: #2b91fe;
    }

    .signup-form input::placeholder {
        color: #bbb;
        opacity: 1;
        font-style: normal;
    }
</style>

<div class="containe">
    <div class="image-container">
        <img src="https://images.pexels.com/photos/331989/pexels-photo-331989.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Background Image">
        <div class="image-overlay"></div>
    </div>
    <div class="form-container">
        <form method="POST" action="{{ route('register') }}" class="signup-form">
            @csrf

            <h2>{{ __('Register') }}</h2>
            <p class="welcome-message">Welcome to salonak ! Please register here.</p>

            <!-- ------------------------------------ Section Start: Name Field ------------------------------ -->
            <div class="row mb-3">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Insert your name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- ------------------------------------ Section End: Name Field ------------------------------ -->

            <!-- ------------------------------------ Section Start: Email Field ------------------------------ -->
            <div class="row mb-3">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Insert your email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- ------------------------------------ Section End: Email Field ------------------------------ -->

            <!-- ------------------------------------ Section Start: Password Fields ------------------------------ -->
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
            <!-- ------------------------------------ Section End: Password Fields ------------------------------ -->

            <!-- ------------------------------------ Section Start: Submit Button ------------------------------ -->
            <div class="row mb-0">
                <button type="submit" class="btn-login">
                    {{ __('Register') }}
                </button>
            </div>
            <!-- ------------------------------------ Section End: Submit Button ------------------------------ -->

        </form>
    </div>
</div>

@endsection
