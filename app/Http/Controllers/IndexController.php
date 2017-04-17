<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    public function index($param)
    {
        $param = str_replace('/', '.', $param);
        if ($param == '.') {
            return view("index");
        }
        elseif (View::exists($param)) {
            return view($param);
        }
        elseif (View::exists($param . ".index")) {
            return view($param . ".index");
        }
        else
            abort(404);
    }

    public function apitest()
    {
        $ret['result'] = true;
        $ret['msg'] = "success";
        return json_encode($ret);
    }
}
