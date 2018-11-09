<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\People;
use App\Phone;
use App\Shiporder;
use App\Shipto;
use App\Item;

class UploadFileController extends Controller
{
    public function postIndex(){
        //Tenta ler o XML ou retorna mensagem de erro.
        try{            
            $xml = simplexml_load_file($_FILES['file']['tmp_name']);
        } catch (\Exception $ex){
            return redirect('/')->with(['erro' => "There was an error processing the file."]);
        }
        //Parse para JSON
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        $key = key($xml);
        //Verifica o tipo de arquivo e executa o processamento
        if($key == 'person'){
            return redirect('/')->with(['sucesso' => $this->processPerson($array)]);
        }else if($key == 'shiporder'){
            return redirect('/')->with(['sucesso' => $this->processShiporder($array)]);
        }
        //Retorna mensagem de erro caso o XML não seja de person ou shiporder
        return redirect('/')->with(['erro' => "Sent XML does not meet requirements."]);
    }
    
    private function processPerson($array){
        $people_insert=0;
        $people_update=0;
        $phone_insert=0;
        $phone_update=0;
        
        foreach($array['person'] as $item){            
            //Cria ou atualiza uma nova pessoa
            $people = People::find($item['personid']);  
            if(!$people){       
                $people = new People();
                $people_insert++;
            }else{
                $people_update++;
            }                     
            $people->name = $item['personname'];
            $people->save();
            
            //Verifica se veio telefone como atributo de pessoa
            if(isset($item['phones']['phone'])){
                //Verifica se tem mais de um telefone    
                if(sizeof($item['phones']['phone']) > 1){
                    //percorre o array criando ou atualizando o telefone
                    foreach($item['phones']['phone'] as $itemPhone){
                        $phone = Phone::where('number', $itemPhone)->where('people_id', $people->id)->first();
                        if(!$phone){
                            $phone = new Phone;                            
                            $phone->people_id = $people->id;
                            $phone_insert++;
                        }else{
                            $phone_update++;
                        }                        
                        $phone->number = $itemPhone;
                        $phone->save();                        
                    }                
                }else{
                    //cria ou atualiza o telefone
                    $phone = Phone::where('number', $item['phones']['phone'])->where('people_id', $people->id)->first();
                    if(!$phone){
                        $phone = new Phone;
                        $phone->people_id = $people->id;
                        $phone_insert++;
                    }else{
                        $phone_update++;
                    }                     
                    $phone->number = $item['phones']['phone'];
                    $phone->save();
                }    
            }                  
        }
        $texto = [3 => $phone_update." upgraded phones", 2 => $phone_insert." inserted phones ", 1 => $people_update." people updated",  0 => $people_insert." people inserted",];
        return $texto;
    }    
    
    private function processShiporder($array){
        $shiporder_insert = 0;
        $shiporder_update = 0;
        foreach($array['shiporder'] as $item){
            $shiporder = Shiporder::find($item['orderid']);
            if(!$shiporder){
                $shiporder = new Shiporder();
                $shiporder_insert++;
            }else{
                $shiporder_update++;
            }
            $shiporder->order_person = $item['orderperson'];
            $shiporder->save();           
            
            $shipto = new Shipto();
            $shipto->shiporder_id = $shiporder->id;
            $shipto->fill($item['shipto']);
            $shipto->save();
            
            
            $shiporder->shipto_id = $shipto->id;
            $shiporder->update();
                        
            foreach($item['items'] as $a){
                if(isset($a['title'])){
                    $item = new Item();
                    $item->shiporder_id = $shiporder->id;
                    $item->fill($a);
                    $item->save();
                }else{
                    foreach ($a as $b){
                    $item = new Item();
                    $item->shiporder_id = $shiporder->id;
                    $item->fill($b);
                    $item->save();
                    }
                }                
            }
        }        
        $texto = [ 0 => $shiporder_update." altered shipping orders", 1 => $shiporder_insert." shipping orders entered",];
        return $texto;
    }
}
