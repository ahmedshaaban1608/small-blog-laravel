<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    function __construct(){
        $this->middleware("auth")->except(["index", "show"]);
    }
    public function index(){
        $data = Post::paginate(9);
        return view('Posts.posts', ['posts'=> $data]);
    }
    public function show(Post $post){
        return view('Posts.show', ['post'=> $post]);
    }
    public function create(){
        $category = Category::all();
        return view('Posts.create', ['data' => $category]);
    }
    public function edit(Post $post){
        if(Gate::allows('is_admin') || Auth::id() === $post['user_id']){
        $category = Category::all();
        return view('Posts.edit', ['post'=> $post, 'data'=>$category]);
    }
    return abort(403, 'you are not allowed to update the content');
    }
    public function destroy(Post $post){
        if(Gate::allows('is_admin') || Auth::id() === $post['user_id']){
        $post->delete();
        try {
            unlink(public_path('img/' . $post->image));
        } catch (\Throwable $th) {
            //throw $th;
        }
        return to_route('posts.index');
    }
    return abort(403, 'you are not allowed to delete the content');
    }
    public function store(StorePostRequest $request){
        $data = request()->all();
        $file= $data['image'];
        $filename= time().$file->getClientOriginalName();
        $file-> move(public_path('img'), $filename);
        $data['slug'] = Str::slug($data['title']);
        $data['image'] = $filename;
        $data['user_id'] = Auth::id();
      Post::create($data);
        return to_route('posts.index');
    }
    public function update(UpdatePostRequest $request,Post $post){
        if(Gate::allows('is_admin') || Auth::id() === $post['user_id']){
        $data = request()->all();
        if(isset($data['image'])){
        $file= $data['image'];
        $filename= time().$file->getClientOriginalName();
        $file-> move(public_path('img'), $filename);
        $data['image'] = $filename;
        }
        $data['slug'] = Str::slug($data['title']);
        $post->update($data);
        return to_route('posts.show', $post);
    }
    return abort(403, 'you are not allowed to update the content');
}
}
