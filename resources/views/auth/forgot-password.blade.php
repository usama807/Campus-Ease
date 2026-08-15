@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
    <p class="login-box-msg">
        Forgot your password? No problem. Just let us know your email address and we will email you a
        password reset link that will allow you to choose a new one.
    </p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="input-group mb-1">
            <div class="form-floating">
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                <label for="email">Email</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-envelope"></span>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2 mt-2">
            <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
        </div>
    </form>

    <p class="mb-0 mt-3">
        <a href="{{ route('login') }}" class="link-primary text-center">Back to login</a>
    </p>
@endsection
