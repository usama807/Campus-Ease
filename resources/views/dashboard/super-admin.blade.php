@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <p class="mb-4">Welcome, {{ Auth::user()->name }}.</p>

        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total Users</p>
                    </div>
                    <i class="bi bi-people small-box-icon"></i>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $totalItems }}</h3>
                        <p>Total Items Reported</p>
                    </div>
                    <i class="bi bi-box-seam small-box-icon"></i>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-info">
                    <div class="inner">
                        <h3>{{ $resolutionRate }}%</h3>
                        <p>Overall Resolution Rate</p>
                    </div>
                    <i class="bi bi-graph-up small-box-icon"></i>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-secondary">
                    <div class="inner">
                        <h3>{{ $systemLogs }}</h3>
                        <p>System Log Entries</p>
                    </div>
                    <i class="bi bi-journal-text small-box-icon"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Users by Role</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                Normal Users <span class="badge text-bg-secondary">{{ $usersByRole['normal_user'] ?? 0 }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Security Admins <span class="badge text-bg-info">{{ $usersByRole['security_admin'] ?? 0 }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Super Admins <span class="badge text-bg-danger">{{ $usersByRole['super_admin'] ?? 0 }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Claims Breakdown</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                Pending <span class="badge text-bg-warning">{{ $claimsBreakdown['pending'] ?? 0 }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Approved <span class="badge text-bg-success">{{ $claimsBreakdown['approved'] ?? 0 }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                Rejected <span class="badge text-bg-danger">{{ $claimsBreakdown['rejected'] ?? 0 }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Found Items by Status</div>
                    <div class="card-body">
                        <div id="found-items-status-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chart = new ApexCharts(document.querySelector('#found-items-status-chart'), {
                chart: { type: 'donut', height: 300 },
                labels: ['In Storage', 'Claimed', 'Donated', 'Disposed'],
                series: [
                    {{ $foundItemsByStatus['in_storage'] ?? 0 }},
                    {{ $foundItemsByStatus['claimed'] ?? 0 }},
                    {{ $foundItemsByStatus['donated'] ?? 0 }},
                    {{ $foundItemsByStatus['disposed'] ?? 0 }},
                ],
                colors: ['#0d6efd', '#198754', '#6c757d', '#212529'],
            });
            chart.render();
        });
    </script>
@endsection
