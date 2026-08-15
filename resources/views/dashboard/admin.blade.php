@extends('layouts.app')

@section('title', 'Security Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <p class="mb-4">Welcome, {{ Auth::user()->name }}.</p>

        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $foundItemsInStorage }}</h3>
                        <p>Found Items in Storage</p>
                    </div>
                    <i class="bi bi-archive small-box-icon"></i>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $pendingClaims }}</h3>
                        <p>Pending Claims</p>
                    </div>
                    <i class="bi bi-hourglass-split small-box-icon"></i>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>{{ $activeLostItems }}</h3>
                        <p>Active Lost Item Reports</p>
                    </div>
                    <i class="bi bi-exclamation-circle small-box-icon"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
