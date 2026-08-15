@extends('layouts.app')

@section('title', $foundItem->item_name)

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">{{ $foundItem->item_name }}</h4>

        <div class="card">
            <div class="card-body">
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

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $foundItem->description ?? 'N/A' }}</dd>
                </dl>
            </div>
        </div>

        <a href="{{ route('user.found-items.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to Search
        </a>
    </div>
@endsection
