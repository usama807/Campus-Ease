<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FoundItem;
use Illuminate\Http\Request;

class FoundItemController extends Controller
{
    public function index(Request $request)
    {
        $query = FoundItem::where('status', 'in_storage');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('location')) {
            $query->where('location_found', 'like', '%'.$request->location.'%');
        }

        if ($request->filled('date_found')) {
            $query->whereDate('date_found', $request->date_found);
        }

        $foundItems = $query->latest()->get();
        $categories = Category::orderBy('name')->get();

        return view('user.found-items.index', compact('foundItems', 'categories'));
    }

    public function show(FoundItem $foundItem)
    {
        return view('user.found-items.show', compact('foundItem'));
    }
}
