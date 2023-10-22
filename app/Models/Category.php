<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $fillable = ['name', 'slug', 'image'];

    function posts(){
        return $this->hasMany(Post::class)->paginate(9);
    }
}
