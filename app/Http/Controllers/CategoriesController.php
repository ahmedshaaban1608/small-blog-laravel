<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware("auth")->except(["index", "show"]);
    }
    public function index()
    {
        $data = Category::paginate(8);
        return view('Category.index', ['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = request()->all();
        $file= $data['image'];
        $filename= time().$file->getClientOriginalName();
        $file-> move(public_path('img'), $filename);
        $data['slug'] = Str::slug($data['name']);
        $data['image'] = $filename; 
        Category::create($data);
        return to_route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       

        return view('Category.show', ['data'=> $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       
        return view('Category.edit', ['data'=> $category]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $data = request()->all();
      
        if(isset($data['image'])){
        $file= $data['image'];
        $filename= time().$file->getClientOriginalName();
        $file-> move(public_path('img'), $filename);
        $data['image'] = $filename;

        } else {
            $data['image'] = $category['image'];
        }

        $category->update($data);
        return to_route('categories.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(Gate::allows('is_admin')){
        $category->delete();
        try {
            unlink(public_path('img/' . $category->image));
        } catch (\Throwable $th) {
            //throw $th;
        }
        return to_route('categories.index');
    }
    return abort(403, 'you are not allowed to delete the content');
    }
}
