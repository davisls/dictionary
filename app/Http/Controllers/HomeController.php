<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function search(Request $request){
        $word = $request->word;

        if(!$word){
            $url = false;
            return view('welcome', ['url' => $url]);
        }

        if(preg_match('/[^a-z]/i', $word) == 1){
            $url = false;
            return view('welcome', ['url' => $url]);
        }

        $url = 'https://api.dictionaryapi.dev/api/v2/entries/en/'.$word;
        $url = @file_get_contents($url);
        $url = json_decode($url);

        $audio = '';

        if($url){
            foreach($url[0]->phonetics as $item){
                if($item->audio){
                    $audio = $item->audio;
                }
            }
        }

        return view('welcome', ['url' => $url, 'audio' => $audio]);
    }
}
