@extends('layouts.app')

@section('title', 'Lost Item Reports')

@section('content')
    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                @if ($lostItems->isEmpty())
                    <p class="text-muted mb-0">No lost item reports yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Reported By</th>
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
                                        <td>{{ $lostItem->user->name }}</td>
                                        <td>{{ $lostItem->category->name }}</td>
                                        <td>{{ $lostItem->date_lost->format('M d, Y') }}</td>
                                        <td>{{ $lostItem->location }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ match ($lostItem->status) {
                                                'approved' => 'primary',
                                                'matched' => 'info',
                                                'claimed' => 'success',
                                                'closed' => 'secondary',
                                                default => 'warning',
                                            } }}">
                                                {{ ucfirst($lostItem->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.lost-items.show', $lostItem) }}" class="btn btn-sm btn-outline-primary">
                                                View{{ $lostItem->status === 'pending' ? ' / Approve' : '' }}
                                            </a>
                                            <form method="POST" action="{{ route('admin.lost-items.destroy', $lostItem) }}" class="d-inline"
                                                  onsubmit="return confirm('Remove this report as fake/invalid? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                            </form>
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
