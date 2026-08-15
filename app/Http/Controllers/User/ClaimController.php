<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::where('user_id', Auth::id())->latest()->get();

        return view('user.claims.index', compact('claims'));
    }

    public function create(FoundItem $foundItem)
    {
        if ($foundItem->status !== 'in_storage') {
            return redirect()->route('user.found-items.show', $foundItem)
                ->with('status', 'This item is no longer available to claim.');
        }

        $alreadyClaimed = Claim::where('user_id', Auth::id())
            ->where('found_item_id', $foundItem->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($alreadyClaimed) {
            return redirect()->route('user.found-items.show', $foundItem)
                ->with('status', 'You already have a claim on this item.');
        }

        return view('user.claims.create', compact('foundItem'));
    }

    public function store(Request $request, FoundItem $foundItem)
    {
        if ($foundItem->status !== 'in_storage') {
            return redirect()->route('user.found-items.show', $foundItem)
                ->with('status', 'This item is no longer available to claim.');
        }

        $validated = $request->validate([
            'verification_answers' => ['required', 'string', 'min:10'],
        ]);

        Claim::create([
            'user_id' => Auth::id(),
            'found_item_id' => $foundItem->id,
            'verification_answers' => $validated['verification_answers'],
            'status' => 'pending',
        ]);

        return redirect()->route('user.claims.index')
            ->with('status', 'Your claim has been submitted for review.');
    }

    public function show(Claim $claim)
    {
        if ($claim->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.claims.show', compact('claim'));
    }
}
