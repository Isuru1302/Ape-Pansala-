<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{

    public function getSearchResults($Word){
        $ArResults = DB::table('articles')->where('article_title','like','%'.$Word.'%')->orderBy('created_at','desc')->get();
        $TempResults = DB::table('temples')->where('temple_name','like','%'.$Word.'%')->orderBy('created_at','desc')->get();
        $results = $ArResults->merge($TempResults);

        $response = [
            'search' => $results
        ];
        return response()->json($response,200);
    }

}
