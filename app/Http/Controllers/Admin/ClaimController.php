<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::latest()->get();

        return view('admin.claims.index', compact('claims'));
    }

    public function show(Claim $claim)
    {
        return view('admin.claims.show', compact('claim'));
    }

    public function approve(Claim $claim)
    {
        $claim->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        $claim->foundItem->update(['status' => 'claimed']);

        // Any other pending claims on the same item no longer apply.
        Claim::where('found_item_id', $claim->found_item_id)
            ->where('id', '!=', $claim->id)
            ->where('status', 'pending')
            ->update([
                'status' => 'rejected',
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);

        return redirect()->route('admin.claims.show', $claim)
            ->with('status', 'Claim approved. The item has been marked as claimed.');
    }

    public function reject(Claim $claim)
    {
        $claim->update([
            'status' => 'rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.claims.show', $claim)
            ->with('status', 'Claim rejected.');
    }
}
