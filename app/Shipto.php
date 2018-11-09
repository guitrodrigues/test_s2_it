<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipto extends Model
{
    use SoftDeletes;    
    protected $fillable = ['shiporder_id','name', 'address', 'city', 'country'];    
}
