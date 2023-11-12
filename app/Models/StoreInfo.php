<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_name',
        'store_contact',
        'store_address',
    ];
}
