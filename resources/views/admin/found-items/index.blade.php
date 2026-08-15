@extends('layouts.app')

@section('title', 'Found Items')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Found Items</h4>
            <a href="{{ route('admin.found-items.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Log Found Item
            </a>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                @if ($foundItems->isEmpty())
                    <p class="text-muted mb-0">No found items logged yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Date Found</th>
                                    <th>Location</th>
                                    <th>Storage</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($foundItems as $foundItem)
                                    <tr>
                                        <td>{{ $foundItem->item_name }}</td>
                                        <td>{{ $foundItem->category->name }}</td>
                                        <td>{{ $foundItem->date_found->format('M d, Y') }}</td>
                                        <td>{{ $foundItem->location_found }}</td>
                                        <td>{{ $foundItem->storage_location }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ match ($foundItem->status) {
                                                'claimed' => 'success',
                                                'donated' => 'secondary',
                                                'disposed' => 'dark',
                                                default => 'info',
                                            } }}">
                                                {{ ucfirst(str_replace('_', ' ', $foundItem->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.found-items.show', $foundItem) }}" class="btn btn-sm btn-outline-primary">
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
