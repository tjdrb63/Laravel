<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // create , store , edit , update , destroy , show , index
    public function __construct()
    {
        $this -> middleware(['auth'])->except(['index','show']); // this 안의 모든 라우터는 middleware 적용시킴

    }
    public function show(Request $request,$id){
        $post = Post::find($id);
        $currentPage = $request -> page;
        return view('posts.show',compact('post','currentPage'));
    }
    public function index(){
        $posts = Post::latest()->paginate(5);
        //$posts -> withPath('posts/index');
        return view('posts.index',['posts'=>$posts]);
     //   return $posts;
    }
    public function create(){
        return view('posts.create');
    }
    public function store(Request $request){ //라라벨 서비스 컨테이너에서 값을 주입함
        // post
        // $request->input['title'];
        // $request->input['content'];
        $title = $request->title;
        $content = $request->content;
        $request -> validate([
            'title' => 'required|min:4',
            'content' => 'required'
        ]);

        $post = new Post();
        $post -> title = $title;
        $post -> content = $content;
        $post -> user_id = Auth::user()->id;
        $post -> save();
        // return view('./index');

        $post->save();
        return redirect('/posts/index');
    }

}
