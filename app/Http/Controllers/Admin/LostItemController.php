<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostItem;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

class LostItemController extends Controller
{
    public function index()
    {
        $lostItems = LostItem::latest()->get();

        return view('admin.lost-items.index', compact('lostItems'));
    }

    public function show(LostItem $lostItem)
    {
        return view('admin.lost-items.show', compact('lostItem'));
    }

    public function destroy(LostItem $lostItem)
    {
        SystemLog::create([
            'user_id' => Auth::id(),
            'action' => 'lost_item_removed',
            'description' => Auth::user()->name.' removed lost item report "'.$lostItem->item_name.'" (reported by '.$lostItem->user->name.').',
        ]);

        $lostItem->delete();

        return redirect()->route('admin.lost-items.index')
            ->with('status', 'Report removed.');
    }
}
