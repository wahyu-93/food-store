<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'shipping_id',
        'province_id',
        'city_id',
        'district_id',
        'invoice',
        'weight',
        'address',
        'total',
        'status',
        'snap_token',
    ];
}
