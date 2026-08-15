@extends('layouts.app')

@section('title', $foundItem->item_name)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">{{ $foundItem->item_name }}</h4>
            <span class="badge text-bg-{{ match ($foundItem->status) {
                'claimed' => 'success',
                'donated' => 'secondary',
                'disposed' => 'dark',
                default => 'info',
            } }}">
                {{ ucfirst(str_replace('_', ' ', $foundItem->status)) }}
            </span>
        </div>

        <div class="card">
            <div class="card-body">
                @if ($foundItem->photos->isNotEmpty())
                    <div class="row mb-3">
                        @foreach ($foundItem->photos as $photo)
                            <div class="col-md-3 col-6 mb-3">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="{{ $foundItem->item_name }}" class="img-fluid rounded">
                            </div>
                        @endforeach
                    </div>
                @endif

                <dl class="row mb-0">
                    <dt class="col-sm-3">Category</dt>
                    <dd class="col-sm-9">{{ $foundItem->category->name }}</dd>

                    <dt class="col-sm-3">Color</dt>
                    <dd class="col-sm-9">{{ $foundItem->color ?? 'N/A' }}</dd>

                    <dt class="col-sm-3">Brand / Model</dt>
                    <dd class="col-sm-9">{{ $foundItem->brand_model ?? 'N/A' }}</dd>

                    <dt class="col-sm-3">Date Found</dt>
                    <dd class="col-sm-9">
                        {{ $foundItem->date_found->format('M d, Y') }}
                        @if ($foundItem->time_found)
                            at {{ $foundItem->time_found }}
                        @endif
                    </dd>

                    <dt class="col-sm-3">Location Found</dt>
                    <dd class="col-sm-9">{{ $foundItem->location_found }}</dd>

                    <dt class="col-sm-3">Storage Location</dt>
                    <dd class="col-sm-9">{{ $foundItem->storage_location }}</dd>

                    <dt class="col-sm-3">Logged By</dt>
                    <dd class="col-sm-9">{{ $foundItem->loggedBy->name }}</dd>

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $foundItem->description ?? 'N/A' }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <form method="POST" action="{{ route('admin.found-items.update-status', $foundItem) }}" class="d-flex gap-2 align-items-center">
                    @csrf
                    @method('PATCH')
                    <label for="status" class="form-label mb-0">Update Status:</label>
                    <select id="status" name="status" class="form-select" style="max-width: 200px;">
                        @foreach (['in_storage' => 'In Storage', 'claimed' => 'Claimed', 'donated' => 'Donated', 'disposed' => 'Disposed'] as $value => $label)
                            <option value="{{ $value }}" @selected($foundItem->status === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mt-3">{{ session('status') }}</div>
        @endif

        <a href="{{ route('admin.found-items.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to Found Items
        </a>
    </div>
@endsection
