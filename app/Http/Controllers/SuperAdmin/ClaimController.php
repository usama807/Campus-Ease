<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::latest()->get();

        return view('superadmin.claims.index', compact('claims'));
    }

    public function show(Claim $claim)
    {
        return view('superadmin.claims.show', compact('claim'));
    }

    public function override(Request $request, Claim $claim)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'reason' => ['required', 'string', 'min:5'],
        ]);

        $wasApproved = $claim->status === 'approved';
        $oldStatus = $claim->status;

        $claim->update([
            'status' => $validated['status'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        if ($validated['status'] === 'approved') {
            $claim->foundItem->update(['status' => 'claimed']);

            Claim::where('found_item_id', $claim->found_item_id)
                ->where('id', '!=', $claim->id)
                ->whereIn('status', ['pending', 'approved'])
                ->update([
                    'status' => 'rejected',
                    'reviewed_by' => Auth::id(),
                    'reviewed_at' => now(),
                ]);
        } elseif ($wasApproved) {
            // This claim no longer holds the item, so it goes back up for grabs.
            $claim->foundItem->update(['status' => 'in_storage']);
        }

        SystemLog::create([
            'user_id' => Auth::id(),
            'action' => 'claim_overridden',
            'description' => Auth::user()->name." overrode claim #{$claim->id} from {$oldStatus} to {$validated['status']}. Reason: {$validated['reason']}",
        ]);

        return redirect()->route('superadmin.claims.show', $claim)
            ->with('status', 'Claim decision overridden.');
    }
}
