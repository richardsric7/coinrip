<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class MarketDataController extends Controller
{
    //
    protected $coinCapImageBase = 'https://static.coincap.io/assets/icons/';
    protected $coinMarketCapApiKey = '241d3d43-357d-49cf-9b09-24e91711b26b';
    protected $coinMarketCapBaseUrl = 'https://pro-api.coinmarketcap.com/';
    protected $coinCapBaseUrl = 'https://api.coincap.io/v2/';



    public function coinmarketcapassets(){
        //do coincap calls here
$endpoint = 'v1/cryptocurrency/listings/latest';
$response = Http::withHeaders([
    'X-CMC_PRO_API_KEY' => $this->coinMarketCapApiKey,])
->get($this->coinMarketCapBaseUrl . $endpoint);
// $response = Http::get('https://jsonplaceholder.typicode.com/todos/1');
$message = 'Successfull';
if($response->status()==404){
    $message = 'URL Not Found';
}
elseif($response->status()==500){
    $message = 'Unreachable';
}
elseif($response->status()==401){
    $message = 'Forbidden Access';
} else{
    $message = 'Successful';
}
return [$response->json(), $response->successful(), $response->status(), $message];

    }


    public function coincapassets(){
        //do coincap calls here
$endpoint = 'assets';
$response = Http::get($this->coinCapBaseUrl . $endpoint);
// $response = Http::get('https://jsonplaceholder.typicode.com/todos/1');
$message = 'Successfull';
if($response->status()==404){
    $message = 'URL Not Found';
}
elseif($response->status()==500){
    $message = 'Unreachable';
}
elseif($response->status()==401){
    $message = 'Forbidden Access';
} else{
    $message = 'Successful';
}
return [$response->json(), $response->successful(), $response->status(), $message];

    }



    public function marketassets(){
        $coincapData = $this->coincapassets();
        $coinmarketcapData = $this->coinmarketcapassets();
        $globalmetrics = $this->globalmetrics();
        $message = 'Successful';
        $status = 'success';
        if(!$coincapData[1] && !$coinmarketcapData[1] && $globalmetrics[1]){
            $message = 'Failed';
            $status = 'failed';
        }

        return response()->json(['status' => $status, 
        'payload' => ['coincap' => $coincapData[0],
        'coinmarketcap'=> $coinmarketcapData[0],
        'globalmetrics' => $globalmetrics[0]]], 200);

    }



    public function coinmarketcapidmap(){
        $endpoint = '/v1/cryptocurrency/map';


    }

    public function globalmetrics(){
        $endpoint = '/v1/global-metrics/quotes/latest';
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->coinMarketCapApiKey,])
        ->get($this->coinMarketCapBaseUrl . $endpoint);
        // $response = Http::get('https://jsonplaceholder.typicode.com/todos/1');
        $message = 'Successfull';
        if($response->status()==404){
            $message = 'URL Not Found';
        }
        elseif($response->status()==500){
            $message = 'Unreachable';
        }
        elseif($response->status()==401){
            $message = 'Forbidden Access';
        } else{
            $message = 'Successful';
        }
        return [$response->json(), $response->successful(), $response->status(), $message];


    }
    public function convert(){
        if(request('currency')=="" || request('symbol')==""){
            return response()->json(['status' => 'failed', 
            'payload' => []], 200);
        }
        $endpoint = '/v1/cryptocurrency/quotes/latest';
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->coinMarketCapApiKey,])
        ->get($this->coinMarketCapBaseUrl . $endpoint,[
            'convert'=> request('currency'),
            'symbol'=> request('symbol'),
        ]);
        
        $message = 'Successfull';
        $status = 'success';
        if($response->status()==404){
            $message = 'URL Not Found';
        }
        elseif($response->status()==500){
            $message = 'Unreachable';
        }
        elseif($response->status()==401){
            $message = 'Forbidden Access';
        } else{
            $message = 'Successful';
        }
         return response()->json(['status' => $status, 
        'payload' => $response->json()], 200);


    }



    public function coincaprates(){
        //do coincap calls here
$endpoint = 'rates/'. request('currency_id');
$response = Http::get($this->coinCapBaseUrl . $endpoint);

$message = 'Successfull';
if($response->status()==404){
    $message = 'URL Not Found';
}
elseif($response->status()==500){
    $message = 'Unreachable';
}
elseif($response->status()==401){
    $message = 'Forbidden Access';
} else{
    $message = 'Successful';
}
return response()->json(['status' => 'success', 
'payload' => $response->json()], 200);
    }

    public function coincapassethistory(){
        //do coincap calls here
$start = date_timestamp_get(Carbon::now()->subWeek()) * 1000;
$end = date_timestamp_get(Carbon::now()) * 1000;
$endpoint = 'assets/'. request('currency_id') .'/history?interval=h12&start='.$start.'&end='.$end;
$response = Http::get($this->coinCapBaseUrl . $endpoint);

$message = 'Successfull';
if($response->status()==404){
    $message = 'URL Not Found';
}
elseif($response->status()==500){
    $message = 'Unreachable';
}
elseif($response->status()==401){
    $message = 'Forbidden Access';
} else{
    $message = 'Successful';
}
return response()->json(['status' => 'success', 
'payload' => $response->json()], 200);
    }


}
