<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class IndexController extends Controller
{
    public function index()
    {
        $tweets = Tweet::orderBy('origin_created_at', 'desc')->get();
        return view('index', [
            'tweets' => $tweets,
        ]);
    }
}
