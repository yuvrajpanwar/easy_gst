<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class license extends Model
{
    use HasFactory;

    protected $table = 'license';
    public $timestamps = false;
}
