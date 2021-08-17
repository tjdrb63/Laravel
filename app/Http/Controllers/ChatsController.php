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
        $post_id = 39;


         $chat = new Chat();
         $chat -> user_id = Auth::user()->id;
         $chat -> post_id = $post_id;
         $chat -> comment = $comment;
         $chat -> save();

        return redirect('/posts/show/39');

    }
}
