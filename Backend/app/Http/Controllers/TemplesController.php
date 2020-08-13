<?php

namespace App\Http\Controllers;
use App\Temples;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TemplesController extends Controller
{


    public function addTemple(Request $request){
        $temple = new Temples();

        $temple->temple_name = $request->input('temname');
        $temple->temple_location = $request->input('loca');
        $temple->temple_address = $request->input('addr');
        $temple->temple_destrict = $request->input('district');
        $temple->temple_des = $request->input('dis');

        $img1 = $request->input('img1');
        $img2 = $request->input('img2');
        $img3 = $request->input('img3');
        $img4 = $request->input('img4');
        $img5 = $request->input('img5');

        $path = 'H:/Vue Js/blog/static/templeImages';

        if($img1){
            $temple->img1='static/templeImages/'.$this->convertImage($img1,$path);
        }else{
            $temple->img1='';
        }

        if($img2){
            $temple->img2='static/templeImages/'.$this->convertImage($img2,$path);
        }else{
            $temple->img2='';
        }

        if($img3){
            $temple->img3='static/templeImages/'.$this->convertImage($img3,$path);
        }else{
            $temple->img3='';
        }

        if($img4){
            $temple->img4='static/templeImages/'.$this->convertImage($img4,$path);
        }else{
            $temple->img4='';
        }

        if($img5){
            $temple->img5='static/templeImages/'.$this->convertImage($img5,$path);
        }else{
            $temple->img5='';
        }

        $temple->save();

        return response()->json(['message'=>"added"],201);

    }

    public function upTemples($id,Request $request){
        $temple = Temples::find($id);

        $temple->temple_name = $request->input('temple_name');
        $temple->temple_location = $request->input('temple_location');
        $temple->temple_address = $request->input('temple_address');
        $temple->temple_destrict = $request->input('temple_destrict');
        $temple->temple_des = $request->input('temple_des');

        $img1 = $request->input('img1');
        $img2 = $request->input('img2');
        $img3 = $request->input('img3');
        $img4 = $request->input('img4');
        $img5 = $request->input('img5');

        $path = 'H:/Vue Js/blog/static/templeImages';

        if($img1){

            if(strpos($img1,'base64')!==false){
                $temple->img1='static/templeImages/'.$this->convertImage($img1,$path);
            }else{
                $temple->img1 =$img1;
            }
        }else{
            $temple->img1='';
        }

        if($img2){
            if(strpos($img2,'base64')!==false) {
                $temple->img2 = 'static/templeImages/' . $this->convertImage($img2,$path);
            }else{
                $temple->img2 =$img2;
            }
        }else{
            $temple->img2='';
        }

        if($img3){
            if(strpos($img3,'base64')!==false) {
                $temple->img3 = 'static/templeImages/' . $this->convertImage($img3,$path);
            }else{
                $temple->img3 =$img3;
            }
        }else{
            $temple->img3='';
        }

        if($img4){
            if(strpos($img4,'base64')!==false) {
                $temple->img4 = 'static/templeImages/' . $this->convertImage($img4,$path);
            }else{
                $temple->img4 =$img4;
            }
        }else{
            $temple->img4='';
        }

        if($img5){
            if(strpos($img5,'base64')!==false) {
                $temple->img5 = 'static/templeImages/' . $this->convertImage($img5,$path);
            }else{
                $temple->img5 =$img5;
            }
        }else{
            $temple->img5='';
        }

        $temple->save();

        return response()->json(['message'=>"added"],201);

    }

    public function getTemples(){
        $temples = DB::table('temples')->orderBy('id','desc')->get();
        return response()->json(['temples'=>$temples],200);
    }

    public function getTemplesByID($id){
        $temple = Temples::find($id);
        return response()->json(['temple'=>$temple],200);

    }

    public function getTemplesbyLoc($location){
        $temples = DB::table('temples')->where('temple_destrict','=',$location)->orderBy('id','desc')->get();
        $response = [
            'temple' => $temples
        ];

        return response()->json($response,200);
    }

    public function deleteTemple($id){
        $temple = Temples::find($id);

        if(!$temple){
            return response()->json(['message'=>"temple not found"],404);
        }

        $temple->delete();
        return response()->json(['message'=>"deleted"],201);
    }

     public static function convertImage($img,$path){
        $fre_img = explode(',',$img);

        $decode = base64_decode($fre_img[1]);
        if(str_contains($fre_img[0],'png')){
            $exte = 'png';
        }elseif (str_contains($fre_img[0],'gif')){
            $exte = 'gif';
        }
        elseif (str_contains($fre_img[0],'jpeg')){
            $exte = 'jpeg';
        }else{
            $exte = 'jpg';
        }

        $rand = substr(md5(microtime()),rand(0,26),5);

        $currentTime = Carbon::now()->timestamp;
        $filename = $currentTime.'.'.$exte;


        $filepath = $path.'/'.$rand.$filename;

        $returnName = $rand.$filename;

        file_put_contents($filepath,$decode);
        return $returnName;
    }
}
