<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Login (Bootstrap)</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <style>
        /* Optional: Custom styles to center the form */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa; /* Light grey background */
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Soft shadow */
            border-radius: 0.5rem; /* Rounded corners */
        }
    </style>
</head>
<body>

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4 text-center">{{ __('Log in to your account') }}</h2>
            <p class="text-center text-muted">{{ __('Enter your email and password below to log in') }}</p>

            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email address') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           required autofocus autocomplete="email" placeholder="email@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required autocomplete="current-password" placeholder="{{ __('Password') }}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if (Route::has('password.request'))
                        <div class="mt-2 text-end">
                            <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                        </div>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
                </div>
            </form>

            @if (Route::has('register'))
                <div class="text-center mt-3">
                    <p class="mb-0">{{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}">{{ __('Sign up') }}</a>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
