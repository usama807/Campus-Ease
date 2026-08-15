<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoundItemPhoto extends Model
{
    protected $fillable = ['found_item_id', 'photo_path'];

    public function foundItem(): BelongsTo
    {
        return $this->belongsTo(FoundItem::class);
    }
}
