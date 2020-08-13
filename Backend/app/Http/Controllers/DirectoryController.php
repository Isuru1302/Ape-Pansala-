<?php


namespace App\Http\Controllers;
use App\directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectoryController extends Controller
{

    public function getAllDirectories(){
        $directory = DB::table('directories')->orderBy('id','ASC')->get();
        return response()->json(['directories'=>$directory],200);
    }

    public function addDirectory(Request $request){
        $directory = new directory();

        $directory->name = $request->input('name');
        $directory->telephone = $request->input('telephone');
        $directory->address = $request->input('address');
        $directory->category = $request->input('category');
        $directory->district = $request->input('district');

        $directory->save();
        return response()->json(['directories'=>"added"],200);
    }

    public function updateDirectory($id,Request $request){
        $directory = directory::find($id);

        $directory->name = $request->input('name');
        $directory->telephone = $request->input('telephone');
        $directory->address = $request->input('address');
        $directory->category = $request->input('category');
        $directory->district = $request->input('district');
        $directory->save();
        return response()->json(['directories'=>"updated"],200);
    }

    public function deleteDirectory($id){
        $directory = directory::find($id);
        if(!$directory){
            return response()->json(['directories'=>"directories not found"],404);
        }

        $directory->delete();
        return response()->json(['directories'=>"deleted"],201);
    }

    public function DirectoryById($id){
        $directory = directory::find($id);

        return response()->json(['directories'=>$directory],200);
    }

    public function searchDirectory($word){
        $results = DB::table('directories')->where('name','like','%'.$word.'%')
            ->orWhere('telephone','like','%'.$word.'%')
            ->orWhere('address','like','%'.$word.'%')
            ->orWhere('category','like','%'.$word.'%')
            ->orWhere('district','like','%'.$word.'%')
            ->orderBy('id','desc')->get();

        $response = [
            'search' => $results
        ];
        return response()->json($response,200);
    }

    public function searchDirectoryByCat($word)
    {
        $results = DB::table('directories')->Where('category','like','%'.$word.'%')
            ->orderBy('id','desc')->get();

        $response = [
            'search' => $results
        ];
        return response()->json($response,200);
    }

}
