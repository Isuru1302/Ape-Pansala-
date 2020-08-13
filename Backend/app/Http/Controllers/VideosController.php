<?php

namespace App\Http\Controllers;

use App\videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VideosController extends Controller
{
    public function getAllVideos(){
        $videos = DB::table('videos')->orderBy('id','desc')->get();
        return response()->json(['videoResults'=>$videos],200);
    }

    public function addVideo(Request $request){
        $video = new videos();
        $video->title = $request->input('title');


        $videourl = $request->input('url');
        $replacefrom = "https://www.youtube.com/watch?v=";
        $replaceto = "https://www.youtube.com/embed/";

        $originalVideo = str_replace($replacefrom,$replaceto,$videourl);
        $video->url = $originalVideo;

        $time = Carbon::now()->toDateTimeString();
        $video->created_at = $time;
        $video->save();

        return response()->json(['addvideomessage'=>"added"],200);
    }

    public function deleteVideo($id){
        $video = videos::find($id);

        if(!$video){
            return response()->json(['message'=>"video not found"],404);
        }

        $video->delete();
        return response()->json(['message'=>"deleted"],201);
    }

    public function searchVideo($word){
        $results = DB::table('videos')->Where('title','like','%'.$word.'%')
            ->orderBy('id','desc')->get();

        $response = [
            'search' => $results
        ];
        return response()->json($response,200);
    }
}
