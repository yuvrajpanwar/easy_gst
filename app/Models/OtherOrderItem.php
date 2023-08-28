<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherOrderItem extends Model
{
    use HasFactory;

    protected $table = 'other_order_item';
    public $timestamps = false;
}
