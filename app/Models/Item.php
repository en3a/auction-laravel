<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory, Uuids;

    protected $guarded = [];

    public function bids(): HasMany
    {
        return $this->hasMany(BidHistory::class, 'item_id');
    }
}
