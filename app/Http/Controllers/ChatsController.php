<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function store(Request $request){
        $comment = $request -> comment;
        $user_id = Auth::user() -> id;
        $user_name = User::where('id',$user_id)->value('name');

        $chat = new Chat();
        $chat -> user_id = $user_id;
        $chat -> user_name = $user_name;
        $chat -> post_id = $request-> post_id;
        $chat -> comment = $comment;
        $chat -> save();

        $check = Chat::where('post_id',$request->post_id)->orderBy('id','desc')->first();

        return $check;

    }

    public function comment(Request $request,$post_id){
        $chats = Chat::where('post_id',$post_id)->orderBy('id','desc')->get();

        return $chats;
    }
}
