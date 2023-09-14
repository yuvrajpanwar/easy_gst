<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'status'
    ];


    public static function updateReceiptNumber($data, $condition)
    {
        return self::where($condition)->update($data);
    }
}
