{{-- File: resources/views/auth/forgot-password.blade.php --}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - Job Portal</title>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
<header>
    <h1 style="color:white"><a href="/" style="color:white;text-decoration: none;">Job Portal</a></h1>
    <nav>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </nav>
</header>

<main>
    <div class="form-container">
        <h1>Forgot Password</h1>
        <p class="description">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror

            <button type="submit">Email Password Reset Link</button>
        </form>
        <div class="alternate-action">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
</main>

<footer>
    <p>&copy; {{ date('Y') }} Job Portal. All rights reserved.</p>
</footer>
</body>
</html>
