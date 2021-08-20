<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;

class ChatsController extends Controller
{
    public function store(Request $request){

        $comment = $request -> comment;
        $chat = new Chat();
        $chat -> user_id = Auth::user()->id;
        $chat -> post_id = $request-> post_id;
        $chat -> comment = $comment;
        $chat -> save();

        // return $request;

        // return redirect('/posts/show/'+$chat->post_id);
    }

    public function comment(Request $request,$post_id){
        $chats = Chat::where('post_id',$post_id)->get();

        return $chats;
    }
}
