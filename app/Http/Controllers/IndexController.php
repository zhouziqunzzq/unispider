<?php

namespace App\Http\Controllers;

use App\Img;
use Illuminate\Http\Request;
use App\Tweet;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

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
        /* $tweets = Tweet::orderBy('origin_created_at', 'desc')->get();
         return view('index', [
             'tweets' => $tweets,
         ]);*/
    }

    public function apitest()
    {
        $ret['result'] = true;
        $ret['msg'] = "success";
        return json_encode($ret);
    }

    public function img($imgid)
    {
        if (!File::exists(__DIR__ . '/../../../public/img/twimg/' . $imgid)) {
            Img::where('img_id', $imgid)->delete();
            $img = new Img();
            $img->img_id = $imgid;
            $img->exist = false;
            $img->save();
            return json_encode(['ret' => false, 'msg' => 'no pic']);
        }
        else {
            return response()->file(__DIR__ . '/../../../public/img/twimg/' . $imgid);
        }
    }
}
