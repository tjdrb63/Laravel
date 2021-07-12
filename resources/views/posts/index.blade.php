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
        <nav class="navbar navbar-expand-lg navbar-light bg-primary mb-4 rounded">
            <a class="navbar-brand" href={{ route('posts.index') }}>HOME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="btn btn-primary btn-lg btn-block" href="{{ route('dashboard') }}">DashBoard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="btn btn-primary btn-lg btn-block" href="{{ route('posts.myindex') }}">내가 쓴글 <span class="sr-only">(current)</span></a>
                  </li>
              </ul>

              <form class="form-inline my-2 my-lg-0"  action={{ Route('posts.search') }}>
                <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search">
                <button class="btn btn-light" type="submit">Search</button>
              </form>
            </div>
          </nav>
        <ul class="list-group">

            {{-- posts 컬렉션 --}}
            @auth
            <button  class="btn btn-primary" onclick="location.href = '{{ route('posts.create')}}'">게시글 작성</button>

            @endauth
            @foreach ($posts as $post)
                <div class="list-group-item">
                    <span>
                       <div class="badge badge-secondary mb-2 "> 제목 </div>
                         <a href="{{route('post.show',['id' => $post -> id,'page' => $posts->currentPage()])}}">
                             {{ $post -> title}}
                        </a>
                    </span>
                <div>
                    <div class="badge badge-secondary mb-2 mr-1" style="float: left">내용</div>
                    <div style="float: left">{!! $post -> content !!}</div>
                </div>
                <br>
                <div style="text-align: right " class="">
                    <span class="badge badge-secondary">작성일자</span> {{$post -> created_at -> diffForHumans()}}<br>
                    <span class="badge badge-secondary mr-1">작성자</span>{{ $post-> user -> name }}<br>
                    <span class="badge badge-secondary mr-1">조회수</span>{{ $post-> count }}
                </div>
            </div>
            @endforeach
        </ul>
        <div style="height:100px">
            {{$posts->links("pagination::bootstrap-4")}}
        </div>
    </div>
</body>
</html>
