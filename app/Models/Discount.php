<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Get the discount that owns the Discount
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
