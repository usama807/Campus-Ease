<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoundItemController extends Controller
{
    public function index()
    {
        $foundItems = FoundItem::latest()->get();

        return view('admin.found-items.index', compact('foundItems'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.found-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'color' => ['nullable', 'string', 'max:255'],
            'brand_model' => ['nullable', 'string', 'max:255'],
            'date_found' => ['required', 'date'],
            'time_found' => ['nullable', 'date_format:H:i'],
            'location_found' => ['required', 'string', 'max:255'],
            'storage_location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'photos' => ['nullable', 'array'],
            'photos.*' => ['image', 'max:2048'],
        ]);

        $foundItem = FoundItem::create([
            'logged_by' => Auth::id(),
            'item_name' => $validated['item_name'],
            'category_id' => $validated['category_id'],
            'color' => $validated['color'] ?? null,
            'brand_model' => $validated['brand_model'] ?? null,
            'date_found' => $validated['date_found'],
            'time_found' => $validated['time_found'] ?? null,
            'location_found' => $validated['location_found'],
            'storage_location' => $validated['storage_location'],
            'description' => $validated['description'] ?? null,
            'status' => 'in_storage',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $foundItem->photos()->create([
                    'photo_path' => $photo->store('found-items', 'public'),
                ]);
            }
        }

        return redirect()->route('admin.found-items.index')
            ->with('status', 'Found item logged successfully.');
    }

    public function show(FoundItem $foundItem)
    {
        return view('admin.found-items.show', compact('foundItem'));
    }
}
