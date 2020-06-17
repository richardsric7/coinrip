<?php


namespace App\Services;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Integer;
use App\Footprint;
class LogFootprint
{



public function logvisit($page_visited){
//log visits

    // visitor()->visit();
    $defaul_ip  = '105.112.105.212';
    $ip = $this->getclientip() !='' ? ($this->getclientip() === '127.0.0.1'? $defaul_ip : $this->getclientip()): $defaul_ip;

    $location = Http::get('http://ip-api.com/json/'. $ip);

   return Footprint::create([
        'browser' => request()->visitor()->browser(),
        'device' => request()->visitor()->device(),
        'platform' => request()->visitor()->platform(),
        'languages' => implode(',',request()->visitor()->languages()),
        'ipaddress' => request()->visitor()->ip(),
        'useragent' => request()->visitor()->useragent(),
        'userid' => Auth::id(),
        'isonline' => request()->visitor()->isOnline(),
        'country'=> $location['country'],
        'city'=> $location['city'],
        'longitude'=> $location['lon'],
        'latitude'=> $location['lat'],
        'page_visited'=> $page_visited,
    ]);




}

public function getclientip(){       
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
           return  $_SERVER["HTTP_X_FORWARDED_FOR"];  
    }else if (array_key_exists('REMOTE_ADDR', $_SERVER)) { 
           return $_SERVER["REMOTE_ADDR"]; 
    }else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
           return $_SERVER["HTTP_CLIENT_IP"]; 
    } 

    return '';
}


}
