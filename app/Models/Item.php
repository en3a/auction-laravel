<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory, Uuids;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('active', self::ACTIVE);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(BidHistory::class, 'item_id');
    }
}
