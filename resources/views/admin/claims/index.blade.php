@extends('layouts.app')

@section('title', 'Claims')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Claims</h4>

        <div class="card">
            <div class="card-body">
                @if ($claims->isEmpty())
                    <p class="text-muted mb-0">No claims submitted yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Claimant</th>
                                    <th>Found Item</th>
                                    <th>Submitted</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($claims as $claim)
                                    <tr>
                                        <td>{{ $claim->user->name }}</td>
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
                                            <a href="{{ route('admin.claims.show', $claim) }}" class="btn btn-sm btn-outline-primary">
                                                Review
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
