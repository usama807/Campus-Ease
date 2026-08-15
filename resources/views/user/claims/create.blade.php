@extends('layouts.app')

@section('title', 'Submit Claim')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-1">Submit a Claim</h4>
        <p class="text-muted">For item: <strong>{{ $foundItem->item_name }}</strong></p>

        <div class="card">
            <div class="card-body">
                <p>
                    To verify this item is yours, please answer with specific details only the
                    owner would know (e.g. a unique mark, what's inside, exact color/brand).
                </p>

                <form method="POST" action="{{ route('user.claims.store', $foundItem) }}">
                    @csrf

                    <div class="mb-3">
                        <label for="verification_answers" class="form-label">Verification Details</label>
                        <textarea id="verification_answers" name="verification_answers" rows="5"
                            class="form-control @error('verification_answers') is-invalid @enderror">{{ old('verification_answers') }}</textarea>
                        @error('verification_answers')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Submit Claim
                    </button>
                    <a href="{{ route('user.found-items.show', $foundItem) }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
