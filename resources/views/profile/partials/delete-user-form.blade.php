<div class="card mb-3 border-danger">
    <div class="card-header text-danger">
        <i class="bi bi-exclamation-triangle"></i> Delete Account
    </div>
    <div class="card-body">
        <p class="text-muted">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Before deleting your account, please download any data or information that you wish to retain.
        </p>

        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
            <i class="bi bi-trash"></i> Delete Account
        </button>
    </div>
</div>

<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to delete your account?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                        Please enter your password to confirm you would like to permanently delete your account.
                    </p>
                    <label for="delete_password" class="form-label">Password</label>
                    <input type="password" id="delete_password" name="password"
                        class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Password">
                    @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->userDeletion->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.Modal(document.getElementById('deleteAccountModal')).show();
        });
    </script>
@endif
