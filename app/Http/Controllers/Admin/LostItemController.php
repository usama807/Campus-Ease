<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use App\Models\LostItem;
use App\Models\SystemLog;
use Illuminate\Http\Request;
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

    public function approve(Request $request, LostItem $lostItem)
    {
        $validated = $request->validate([
            'storage_location' => ['required', 'string', 'max:255'],
        ]);

        FoundItem::create([
            'logged_by' => Auth::id(),
            'item_name' => $lostItem->item_name,
            'category_id' => $lostItem->category_id,
            'color' => $lostItem->color,
            'brand_model' => $lostItem->brand_model,
            'date_found' => now()->toDateString(),
            'location_found' => $lostItem->location,
            'storage_location' => $validated['storage_location'],
            'description' => $lostItem->description,
            'status' => 'in_storage',
        ]);

        $lostItem->update(['status' => 'approved']);

        SystemLog::create([
            'user_id' => Auth::id(),
            'action' => 'lost_item_approved',
            'description' => Auth::user()->name.' approved lost item report "'.$lostItem->item_name.'" (reported by '.$lostItem->user->name.') and logged it as a found item.',
        ]);

        return redirect()->route('admin.lost-items.show', $lostItem)
            ->with('status', 'Report approved and logged as a found item. It now appears in Found Items and can be claimed.');
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
