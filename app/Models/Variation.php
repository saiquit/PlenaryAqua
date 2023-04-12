<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variation extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the product that owns the Variation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The districts that belong to the Variation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function current_district(): BelongsToMany
    {
        return $this->belongsToMany(District::class)->where('district_id', session('district'))->withPivot(['stock', 'price', 'discounted_from_price', 'discount'])->withTimestamps();
    }

    public function districts(): BelongsToMany
    {
        return $this->belongsToMany(District::class)->withPivot(['stock', 'price', 'discounted_from_price', 'discount'])->withTimestamps();
    }

    public function get_price()
    {
        return $this->current_district[0]->pivot->price;
    }
    public function get_distirct_products()
    {
        return $this->whereHas('districts', function ($d) {
            $d->where('district_id', session('district'));
        });
    }
    /**
     * The order that belong to the Variation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot(['wt', 'qty'])->withTimestamps();
    }

    /**
     * The tags that belong to the Variation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    /**
     * The images that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class)->withTimestamps();
    }
}
