<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'is_discount_active',
        'is_discount_percentage',
        'discount',
        'is_discount_expired',
        'expired_at',
        'is_discount_of_amount',
        'amount_discount',
    ];
    /**
     * Get the products associated with the Discount
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function products(): HasOne
    {
        return $this->hasOne(Product::class);
    }
}
