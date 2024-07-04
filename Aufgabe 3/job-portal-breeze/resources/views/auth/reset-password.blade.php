{{-- File: resources/views/auth/reset-password.blade.php --}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Job Portal</title>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
<header>
    <h1 style="color:white">Job Portal</h1>
    <nav>
        <a href="/">Home</a>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </nav>
</header>

<main>
    <div class="form-container">
        <h1>Reset Password</h1>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror

            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
            <p class="error-message">{{ $message }}</p>
            @enderror

            <button type="submit">Reset Password</button>
        </form>
    </div>
</main>

<footer>
    <p>&copy; {{ date('Y') }} Job Portal. All rights reserved.</p>
</footer>
</body>
</html>
