<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class NewsController extends Controller
{
    public function newsfunc(){
       $url = "https://rss.nytimes.com/services/xml/rss/nyt/Technology.xml";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);
        $array_data = json_decode(json_encode(simplexml_load_string($data)), true);

        $array_data = $array_data["channel"]["item"];

       return view('news/newsView',['news'=>$array_data]);

   }
  public function viewNews()
  {
    return view('manager/todo/todo');
  }

 
}
