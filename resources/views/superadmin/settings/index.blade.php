@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">System Settings</h4>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('superadmin.settings.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="match_sensitivity_threshold" class="form-label">Match Sensitivity Threshold (%)</label>
                        <input type="number" id="match_sensitivity_threshold" name="match_sensitivity_threshold"
                            class="form-control @error('match_sensitivity_threshold') is-invalid @enderror"
                            value="{{ old('match_sensitivity_threshold', $matchSensitivity) }}" min="0" max="100" required style="max-width: 200px;">
                        <div class="form-text">
                            Only show a found item as a "possible match" to a user if its match confidence score is at
                            or above this percentage. Lower = more (looser) matches shown, higher = fewer (stricter) matches.
                        </div>
                        @error('match_sensitivity_threshold')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="unclaimed_item_expiration_days" class="form-label">Unclaimed Item Expiration (days)</label>
                        <input type="number" id="unclaimed_item_expiration_days" name="unclaimed_item_expiration_days"
                            class="form-control @error('unclaimed_item_expiration_days') is-invalid @enderror"
                            value="{{ old('unclaimed_item_expiration_days', $expirationDays) }}" min="1" required style="max-width: 200px;">
                        <div class="form-text">
                            Found items still "In Storage" after this many days are eligible to be moved to Donated
                            status via the Security Admin's cleanup action.
                        </div>
                        @error('unclaimed_item_expiration_days')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Settings
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
