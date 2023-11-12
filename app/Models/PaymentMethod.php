<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_name',
        'payment_type',
        'account_number',
        'account_name',
    ];
    /**
     * Get the transactions associated with the PaymentMethod
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transactions(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
