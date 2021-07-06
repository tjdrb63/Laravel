<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    // create , store , edit , update , destroy , show , index
    public function __construct()
    {
        $this -> middleware(['auth'])->except(['index','show']); // this 안의 모든 라우터는 middleware 적용시킴

    }

    public function edit($id){
        //수정 폼 생성

        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);
    }

    public function update(Request $request, $id){
        // 실제로 수정 업데이트 하는 공간
        // 이미지 파일 수정
        $request -> validate([
            'title' => 'required|min:2',
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);
        $post = Post::findOrFail($id);


        if($request -> file('imageFile')){
            $imagePath = 'public/images/'.$post -> image;
            Storage::delete($imagePath);
            $request -> file('imageFile'); // 업로드 객체
            $post -> image = $this -> uploadPostImage($request);
        }
        $post -> title = $request ->title;
        $post -> content = $request -> content;
        $post -> save();

        return redirect()->route('post.show',['id'=>$id]);
    }

    public function destroy($id){
        //파일 시스템에서 이미지 삭제
        //게시판 삭제
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
            'title' => 'required|min:2',
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);

        $post = new Post();
        $post -> title = $title;
        $post -> content = $content;
        $post -> user_id = Auth::user()->id;

        if($request -> File('imageFile')){
           $post -> image = $this -> uploadPostImage($request);
        }

        $post -> save();

        return redirect('/posts/index');
    }

    private function uploadPostImage($request){
        $name = $request-> file('imageFile')->getClientOriginalName();  //원본 파일 이름 가져오기
        $extension = $request->file('imageFile') -> extension(); // 확장자 이름 가져오기
        $nameWidthoutExtension = Str::of($name)->basename('.'.$extension); // 이름 .jpg 없앰
        $filename = $nameWidthoutExtension.'_'.time().'.'.$extension; // 파일이름 변환
        $request -> file('imageFile')->storeAs('public/images',$filename); //이미지 파일을 images폴더의 filename으로 저장
        return $filename;
    }
}
