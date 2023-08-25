<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterUserOrder extends Model
{

    use HasFactory;
    protected $table = 'register_user_order';



    
    public static function updateRegisterReceiptNumber($data, $condition)
    {
        return self::where($condition)->update($data);
    }
}
