@extends('layouts.app')

@section('title', 'Claim Details')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Claim for {{ $claim->foundItem->item_name }}</h4>
            <span class="badge text-bg-{{ match ($claim->status) {
                'approved' => 'success',
                'rejected' => 'danger',
                default => 'warning',
            } }}">
                {{ ucfirst($claim->status) }}
            </span>
        </div>

        <div class="card">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Found Item</dt>
                    <dd class="col-sm-9">{{ $claim->foundItem->item_name }}</dd>

                    <dt class="col-sm-3">Submitted</dt>
                    <dd class="col-sm-9">{{ $claim->created_at->format('M d, Y g:i A') }}</dd>

                    <dt class="col-sm-3">Your Verification Details</dt>
                    <dd class="col-sm-9">{{ $claim->verification_answers }}</dd>

                    @if ($claim->status !== 'pending')
                        <dt class="col-sm-3">Reviewed</dt>
                        <dd class="col-sm-9">{{ $claim->reviewed_at?->format('M d, Y g:i A') ?? 'N/A' }}</dd>
                    @endif
                </dl>
            </div>
        </div>

        <a href="{{ route('user.claims.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to My Claims
        </a>
    </div>
@endsection
