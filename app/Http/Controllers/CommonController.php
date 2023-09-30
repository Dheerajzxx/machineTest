<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommonController extends Controller
{
    public function index(Request $request)
    {
      try{
        $response = Http::get('https://opencontext.org/query/Asia/Turkey/Kenan+Tepe.json');
        $res = $response->body();
        preg_match_all('/\bid\":.*,/',$res, $matches);
        foreach ($matches[0] as $key => $match) {
          $matches[0][$key] = substr($match, 6, -2);
        }
        $new_collection = [];
        foreach ($matches[0] as $key => $value) {
          if (!in_array($value, $new_collection)) {
            array_push($new_collection, $value);
          }
        }
        return view('test', compact('new_collection', 'res'));
      }catch(\Exception $e){
        dd($e);
      }
    }
  

}
