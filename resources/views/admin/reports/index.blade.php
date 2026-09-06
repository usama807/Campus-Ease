@extends('layouts.app')

@section('title', 'Reports')

@section('content')
    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row">
            <div class="col-md-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $totalLostItems }}</h3>
                        <p>Lost Item Reports</p>
                    </div>
                    <i class="bi bi-box-seam small-box-icon"></i>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="small-box text-bg-info">
                    <div class="inner">
                        <h3>{{ $totalFoundItems }}</h3>
                        <p>Found Items Logged</p>
                    </div>
                    <i class="bi bi-archive small-box-icon"></i>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $pendingClaims }}</h3>
                        <p>Pending Claims</p>
                    </div>
                    <i class="bi bi-hourglass-split small-box-icon"></i>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $resolutionRate }}%</h3>
                        <p>Resolution Rate</p>
                    </div>
                    <i class="bi bi-graph-up small-box-icon"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Claims Breakdown</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                Approved <span class="badge text-bg-success">{{ $approvedClaims }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Pending <span class="badge text-bg-warning">{{ $pendingClaims }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Rejected <span class="badge text-bg-danger">{{ $rejectedClaims }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Frequently Lost Categories</div>
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
        </div>

        <div class="card">
            <div class="card-header">Campus Hotspot Locations</div>
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

        <div class="card">
            <div class="card-header">Export &amp; Maintenance</div>
            <div class="card-body d-flex flex-wrap gap-2">
                <a href="{{ route('admin.reports.export-pdf') }}" class="btn btn-outline-danger">
                    <i class="bi bi-file-earmark-pdf"></i> Export Summary (PDF)
                </a>
                <a href="{{ route('admin.reports.export-csv') }}" class="btn btn-outline-success">
                    <i class="bi bi-file-earmark-excel"></i> Export Found Items (Excel/CSV)
                </a>
                <form method="POST" action="{{ route('admin.reports.run-cleanup') }}"
                      onsubmit="return confirm('Move all unclaimed items older than {{ $unclaimedExpirationDays }} days to Donated status?');">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="bi bi-recycle"></i> Run {{ $unclaimedExpirationDays }}-Day Unclaimed Cleanup
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
