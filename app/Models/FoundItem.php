<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoundItem extends Model
{
    protected $fillable = [
        'logged_by',
        'item_name',
        'category_id',
        'color',
        'brand_model',
        'date_found',
        'time_found',
        'location_found',
        'storage_location',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_found' => 'date',
        ];
    }

    public function loggedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'logged_by');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(FoundItemPhoto::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(ItemMatch::class);
    }

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }
}
