<?php

namespace App\Http\Controllers;

use App\site_details;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SiteDetailsController extends Controller
{


    public function getSiteDetails(){
        $siteDetails = site_details::find(1);
        return response()->json(['details'=>$siteDetails],200);
    }

    public function addDetails(Request $request){
        $details = site_details::find(1);

        $details->tp_number = $request->input('tp_number');
        $details->address = $request->input('address');
        $details->email = $request->input('email');
        $details->facebook = $request->input('facebook');
        $details->twitter = $request->input('twitter');
        $details->youtube = $request->input('youtube');
        $details->instagram = $request->input('instagram');
        $details->description = $request->input('description');
        $details->save();

        return response()->json(['addDetails'=>"added"],200);

    }
}
