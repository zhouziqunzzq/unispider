<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class IndexController extends Controller
{
    public function index()
    {
        $tweets = Tweet::all();
        $r = "";
        $r = $r . "<h2>" . $tweets->count() . "</h2>";
        foreach ($tweets as $tweet)
        {
            $r .= "<div> <p>";
            $r .= $tweet->text;
            $r .= "</p></div>";
        }
        return view('index', [
            'tweets' => $r,
        ]);
    }
}
