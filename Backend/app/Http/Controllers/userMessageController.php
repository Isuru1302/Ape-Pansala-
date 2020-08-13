<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Messages;
use Illuminate\Support\Facades\DB;

class userMessageController extends Controller
{

    public function newMessage(Request $request){
        $message = new Messages();

        $message->full_name = $request->input('full_name');
        $message->email = $request->input('user_email');
        $message->message = $request->input('user_message');
        $message->read_unread = 1;

        $message->save();

        return response()->json(['message'=>"sent"],201);
    }

    public function getMessages(){
        $messages = DB::table('messages')->orderBy('read_unread','desc')->orderBy('id','desc')->get();
        return response()->json(['messages'=>$messages],200);
    }

    public function deleteMessage($id){
        $message = Messages::find($id);

        if(!$message){
            return response()->json(['message'=>"temple not found"],404);
        }

        $message->delete();
        return response()->json(['message'=>"deleted"],201);
    }

    public function getMessagesByID($id){
        $message = Messages::find($id);
        return response()->json(['messages'=>$message],200);
    }

    public function readMessages($id){
        $message = Messages::find($id);
        $message->read_unread = 0;
        $message->save();
        return response()->json(['messages'=>"done"],200);
    }
}
