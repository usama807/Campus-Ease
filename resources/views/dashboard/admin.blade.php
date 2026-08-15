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

            <div class="col-lg-4 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $resolutionRate }}%</h3>
                        <p>Claim Resolution Rate</p>
                    </div>
                    <i class="bi bi-graph-up small-box-icon"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-bar-chart"></i> Frequently Lost Categories
                    </div>
                    <div class="card-body">
                        @if ($frequentlyLostItems->isEmpty())
                            <p class="text-muted mb-0">No data yet.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach ($frequentlyLostItems as $row)
                                    <li class="list-group-item d-flex justify-content-between">
                                        {{ $row->category->name }}
                                        <span class="badge text-bg-secondary">{{ $row->total }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-geo-alt"></i> Campus Hotspot Locations
                    </div>
                    <div class="card-body">
                        @if ($hotspotLocations->isEmpty())
                            <p class="text-muted mb-0">No data yet.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach ($hotspotLocations as $row)
                                    <li class="list-group-item d-flex justify-content-between">
                                        {{ $row->location }}
                                        <span class="badge text-bg-secondary">{{ $row->total }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.reports.index') }}" class="btn btn-primary mt-3">
            <i class="bi bi-file-earmark-bar-graph"></i> View Full Reports
        </a>
    </div>
@endsection
