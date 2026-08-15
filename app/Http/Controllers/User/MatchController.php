<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use App\Models\ItemMatch;
use App\Models\LostItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MatchController extends Controller
{
    public function index(LostItem $lostItem)
    {
        if ($lostItem->user_id !== Auth::id()) {
            abort(403);
        }

        $foundItems = FoundItem::where('status', 'in_storage')->get();

        foreach ($foundItems as $foundItem) {
            $confidence = $this->calculateConfidence($lostItem, $foundItem);

            if ($confidence > 0) {
                ItemMatch::updateOrCreate(
                    ['lost_item_id' => $lostItem->id, 'found_item_id' => $foundItem->id],
                    ['match_confidence' => $confidence]
                );
            }
        }

        $matches = ItemMatch::where('lost_item_id', $lostItem->id)
            ->where('match_confidence', '>', 0)
            ->orderByDesc('match_confidence')
            ->get();

        return view('user.lost-items.matches', compact('lostItem', 'matches'));
    }

    private function calculateConfidence(LostItem $lostItem, FoundItem $foundItem): int
    {
        $score = 0;

        // Same category
        if ($lostItem->category_id === $foundItem->category_id) {
            $score += 30;
        }

        // Item name keywords overlap
        $lostWords = Str::of($lostItem->item_name)->lower()->explode(' ');
        $foundName = Str::lower($foundItem->item_name);
        foreach ($lostWords as $word) {
            if (strlen($word) > 2 && str_contains($foundName, $word)) {
                $score += 25;
                break;
            }
        }

        // Color match
        if ($lostItem->color && $foundItem->color
            && strcasecmp($lostItem->color, $foundItem->color) === 0) {
            $score += 20;
        }

        // Location proximity (simple substring match)
        if ($lostItem->location && $foundItem->location_found
            && (str_contains(strtolower($foundItem->location_found), strtolower($lostItem->location))
                || str_contains(strtolower($lostItem->location), strtolower($foundItem->location_found)))) {
            $score += 15;
        }

        // Date range (within 7 days)
        $daysApart = $lostItem->date_lost->diffInDays($foundItem->date_found);
        if ($daysApart <= 7) {
            $score += 10;
        }

        return min($score, 100);
    }
}
