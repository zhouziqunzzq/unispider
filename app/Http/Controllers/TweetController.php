<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = isset($request->date) ? strtotime($request->date) + 86400 : strtotime(date('Y-m-d')) + 86400;
        $offset = isset($request->offset) ? intval($request->offset) : 0;
        $ts = Tweet::where('origin_created_at', '<', $date)
            ->orderBy('origin_created_at', 'desc')
            ->offset($offset)
            ->limit(20)
            ->get();
        return json_encode($ts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tweet = json_decode($request->input('data'));
        $t = new Tweet();
        $t->origin_id = $tweet->id_str;
        $t->origin_created_at = strtotime($tweet->created_at);
        $t->text = $tweet->text;
        $t->jsondata = $request->input('data');
        $t->save();
        return response("ID:" . $t->origin_id . " saved.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $t = Tweet::find($id);
        return json_encode($t);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tweet = Tweet::where('origin_id', $id)->first();
        $tweet->html_content = $request->input('html_content');
        $tweet->save();
        return response($tweet->origin_id . " updated.");
    }

}
