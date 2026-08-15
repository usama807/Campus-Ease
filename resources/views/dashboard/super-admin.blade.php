@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <p class="mb-4">Welcome, {{ Auth::user()->name }}.</p>

        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total Users</p>
                    </div>
                    <i class="bi bi-people small-box-icon"></i>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $totalItems }}</h3>
                        <p>Total Items Reported</p>
                    </div>
                    <i class="bi bi-box-seam small-box-icon"></i>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-secondary">
                    <div class="inner">
                        <h3>{{ $systemLogs }}</h3>
                        <p>System Log Entries</p>
                    </div>
                    <i class="bi bi-journal-text small-box-icon"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
