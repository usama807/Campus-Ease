@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container-fluid">
        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')

        @include('profile.partials.delete-user-form')
    </div>
@endsection
