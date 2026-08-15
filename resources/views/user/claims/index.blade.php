@extends('layouts.app')

@section('title', 'My Claims')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">My Claims</h4>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                @if ($claims->isEmpty())
                    <p class="text-muted mb-0">You haven't submitted any claims yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Found Item</th>
                                    <th>Submitted</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($claims as $claim)
                                    <tr>
                                        <td>{{ $claim->foundItem->item_name }}</td>
                                        <td>{{ $claim->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ match ($claim->status) {
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                                default => 'warning',
                                            } }}">
                                                {{ ucfirst($claim->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.claims.show', $claim) }}" class="btn btn-sm btn-outline-primary">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
