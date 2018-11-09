<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;
use App\Shiporder;

class ApiController extends Controller
{
    public function getPeople(){
        $peoples = People::get();
        return response(compact('peoples'), 200)->header('Content-Type', 'text/plain');
    }
    
    public function getPerson($id){
        $person = People::find($id);        
        if(!$person)return response('Invalid id', 400)->header('Content-Type', 'text/plain');
        return response(compact('person'), 200)->header('Content-Type', 'text/plain');
    }
    
    public function getShiporders(){
        $shiporders = Shiporder::with('items','shipto')->get();
        return response(compact('shiporders'), 200)->header('Content-Type', 'text/plain');
    }
    
    public function getIndexShiporder($id){        
        $shiporder = Shiporder::with('items','shipto')->find($id);
        if(!$shiporder)return response('Invalid id', 400)->header('Content-Type', 'text/plain');
        return response(compact('shiporder'), 200)->header('Content-Type', 'text/plain');
    }   
    
}
