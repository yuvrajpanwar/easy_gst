<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'stock';

    public static function getStockById($id)
    {
        return self::where('product_id', $id)->first();
    }

    protected $fillable = [
        'admin_id',
        'product_id',
        'gmqty',
        'unit',
        'base_qty',
        'date'
    ];
}
