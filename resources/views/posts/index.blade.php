<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <a href="{{  route('dashboard') }}">대쉬보드로 이동</a>
        <h1>게시글 리스트</h1>
        <ul class="list-group">
            {{-- posts 컬렉션 --}}
            @auth
            <button  class="btn btn-primary" onclick="location.href = '{{ route('posts.create')}}'">게시글 작성</button>

            @endauth
            @foreach ($posts as $post)
                <div class="list-group-item">
                    <span>
                       <div class="badge badge-secondary"> 제목 </div><a href="{{
                                        route('post.show',
                                         ['id' => $post -> id,
                                          'page' => $posts->currentPage()] // 현재 페이지
                                    )}}">
                                {{-- "post/show".{{ $post->id }},"?page=".{{ $post->currentPage() }} --}}
                             {{ $post -> title}}
                        </a>
                    </span>
                    <div>
                    <div class="badge badge-secondary">내용</div>  {{ $post -> content }}
                    </div>
                    <br><div style="text-align: right"><span class="badge badge-secondary">작성일자</span> {{$post -> created_at -> diffForHumans()}}</div>
                </div>
            @endforeach
        </ul>
        <div style="height:100px">
            {{$posts->links("pagination::bootstrap-4")}}
        </div>
    </div>
</body>
</html>
