<?php


namespace App\Http\Controllers;
use App\articles;
use App\main;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TemplesController;


class MainPageController extends Controller
{

    public function getMainPage(){
        $mainPage = main::find(1);
        return response()->json(['mainPage'=>$mainPage],200);
    }

    public function getArticles($id){
        return articles::find($id);
    }

    public function upMainPage(Request $request){
        $mainPage = main::find(1);

        $mainPage->art1 = $request->input('art1');
        $mainPage->art2 = $request->input('art2');
        $mainPage->art3 = $request->input('art3');
        $mainPage->art4 = $request->input('art4');

        $img1 = $request->input('img1');
        $img2 = $request->input('img2');
        $img3 = $request->input('img3');
        $img4 = $request->input('img4');
        $img5 = $request->input('img5');

        $path = 'H:/Vue Js/blog/static/mainPageImages';

        if($img1){

            if(strpos($img1,'base64')!==false){
                $mainPage->img1='static/mainPageImages/'.TemplesController::convertImage($img1,$path);
            }else{
                $mainPage->img1 =$img1;
            }
        }else{
            $mainPage->img1='';
        }

        if($img2){
            if(strpos($img2,'base64')!==false) {
                $mainPage->img2 = 'static/mainPageImages/' . TemplesController::convertImage($img2,$path);
            }else{
                $mainPage->img2 =$img2;
            }
        }else{
            $mainPage->img2='';
        }

        if($img3){
            if(strpos($img3,'base64')!==false) {
                $mainPage->img3 = 'static/mainPageImages/' . TemplesController::convertImage($img3,$path);
            }else{
                $mainPage->img3 =$img3;
            }
        }else{
            $mainPage->img3='';
        }

        if($img4){
            if(strpos($img4,'base64')!==false) {
                $mainPage->img4 = 'static/mainPageImages/' . TemplesController::convertImage($img4,$path);
            }else{
                $mainPage->img4 =$img4;
            }
        }else{
            $mainPage->img4='';
        }

        if($img5){
            if(strpos($img5,'base64')!==false) {
                $mainPage->img5 = 'static/mainPageImages/' . TemplesController::convertImage($img5,$path);
            }else{
                $mainPage->img5 =$img5;
            }
        }else{
            $mainPage->img5='';
        }

        $mainPage->save();
        return response()->json(['message'=>"added"],201);
    }

    public function getPopularArticles(){
        $Articles = main::find(1);

        $art1 = $Articles->art1;
        $art2 = $Articles->art2;
        $art3 = $Articles->art3;
        $art4 = $Articles->art4;


        $article1 = null;
        $article2 = null;
        $article3 = null;
        $article4 = null;

        if($art1>0){
            $article1 = $this->getArticles($art1);
        }

        if($art2>0){
            $article2 = $this->getArticles($art2);
        }

        if($art3>0){
            $article3 = $this->getArticles($art3);
        }

        if($art4>0){
            $article4 = $this->getArticles($art4);
        }

        return response()->json(['articles1'=>$article1,'articles2'=>$article2,
            'articles3'=>$article3,'articles4'=>$article4 ],200);
    }

}
