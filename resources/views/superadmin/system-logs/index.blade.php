@extends('layouts.app')

@section('title', 'System Logs')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if ($logs->isEmpty())
                    <p class="text-muted mb-0">No system activity logged yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>When</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $log->created_at->format('M d, Y g:i A') }}</td>
                                        <td>{{ $log->user->name ?? 'System' }}</td>
                                        <td><span class="badge text-bg-secondary">{{ str_replace('_', ' ', $log->action) }}</span></td>
                                        <td>{{ $log->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $logs->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
