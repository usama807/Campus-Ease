@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="container-fluid">
        <p class="mb-4">Welcome, {{ Auth::user()->name }}.</p>

        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $myLostItems }}</h3>
                        <p>My Lost Item Reports</p>
                    </div>
                    <i class="bi bi-box-seam small-box-icon"></i>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $myClaims }}</h3>
                        <p>My Claims</p>
                    </div>
                    <i class="bi bi-hand-index-thumb small-box-icon"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
