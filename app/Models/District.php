<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class District extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The variations that belong to the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function variations(): BelongsToMany
    {
        return $this->belongsToMany(Variation::class)->where('district_id', session('district'))->withPivot(['stock', 'price', 'discounted_from_price', 'discount'])->withTimestamps();
    }
}
