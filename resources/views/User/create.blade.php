@extends('layouts.app')

@section('title')
add new category
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>add new user
</title>
</head>
<body>


<div class="container">
<form action = "{{route('categories.store')}}" method="post" enctype="multipart/form-data">
  @method('post')
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">category name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
    @error('name')
{{$message}}
    @enderror
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">image</label>
    <input type="file" class="form-control" id="image" name="image">
    @error('image')
{{$message}}
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>
@endsection