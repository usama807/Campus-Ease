@extends('layouts.app')

@section('title', $lostItem->item_name)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-end mb-3">
            <span class="badge text-bg-{{ match ($lostItem->status) {
                'matched' => 'info',
                'claimed' => 'success',
                'closed' => 'secondary',
                default => 'warning',
            } }}">
                {{ ucfirst($lostItem->status) }}
            </span>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if ($lostItem->photo)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('storage/' . $lostItem->photo) }}" alt="{{ $lostItem->item_name }}" class="img-fluid rounded">
                        </div>
                    @endif

                    <div class="{{ $lostItem->photo ? 'col-md-8' : 'col-12' }}">
                        <dl class="row mb-0">
                            <dt class="col-sm-3">Category</dt>
                            <dd class="col-sm-9">{{ $lostItem->category->name }}</dd>

                            <dt class="col-sm-3">Color</dt>
                            <dd class="col-sm-9">{{ $lostItem->color ?? 'N/A' }}</dd>

                            <dt class="col-sm-3">Brand / Model</dt>
                            <dd class="col-sm-9">{{ $lostItem->brand_model ?? 'N/A' }}</dd>

                            <dt class="col-sm-3">Date Lost</dt>
                            <dd class="col-sm-9">
                                {{ $lostItem->date_lost->format('M d, Y') }}
                                @if ($lostItem->time_lost)
                                    at {{ $lostItem->time_lost }}
                                @endif
                            </dd>

                            <dt class="col-sm-3">Location</dt>
                            <dd class="col-sm-9">{{ $lostItem->location }}</dd>

                            <dt class="col-sm-3">Description</dt>
                            <dd class="col-sm-9">{{ $lostItem->description ?? 'N/A' }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('user.lost-items.matches', $lostItem) }}" class="btn btn-primary mt-3">
            <i class="bi bi-search"></i> View Possible Matches
        </a>
        <a href="{{ route('user.lost-items.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to My Reports
        </a>
    </div>
@endsection
