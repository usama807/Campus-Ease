<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemMatch extends Model
{
    protected $fillable = ['lost_item_id', 'found_item_id', 'match_confidence', 'status'];

    public function lostItem(): BelongsTo
    {
        return $this->belongsTo(LostItem::class);
    }

    public function foundItem(): BelongsTo
    {
        return $this->belongsTo(FoundItem::class);
    }
}
