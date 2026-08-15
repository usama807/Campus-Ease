@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <p class="login-box-msg">Register a new membership</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group mb-1">
            <div class="form-floating">
                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Full Name" required autofocus autocomplete="name">
                <label for="name">Full Name</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-person"></span>
            </div>
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-1">
            <div class="form-floating">
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="username">
                <label for="email">Email</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-envelope"></span>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-1">
            <div class="form-floating">
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" required autocomplete="new-password">
                <label for="password">Password</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-1">
            <div class="form-floating">
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                    placeholder="Confirm Password" required autocomplete="new-password">
                <label for="password_confirmation">Confirm Password</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
            </div>
        </div>

        <div class="d-grid gap-2 mt-2">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>

    <p class="mb-0 mt-3">
        <a href="{{ route('login') }}" class="link-primary text-center">I already have a membership</a>
    </p>
@endsection
