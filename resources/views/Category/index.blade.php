@extends('layouts.app')
@section('title')
All Categories
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All categories</title>
  <style>
    .post-description {
        display: -webkit-box;
        overflow: hidden;
        -webkit-line-clamp: 3; /* Limit to three lines */
        -webkit-box-orient: vertical;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px; /* Adjust the margin as needed */
    }

  </style>
</head>
<body>
<div class="container mb-5">
  <a href="{{route('categories.create')}}" class="btn btn-success mb-4">Create new Category</a>
  <div class="container">
    <div class="row g-4">
      @foreach($data as $category)
        <div class="col-md-4 col-lg-3">
          <a href="{{route('categories.show',$category)}}" class="text-decoration-none">
            <div class="card h-100">
           
              @if (Str::startsWith($category['image'], 'https'))
              <img src="{{$category['image']}}" class="card-img-top" alt="{{$category['name']}}" style="height:150px; object-fit: cover">
            @else
            <img src="{{asset('img/'.$category['image'])}}" class="card-img-top" alt="{{$category['name']}}" style="height:150px; object-fit: cover">
              @endif
              <div class="card-body">
                <h5 class="card-title">{{$category['name']}}</h5>
              </div>
              <div class="card-footer">
                <small class="text-muted">{{$category['created_at']}}</small>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
    <div>
      {{$data->links() }}
    </div>
  </div>
</div>
</body>
</html>
@endsection
