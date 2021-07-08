<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $table = 'my_posts';  테이블 이름 변경가능
    use HasFactory;

    public function imagePath(){
        $path = '/storage/images/';
        $imageFile = $this -> image ?? 'no_image.jpg';
        return $path.$imageFile;
    }
    public function user(){
        return $this->belongsTo(User::class);

    }
}
