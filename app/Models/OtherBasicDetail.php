<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherBasicDetail extends Model
{
    use HasFactory;

    protected $table = 'oredr_basic_details';

    public $timestamps = false;
}
