@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Manage Users</h4>

        @if (session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Current Role</th>
                                <th>Change Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge text-bg-{{ match ($user->role) {
                                            'super_admin' => 'danger',
                                            'security_admin' => 'info',
                                            default => 'secondary',
                                        } }}">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($user->id === Auth::id())
                                            <span class="text-muted">This is you</span>
                                        @else
                                            <form method="POST" action="{{ route('superadmin.users.update-role', $user) }}" class="d-flex gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" class="form-select form-select-sm" style="max-width: 180px;">
                                                    @foreach (['normal_user' => 'Normal User', 'security_admin' => 'Security Admin', 'super_admin' => 'Super Admin'] as $value => $label)
                                                        <option value="{{ $value }}" @selected($user->role === $value)>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
