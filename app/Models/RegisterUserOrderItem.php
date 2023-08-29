<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterUserOrderItem extends Model
{
    use HasFactory;
    
    protected $table = 'register_user_order_item';
    public $timestamps = false;
}
