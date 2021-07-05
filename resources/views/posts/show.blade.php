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
            <div class="form-group">
                <label for="exampleInputEmail1">제목</label>
                <input type="text" readonly class="form-control" name="title" placeholder="제목 입력" value="{{$post -> title}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">게시글 내용</label>
                <textarea readonly name="content" class="form-control" cols="30" rows="10" >{{ $post -> content }}</textarea>
                {{ $errors -> first('content') }}
            </div>
            <div class="fomr-group">
                <label for="imageFile">Post Image</label>
                <div class="w-10">
                    {{-- <img class="img-thumbnail"width="25%" src="/storage/images/{{$post -> image ?? 'no_image.jpg'}}"> --}}
                    <img class="img-thumbnail" width="25%" src="{{$post -> imagePath()}}">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">등록일</label>
                <input type="text" readonly class="form-control" name="title" placeholder="제목 입력" value="{{$post -> created_at}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">지난시간</label>
                <input type="text" readonly class="form-control" name="title" placeholder="제목 입력" value="{{$post -> created_at->diffForHumans()}}">
            </div>
             {{--이전 페이지 인덱스로 가기 --}}
            <button  class="btn btn-primary" onclick="location.href = '{{ route('posts.index',['page' => $currentPage])}}'">확인</button>

        </form>


    </div>

</body>
</html>
