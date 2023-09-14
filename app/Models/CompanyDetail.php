<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $table = 'billing_address';

    public $timestamps = false;

    protected $fillable = [
        'admin_id',
        'companyname',
        'gst_number',
        'address',
        'city', 
        'statezip',
        'country' ,
        'phone' ,
        'email'
    ];
}
