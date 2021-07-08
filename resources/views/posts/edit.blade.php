
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
        <h1>게시판 입력</h1>
        <form action='{{ Route('post.update',['id' => $post -> id,'page' => $page]) }}' method="POST" enctype="multipart/form-data">
            @csrf
            @method("put")

            {{-- method spoofing --}}
            {{-- <input type="hidden" name="_method" value="put"> --}}
            <div class="form-group">
                <label for="exampleInputEmail1" class="breadcrumb" style="margin-bottom:3px;font-size:20px">제목</label>
                <input type="text" class="form-control" name="title" placeholder="제목 입력" value="{{ old('title') ? old('title') :$post -> title}}">
                {{ $errors -> first('title') }}
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="breadcrumb" style="margin-bottom:3px;font-size:20px">게시글 내용</label>
                <textarea name="content" class="form-control" cols="30" rows="10" >{{ old('content') ? old('content') : $post -> content }}</textarea>
                {{ $errors -> first('content') }}
            </div>
            <div class="form-group">
                <img class="img-thumbnail" width ="20%" src="{{$post -> imagePath()}}">
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input name="imageFile" id="file", type="file">
                @error('imgfile')
                    <div>{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary" style="float: right">수정</button>
            </div>
        </form>



    </div>
</body>
</html>

