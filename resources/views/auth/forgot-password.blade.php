<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Dor Sahara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<div class="container" id="container">
    <div class="form-container">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <h1>Forgot Your Password?</h1>

            <p class="text-gray-600 dark:text-gray-400" style="margin-bottom: 20px;">
                No problem. Just enter your email address and we will send you a link to reset your password.
            </p>

            @if (session('status'))
                <div class="alert alert-success mb-4 text-green-500">
                    {{ session('status') }}
                </div>
            @endif

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn">Send Password Reset Link</button>
        </form>
    </div>
</div>

<script src="{{ asset('script.js') }}"></script>
</body>
</html>
