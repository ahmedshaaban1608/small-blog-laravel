<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'body', 'version', 'image', 'category_id','user_id'];

    function category(){
        return $this->belongsTo(Category::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
}
