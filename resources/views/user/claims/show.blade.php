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
                                {{ $message->sender_id === Auth::id() ? 'You' : 'Security Office' }}
                            </span>
                            <div>{{ $message->message }}</div>
                            <small class="text-muted">{{ $message->created_at->format('M d, g:i A') }}</small>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No messages yet. Say hello to arrange pickup.</p>
                    @endforelse
                </div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('user.claims.chat.store', $claim) }}" class="d-flex gap-2">
                        @csrf
                        <input type="text" name="message" class="form-control" placeholder="Type a message..." required maxlength="1000">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            </div>
        @elseif ($claim->status === 'pending')
            <div class="alert alert-info mt-3 mb-0">
                Chat will be available here once Security Admin approves your claim.
            </div>
        @endif

        <a href="{{ route('user.claims.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to My Claims
        </a>
    </div>
@endsection
