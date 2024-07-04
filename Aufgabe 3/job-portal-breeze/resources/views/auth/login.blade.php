{{-- File: resources/views/auth/login.blade.php --}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Job Portal</title>
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
    <div class="login-form">
        <h1>Login</h1>
        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror

            <div class="remember-me">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
            </div>

            <button type="submit">Log in</button>

            <div class="forgot-password">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif
            </div>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>
</main>

<footer>
    <p>&copy; {{ date('Y') }} Job Portal. All rights reserved.</p>
</footer>
</body>
</html>
