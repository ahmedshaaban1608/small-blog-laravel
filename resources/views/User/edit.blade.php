@extends('layouts.app')

@section('title')
update category
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>updatecategory
</title>
</head>
<body>


<div class="container">
<form action = "{{route('categories.update', $data)}}" method="post" enctype="multipart/form-data">
  @method('put')
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">category name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name', $data['name'])}}">
    @error('name')
{{$message}}
    @enderror
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">image</label>
    <div class="mb-3">
    <label for="image" class="form-label">Current Image:</label>
    <img src="{{ asset('img/' . $data['image']) }}" alt="Current Image" class="img-thumbnail" name="currentImage" width="100">
</div>

<div class="mb-3">
    <label for="image" class="form-label">Upload New Image:</label>
    <input type="file" class="form-control" id="image" name="image">
</div>  </div>
@error('image')
{{$message}}
    @enderror
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>
@endsection