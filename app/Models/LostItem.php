<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LostItem extends Model
{
    protected $fillable = [
        'user_id',
        'item_name',
        'category_id',
        'color',
        'brand_model',
        'date_lost',
        'time_lost',
        'location',
        'description',
        'photo',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_lost' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(ItemMatch::class);
    }
}
