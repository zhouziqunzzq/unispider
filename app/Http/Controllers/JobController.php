<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Tweet;
use App\Img;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        switch ($type) {
            case 1:
                $job = Job::where('type', $type)->get()->last();
                if (empty($job)) {
                    $job = new Job();
                    $job->max_id = '0'; // latest old tweet
                    $job->since_id = '0'; // oldest new tweet
                    $job->type = 1;
                    $job->save();
                }
                return response(json_encode($job));
                break;
            case 2: // Spider type 2 starts from since_id(id in unispider system) and get tweets' html_content
                $jobs = Tweet::where('html_content', null)
                    ->orderBy('origin_created_at', 'desc')
                    ->take(20)
                    ->get()
                    ->pluck('origin_id');
                $job = new Job();
                $job->max_id = $jobs[0]->id; // latest tweet
                $job->since_id = $jobs[count($jobs) - 1]->id; // oldest tweet
                $job->type = 2;
                $job->save();
                return response(json_encode($jobs));
                break;
            case 3:
                $job_cnt = Img::where('exist', 0)->count();
                if ($job_cnt != 0) {
                    $job = Img::where('exist', 0)->orderBy('id', 'desc')->first();
                    return response(json_encode(['msg' => 'img', 'job' => $job]));
                }
                else {
                    $job = Job::where('type', $type)->get()->last();
                    if (empty($job)) {
                        $job = new Job();
                        $job->max_id = '0'; // latest old tweet
                        $job->since_id = '0'; // oldest new tweet
                        $job->type = 3;
                        $job->save();
                    }
                    $new_tweets = Tweet::where('origin_id', '>', $job->since_id)
                        ->orderBy('origin_created_at', 'desc')
                        ->take(20)
                        ->get();
                    $old_tweets = Tweet::where('origin_id', '<', $job->max_id)
                        ->orderBy('origin_created_at', 'desc')
                        ->take(20)
                        ->get();
                    foreach ($new_tweets as $new_tweet) {
                        $jsondata = $new_tweet->jsondata;
                        $data = json_decode($jsondata, true);
                        if (isset($data['media'])) {
                            foreach ($data['media'] as $media) {
                                if ($media['type'] == 'photo') {
                                    $img = new Img();
                                    $img->img_id = str_replace("https://pbs.twimg.com/media/", "", $media['media_url_https']);
                                    $img->exist = false;
                                    $img->save();
                                }
                            }
                        }
                    }
                    foreach ($old_tweets as $old_tweet) {
                        $jsondata = $old_tweet->jsondata;
                        $data = json_decode($jsondata, true);
                        if (isset($data['media'])) {
                            foreach ($data['media'] as $media) {
                                if ($media['type'] == 'photo') {
                                    $img = new Img();
                                    $img->img_id = str_replace("https://pbs.twimg.com/media/", "", $media['media_url_https']);
                                    $img->exist = false;
                                    $img->save();
                                }
                            }
                        }
                    }
                    $new_job = new Job();
                    $new_job->since_id = count($new_tweets) ? $new_tweets[0]->origin_id : $job->since_id;
                    $new_job->max_id = $job->max_id == 0
                        ? (count($new_tweets) ? $new_tweets[count($new_tweets) - 1]->origin_id : $job->max_id)
                        : (count($old_tweets) ? $old_tweets[count($old_tweets) - 1]->origin_id : $job->max_id);
                    $new_job->type = 3;
                    $new_job->save();
                    return response(json_encode(['msg' => 'fin', 'job' => $job]));
                }
                break;
            default:
                return redirect('/');
        }
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($type, Request $request)
    {
        switch ($type) {
            case 1:
                $job = new Job();
                $job->max_id = $request->input('max_id');
                $job->since_id = $request->input('since_id');
                $job->type = $type;
                $job->save();
                return response('Job updated.\n' . json_encode($job));
                break;
            case 3:
                $imgs = Img::where('img_id', $request->img_id)->get();
                foreach ($imgs as $img) {
                    $img->exist = true;
                    $img->save();
                }
                return response('Job passing.');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
