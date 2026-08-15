@extends('layouts.app')

@section('title', 'Possible Matches')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-1">Possible Matches</h4>
        <p class="text-muted">For your report: <strong>{{ $lostItem->item_name }}</strong></p>

        <div class="card">
            <div class="card-body">
                @if ($matches->isEmpty())
                    <p class="text-muted mb-0">No possible matches found yet. Check back later as new found items are logged.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Found Item</th>
                                    <th>Category</th>
                                    <th>Date Found</th>
                                    <th>Location Found</th>
                                    <th>Match Confidence</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matches as $match)
                                    <tr>
                                        <td>{{ $match->foundItem->item_name }}</td>
                                        <td>{{ $match->foundItem->category->name }}</td>
                                        <td>{{ $match->foundItem->date_found->format('M d, Y') }}</td>
                                        <td>{{ $match->foundItem->location_found }}</td>
                                        <td>
                                            <div class="progress" style="height: 20px; min-width: 120px;">
                                                <div class="progress-bar bg-{{ $match->match_confidence >= 70 ? 'success' : ($match->match_confidence >= 40 ? 'warning' : 'secondary') }}"
                                                     style="width: {{ $match->match_confidence }}%">
                                                    {{ $match->match_confidence }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.found-items.show', $match->foundItem) }}" class="btn btn-sm btn-outline-primary">
                                                View Item
                                            </a>
                                            <a href="{{ route('user.claims.create', $match->foundItem) }}" class="btn btn-sm btn-primary">
                                                Claim
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

        <a href="{{ route('user.lost-items.show', $lostItem) }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Back to Report
        </a>
    </div>
@endsection
