@extends('layouts.app')

@section('title', 'Claim for '.$claim->foundItem->item_name)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-end mb-3">
            <span class="badge text-bg-{{ match ($claim->status) {
                'approved' => 'success',
                'rejected' => 'danger',
                default => 'warning',
            } }}">
                {{ ucfirst($claim->status) }}
            </span>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Claimant</dt>
                    <dd class="col-sm-9">{{ $claim->user->name }} ({{ $claim->user->email }})</dd>

                    <dt class="col-sm-3">Found Item</dt>
                    <dd class="col-sm-9">
                        {{ $claim->foundItem->item_name }} — {{ $claim->foundItem->category->name }},
                        found at {{ $claim->foundItem->location_found }}
                        (item status: {{ str_replace('_', ' ', $claim->foundItem->status) }})
                    </dd>

                    <dt class="col-sm-3">Submitted</dt>
                    <dd class="col-sm-9">{{ $claim->created_at->format('M d, Y g:i A') }}</dd>

                    <dt class="col-sm-3">Verification Details</dt>
                    <dd class="col-sm-9">{{ $claim->verification_answers }}</dd>

                    @if ($claim->reviewed_at)
                        <dt class="col-sm-3">Last Reviewed</dt>
                        <dd class="col-sm-9">
                            {{ $claim->reviewed_at->format('M d, Y g:i A') }} by {{ $claim->reviewer?->name }}
                        </dd>
                    @endif
                </dl>
            </div>

            <div class="card-footer">
                <form method="POST" action="{{ route('superadmin.claims.override', $claim) }}">
                    @csrf
                    @method('PATCH')

                    <div class="row g-2 align-items-start">
                        <div class="col-md-3">
                            <label for="status" class="form-label">Set Status To</label>
                            <select id="status" name="status" class="form-select">
                                @foreach (['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label)
                                    <option value="{{ $value }}" @selected($claim->status === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-7">
                            <label for="reason" class="form-label">Reason for Override</label>
                            <input type="text" id="reason" name="reason" class="form-control @error('reason') is-invalid @enderror"
                                placeholder="Why is this decision being changed?">
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-warning w-100">
                                <i class="bi bi-arrow-repeat"></i> Override
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <a href="{{ route('superadmin.claims.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to All Claims
        </a>
    </div>
@endsection
