@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <p class="login-box-msg">Sign in to report or search for lost &amp; found items</p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-1">
            <div class="form-floating">
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="name@example.com" required autofocus autocomplete="username">
                <label for="email">Email</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-envelope"></span>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" required autocomplete="current-password">
                <label for="password">Password</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!--begin::Row-->
        <div class="row">
            <div class="col-7 d-inline-flex align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-5">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Sign In
                    </button>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!--end::Row-->
    </form>

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('password.request') }}">Forgot password?</a>
        <a href="{{ route('register') }}">Create an account</a>
    </div>
@endsection
