<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware("auth:sanctum")->except(["index", "show"]);
    }
    public function index()
    {
        return new PostResource(Post::all());
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required','max:255',Rule::unique('posts')],
            'body' => 'required|min:50',
            'version' => 'required',
            'image' => 'required',
            'category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
       try {
        $data = $request->all(); 
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = Auth::id();
        $created = $post->create($data);
        return new PostResource($created);
       } catch (\Throwable $th) {
        return ['error' => 'Failed to create the post.'];
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required','max:255',Rule::unique('posts')->ignore($post)],
            'body' => 'required|min:50',
            'version' => 'required',
            'image' => 'required',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $data = request()->all();
            $post->update($data);
            $updated = Post::find($post->id); 
            return new PostResource($updated);

        } catch (\Throwable $th) {
            return ['error' => 'Failed to update the post.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)

    {
    try {
        $id = $post->id;
        $post->delete();
        return (['message' => "Post with id = $id was deleted successfully"]);
    } catch (\Exception $e) {
        return ['error' => 'Failed to delete the post.'];
    }
    }
}
