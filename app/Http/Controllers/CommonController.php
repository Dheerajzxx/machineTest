<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommonController extends Controller
{
    public function index(Request $request)
    {
      try{
        $collection = array();
        $response = Http::get('https://opencontext.org/query/Asia/Turkey/Kenan+Tepe.json');
        $res = $response->json();
        foreach ($res as $key => $value) {
          $data_type = gettype($value);
          if($data_type == 'array'){
            $new_value = $value;
            while(isset($new_value[0]) && gettype($new_value[0]) != 'string' && array_key_exists(0, $new_value)){
              $ids = array_column($new_value, 'id');
              if(!empty($ids)){
                foreach ($ids as $id) {
                  array_push($collection, $id);
                }
              }
              $new_value = $new_value[0];
            }
          }
          else if($key == 'id')
          array_push($collection, $value);
        }
        $new_collection = [];
        foreach ($collection as $key => $value) {
          if (!in_array($value, $new_collection)) {
            array_push($new_collection, $value);
          }
        }
        

        return view('test', compact('new_collection'));
      }catch(\Exception $e){
        dd($e);
      }
    }

}
