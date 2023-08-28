<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBillingAddress extends Model
{
    use HasFactory;

    protected $table ='user_billing_address';

    public $timestamps = false;

  
        protected $fillable = [
            'order_id',
            'name',
            'number',
            'billing_address',
            'shipping_address',
            'state',
        ];
    
}
