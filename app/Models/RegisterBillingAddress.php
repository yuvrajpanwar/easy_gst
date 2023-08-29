<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterBillingAddress extends Model
{
    use HasFactory;

    protected $table = 'register_billing_address';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'name',
        'number',
        'billing_address',
        'shipping_address',
        'state'

    ];

}
