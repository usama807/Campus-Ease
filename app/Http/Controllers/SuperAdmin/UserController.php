<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('superadmin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', 'in:normal_user,security_admin,super_admin'],
        ]);

        if ($user->id === Auth::id()) {
            return redirect()->route('superadmin.users.index')
                ->with('status', 'You cannot change your own role.');
        }

        $oldRole = $user->role;
        $user->update(['role' => $validated['role']]);

        SystemLog::create([
            'user_id' => Auth::id(),
            'action' => 'role_changed',
            'description' => Auth::user()->name." changed {$user->name}'s role from {$oldRole} to {$validated['role']}.",
        ]);

        return redirect()->route('superadmin.users.index')
            ->with('status', "{$user->name}'s role updated to {$validated['role']}.");
    }
}
