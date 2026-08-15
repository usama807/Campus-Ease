<div class="card mb-3">
    <div class="card-header">
        <i class="bi bi-person-circle"></i> Profile Information
    </div>
    <div class="card-body">
        <p class="text-muted">Update your account's name and email address.</p>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Save
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success ms-2">Saved.</span>
            @endif
        </form>
    </div>
</div>
