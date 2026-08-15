<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function store(Request $request, Claim $claim)
    {
        if ($claim->user_id !== Auth::id()) {
            abort(403);
        }

        if ($claim->status !== 'approved') {
            abort(403, 'Chat is only available for approved claims.');
        }

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $claim->chatMessages()->create([
            'sender_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return redirect()->route('user.claims.show', $claim);
    }
}
