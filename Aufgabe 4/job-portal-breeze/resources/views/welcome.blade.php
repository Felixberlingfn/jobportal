{{-- File: resources/views/auth/welcome.blade.php --}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Portal</title>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
    </style>
</head>
<body>
@if (Auth::check())
    <script>
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif
<header>
    <h1 style="color:white">Job Portal</h1>
    <nav>
        <a href="/login">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </nav>
</header>

<main>
    <section>
        <h2>Find Your Dream Job</h2>
        <p>Explore thousands of job opportunities with all the information you need. It's your future.</p>
        <a href="/find-jobs" class="cta-button">Browse Jobs</a>
    </section>

    <section>
        <h2>For Employers</h2>
        <p>Find the best candidates for your company. Post your job openings and start receiving applications.</p>
        <a href="/post-jobs/create" class="cta-button">Post a Job</a>
    </section>
</main>

<footer>
    <p>&copy; 2024 Job Portal. All rights reserved.</p>
</footer>
</body>
</html>
