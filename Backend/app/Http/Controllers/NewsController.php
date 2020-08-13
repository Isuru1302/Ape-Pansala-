<?php


namespace App\Http\Controllers;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    public function getNews(){
        $news = DB::table('news')->orderBy('updated_at','desc')->get();
        return response()->json(['news'=>$news],200);
    }

    public function getNewsByID($id){
        $news = News::find($id);
        return response()->json(['news'=>$news],200);
    }

    public function deleteNews($id){
        $news = News::find($id);
        if(!$news){
            return response()->json(['message'=>"article not found"],404);
        }

        $news->delete();
        return response()->json(['news'=>"deleted"],201);
    }

    public function updateNews($id,Request $request){
        $news = News::find($id);

        $news->title = $request->input('title');
        $news->description = $request->input('description');

        $news->save();
        return response()->json(['news'=>$news],201);
    }

    public function newNews(Request $request){
        $news = new News();
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->save();
        return response()->json(['news'=>"updated"],201);
    }
}
