<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LostItemController extends Controller
{
    public function index()
    {
        $lostItems = LostItem::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.lost-items.index', compact('lostItems'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('user.lost-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'color' => ['nullable', 'string', 'max:255'],
            'brand_model' => ['nullable', 'string', 'max:255'],
            'date_lost' => ['required', 'date'],
            'time_lost' => ['nullable', 'date_format:H:i'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('lost-items', 'public');
        }

        $validated['user_id'] = Auth::id();

        LostItem::create($validated);

        return redirect()->route('user.lost-items.index')
            ->with('status', 'Your lost item report has been submitted.');
    }

    public function show(LostItem $lostItem)
    {
        if ($lostItem->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.lost-items.show', compact('lostItem'));
    }
}
