{{-- File: resources/views/auth/register.blade.php --}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Job Portal</title>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
    </style>
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
    <div class="register-form">
        <h1>Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
            <p style="color: red; margin-top: -0.5rem; margin-bottom: 0.5rem;">{{ $message }}</p>
            @enderror

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
            <p style="color: red; margin-top: -0.5rem; margin-bottom: 0.5rem;">{{ $message }}</p>
            @enderror

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
            @error('password')
            <p style="color: red; margin-top: -0.5rem; margin-bottom: 0.5rem;">{{ $message }}</p>
            @enderror

            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">

            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</main>

<footer>
    <p>&copy; 2024 Job Portal. All rights reserved.</p>
</footer>
</body>
</html>
