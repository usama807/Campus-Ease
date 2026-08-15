@extends('layouts.app')

@section('title', 'My Lost Reports')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('user.lost-items.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Report Lost Item
            </a>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                @if ($lostItems->isEmpty())
                    <p class="text-muted mb-0">You haven't reported any lost items yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Date Lost</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lostItems as $lostItem)
                                    <tr>
                                        <td>{{ $lostItem->item_name }}</td>
                                        <td>{{ $lostItem->category->name }}</td>
                                        <td>{{ $lostItem->date_lost->format('M d, Y') }}</td>
                                        <td>{{ $lostItem->location }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ match ($lostItem->status) {
                                                'matched' => 'info',
                                                'claimed' => 'success',
                                                'closed' => 'secondary',
                                                default => 'warning',
                                            } }}">
                                                {{ ucfirst($lostItem->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.lost-items.show', $lostItem) }}" class="btn btn-sm btn-outline-primary">
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
