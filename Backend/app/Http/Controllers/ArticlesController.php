<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TemplesController;
use Illuminate\Http\Request;
use App\articles;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{

    public function getArticles(){
        $articels = DB::table('articles')->orderBy('id','desc')->get();
        return response()->json(['articles'=>$articels],200);
    }

    public function getArticlesByID($id){
        $article = articles::find($id);
        $response = [
            'article' => $article
        ];

        return response()->json($response,200);
    }

    public function deleteArticle($id){
        $article = articles::find($id);
        if(!$article){
            return response()->json(['message'=>"article not found"],404);
        }

        $article->delete();
        return response()->json(['message'=>"deleted"],201);
    }

    public function addArticle(Request $request){

        $article = new articles();
        $article->article_title = $request->input('title');
        $article->article_content = $request->input('content');

        $img1 = $request->input('img1');
        $img2 = $request->input('img2');
        $img3 = $request->input('img3');
        $img4 = $request->input('img4');

        $path = 'H:/Vue Js/blog/static/templeImages';

        if($img1){
            $article->img1='static/templeImages/'.TemplesController::convertImage($img1,$path);
        }else{
            $article->img1='';
        }

        if($img2){
            $article->img2='static/templeImages/'.TemplesController::convertImage($img2,$path);
        }else{
            $article->img2='';
        }

        if($img3){
            $article->img3='static/templeImages/'.TemplesController::convertImage($img3,$path);
        }else{
            $article->img3='';
        }

        if($img4){
            $article->img4='static/templeImages/'.TemplesController::convertImage($img4,$path);
        }else{
            $article->img4='';
        }


        $article->save();

        return response()->json(['message'=>"added"],201);
    }


    public function upArticle($id,Request $request){
        $article = articles::find($id);

        $article->article_title = $request->input('article_title');
        $article->article_content = $request->input('article_content');

        $img1 = $request->input('img1');
        $img2 = $request->input('img2');
        $img3 = $request->input('img3');
        $img4 = $request->input('img4');

        $path = 'H:/Vue Js/blog/static/templeImages';

        if($img1){

            if(strpos($img1,'base64')!==false){
                $article->img1='static/templeImages/'.TemplesController::convertImage($img1,$path);
            }else{
                $article->img1 =$img1;
            }
        }else{
            $article->img1='';
        }

        if($img2){
            if(strpos($img2,'base64')!==false) {
                $article->img2 = 'static/templeImages/' . TemplesController::convertImage($img2,$path);
            }else{
                $article->img2 =$img2;
            }
        }else{
            $article->img2='';
        }

        if($img3){
            if(strpos($img3,'base64')!==false) {
                $article->img3 = 'static/templeImages/' . TemplesController::convertImage($img3,$path);
            }else{
                $article->img3 =$img3;
            }
        }else{
            $article->img3='';
        }

        if($img4){
            if(strpos($img4,'base64')!==false) {
                $article->img4 = 'static/templeImages/' . TemplesController::convertImage($img4,$path);
            }else{
                $article->img4 =$img4;
            }
        }else{
            $article->img4='';
        }

        $article->save();

        return response()->json(['message'=>"added"],201);
    }



}
