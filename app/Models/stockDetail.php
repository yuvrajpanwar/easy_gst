<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'stock_details';

    protected $fillable = [
        'admin_id',
        'product_id',
        'gmqty',
        'unit',
        'invoice_number',
        'vendor_name',
        'invoice_date',
        'date'
        
    ];
}
