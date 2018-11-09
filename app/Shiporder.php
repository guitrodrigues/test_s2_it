<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shiporder extends Model
{
    use SoftDeletes;    
    protected $fillable = ['order_person','shipto_id'];
//    protected $with = ['items','shipto'];
        
    public function items(){
        return $this->hasMany('App\Item');
    }
    
    public function shipto(){
        return $this->belongsTo('App\Shipto', 'shipto_id');
    }
}
