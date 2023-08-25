<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;


    protected $table = 'stock';

    public static function getStockById($id)
    {
        return self::where('product_id', $id)->first();
    }
}
