@extends('layouts.app')

@section('title')
add new post
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>add new post
</title>
</head>
<body>
<div class="container mb-4">
<form action = "{{route('posts.store')}}" method="post" enctype="multipart/form-data">
  @method('post')
  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Post title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
    @error('title')
{{$message}}
    @enderror
  </div>
  <div class="mb-3">
  <label for="category" class="form-label">Post Category</label>

  <select class="form-select" aria-label="Default select example" name="category_id" id="category">
    <option selected disabled>Select a category</option>
    @foreach($data as $cat)
    <option value="{{$cat['id']}}" {{ $cat['id'] == old('category_id') ? 'selected' : '' }}>{{$cat['name']}}</option>
    @endforeach
</select>

  @error('category_id')
  {{$message}}
  @enderror
</div>
  <div class="my-3">
    <label for="image" class="form-label">image</label>
    <input type="file" class="form-control" id="image" name="image">
    @error('image')
{{$message}}
    @enderror
  </div>
  <div class="mb-3">
    <label for="version" class="form-label">Post version</label>
    <input type="number" class="form-control" min="1" value="1" id="version" name="version" value="{{old('version')}}">
    @error('version')
{{$message}}
    @enderror
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Post Body</label>
    <textarea class="form-control" id="body" name="body" rows="5">{{old('body')}}</textarea>
    @error('body')
{{$message}}
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>
@endsection