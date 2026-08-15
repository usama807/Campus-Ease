<div class="card mb-3">
    <div class="card-header">
        <i class="bi bi-lock"></i> Update Password
    </div>
    <div class="card-body">
        <p class="text-muted">Ensure your account is using a long, random password to stay secure.</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="update_password_current_password" class="form-label">Current Password</label>
                <input type="password" id="update_password_current_password" name="current_password"
                    class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="update_password_password" class="form-label">New Password</label>
                <input type="password" id="update_password_password" name="password"
                    class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Save
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success ms-2">Saved.</span>
            @endif
        </form>
    </div>
</div>
