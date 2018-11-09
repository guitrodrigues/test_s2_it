<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use SoftDeletes;
    protected $fillable = ['people_id','number'];
    
    public function people(){
        return $this->belongsTo('App\People', 'people_id');
    }
}
