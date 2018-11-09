<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;    
    protected $fillable = ['shiporder_id', 'title', 'note', 'quantity', 'price'];
    public function shiptorder(){
        return $this->belongsTo('App\Shiporder', 'shiporder_id');
    }
}
