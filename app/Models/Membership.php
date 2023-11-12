<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_membership_active',
        'is_discount_percentage',
        'discount',
        'is_minimum_purchase_active',
        'minimum_purchase',
    ];
    /**
     * Get the user associated with the Membership
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
