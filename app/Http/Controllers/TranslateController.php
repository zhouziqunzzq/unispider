<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TranslateController extends Controller
{
    public function getMachineTranslation() {

        $tweets = Tweet::where('trans_zh_author', null)->get();
        $ch = curl_init();
        $r = array();
        foreach ($tweets as $tweet) {
            $salt = str_random(16);
            $q = $tweet->text;
            $url = "http://api.fanyi.baidu.com/api/trans/vip/translate?q=" . urlencode($q)
                . "&from=jp&to=zh&appid="
                . env('BAIDU_APP_ID')
                . "&salt=" . $salt
                . "&sign=" . md5(env('BAIDU_APP_ID') . $q . $salt . env("BAIDU_APP_KEY"));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $output = curl_exec($ch);

            $output = json_decode($output,true);
            $tweet->trans_zh = "";
            foreach ($output['trans_result'] as $trans_result_branch)
                $tweet->trans_zh .= $trans_result_branch['dst'];
            $tweet->trans_zh_author = "fanyi.baidu.com";
            $tweet->save();

            array_push($r, $output);
        }

        return json_encode($r);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
