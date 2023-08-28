<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'image',
        'currency',
        'discount',
        'cod',
        'emi',
        'status',
        'gmqty',
        'unit',
        'type',
        'product_type',
        'description',
        'price',
        'hsn_code',
        'cgst_tax',
        'sgst_tax',
        'admin_id',
        'rk_code',

    ];

    public static function getProductDetails($id)
    {
        return self::where('id', $id)->first();
    }


}
