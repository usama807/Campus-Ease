@extends('layouts.app')

@section('title', 'Search Found Items')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Search Found Items</h4>

        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('user.found-items.index') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="category_id" class="form-label">Category</label>
                            <select id="category_id" name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" name="location" class="form-control" value="{{ request('location') }}" placeholder="e.g. Library">
                        </div>

                        <div class="col-md-4">
                            <label for="date_found" class="form-label">Date Found</label>
                            <input type="date" id="date_found" name="date_found" class="form-control" value="{{ request('date_found') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <a href="{{ route('user.found-items.index') }}" class="btn btn-outline-secondary mt-3">Reset</a>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if ($foundItems->isEmpty())
                    <p class="text-muted mb-0">No found items match your search.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Date Found</th>
                                    <th>Location Found</th>
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
                                        <td>
                                            <a href="{{ route('user.found-items.show', $foundItem) }}" class="btn btn-sm btn-outline-primary">
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
