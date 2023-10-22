@extends('layouts.app')

@section('title')
edit post
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit post
</title>
</head>
<body>
<div class="container">
<form action = "{{route('posts.update', $post['id'])}}" method="post" enctype="multipart/form-data" class="mb-5">
  @method('put')
  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Post title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{old('title',$post['title'])}}">
    @error('title')
{{$message}}
    @enderror
  </div>
  <div class="mb-3">
  <label for="category" class="form-label">Post Category</label>

  <select class="form-select" aria-label="Default select example" name="category_id" id="category">
    <option selected disabled>Select a category</option>
    @foreach($data as $cat)
    <option value="{{$cat['id']}}" {{ $cat['id'] == old('category_id', $post['category_id']) ? 'selected' : '' }}>{{$cat['name']}}</option>
    @endforeach
</select>

  @error('category_id')
  {{$message}}
  @enderror
</div>
  <div class="mb-3">
    <label for="image" class="form-label">image</label>
    <div class="mb-3">
    <label for="image" class="form-label">Current Image:</label>
   
    @if (Str::startsWith($post['image'], 'https'))
    <img src="{{$post['image']}}" alt="Current Image" class="img-thumbnail" name="currentImage" width="100">
            @else
            <img src="{{ asset('img/' . $post['image']) }}" alt="Current Image" class="img-thumbnail" name="currentImage" width="100">
              @endif
</div>

<div class="mb-3">
    <label for="image" class="form-label">Upload New Image:</label>
    <input type="file" class="form-control" id="image" name="image">
    @error('image')
{{$message}}
    @enderror
</div>  </div>
  <div class="mb-3">
    <label for="version" class="form-label">Post version</label>
    <input type="number" class="form-control" min="1" value="1" id="version" name="version" value="{{old('version',$post['version'])}}">
    @error('version')
{{$message}}
    @enderror
  </div>
  
  <div class="mb-3">
    <label for="body" class="form-label">Post Body</label>
    <textarea class="form-control" id="body" name="body" rows="5">{{old('body',$post['body'])}}</textarea>@error('body')
{{$message}}
    @enderror
  </div>
  <button type="submit" class="btn btn-primary ">Submit</button>
</form>
</div>
</body>
</html>
@endsection