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
                        <a href="{{ route('admin.found-items.show', $claim->foundItem) }}">{{ $claim->foundItem->item_name }}</a>
                        — {{ $claim->foundItem->category->name }}, found at {{ $claim->foundItem->location_found }}
                    </dd>

                    <dt class="col-sm-3">Submitted</dt>
                    <dd class="col-sm-9">{{ $claim->created_at->format('M d, Y g:i A') }}</dd>

                    <dt class="col-sm-3">Verification Details</dt>
                    <dd class="col-sm-9">{{ $claim->verification_answers }}</dd>

                    @if ($claim->status !== 'pending')
                        <dt class="col-sm-3">Reviewed</dt>
                        <dd class="col-sm-9">
                            {{ $claim->reviewed_at?->format('M d, Y g:i A') }} by {{ $claim->reviewer?->name }}
                        </dd>
                    @endif
                </dl>
            </div>

            @if ($claim->status === 'pending')
                <div class="card-footer">
                    <form method="POST" action="{{ route('admin.claims.approve', $claim) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg"></i> Approve Claim
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.claims.reject', $claim) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-x-lg"></i> Reject Claim
                        </button>
                    </form>
                </div>
            @endif
        </div>

        @if ($claim->status === 'approved')
            <div class="card mt-3">
                <div class="card-header">
                    <i class="bi bi-chat-dots"></i> Chat
                    <small class="text-muted">(anonymous, available while this claim is open)</small>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    @forelse ($claim->chatMessages()->latest()->get()->reverse() as $message)
                        <div class="mb-2 {{ $message->sender_id === Auth::id() ? 'text-end' : '' }}">
                            <span class="badge {{ $message->sender_id === Auth::id() ? 'text-bg-primary' : 'text-bg-secondary' }}">
                                {{ $message->sender_id === Auth::id() ? 'You (Security Office)' : 'Claimant' }}
                            </span>
                            <div>{{ $message->message }}</div>
                            <small class="text-muted">{{ $message->created_at->format('M d, g:i A') }}</small>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No messages yet.</p>
                    @endforelse
                </div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('admin.claims.chat.store', $claim) }}" class="d-flex gap-2">
                        @csrf
                        <input type="text" name="message" class="form-control" placeholder="Type a message..." required maxlength="1000">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <a href="{{ route('admin.claims.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to Claims
        </a>
    </div>
@endsection
