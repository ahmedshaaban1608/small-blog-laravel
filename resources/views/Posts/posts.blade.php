@extends('layouts.app')
@section('title')
All Posts
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All posts</title>
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
 
  <div class="container">
    <div class="row g-4">
      @foreach($posts as $post)
        <div class="col-md-6 col-lg-4">
         
            <div class="card h-100 position-relative">
            @if($post -> category)
              <div class="position-absolute top-0 end-0" style="top:10px, right:10px">
            <a href="{{route('categories.show', $post -> category['id'])}}" class="badge bg-danger mt-2 me-2 text-decoration-none py-2 px-3">{{$post -> category['name']}}</a>
            </div>
            @endif
            @if (Str::startsWith($post['image'], 'https'))
            <img src="{{$post['image']}}" class="card-img-top" alt="{{$post['title']}}" style="height:200px; object-fit: cover">
            @else
              <img src="{{asset('img/'.$post['image'])}}" class="card-img-top" alt="{{$post['title']}}" style="height:200px; object-fit: cover">
              @endif
              <a href="{{route('posts.show',$post)}}" class="text-decoration-none text-black">
              <div class="card-body">
                <h5 class="card-title">{{$post['title']}}</h5>
                <p class="card-text post-description">{{$post['body']}}</p>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <small class="text-muted">{{$post['created_at']}}</small>
                <small class="text-muted">By: <a href="{{route('users.show',$post->user)}}">{{$post->user['name']}}</a></small>
              </div>
              
            </div>
          </a>
        </div>
      @endforeach
    </div>
    <div>
      {{$posts->links() }}
    </div>
  </div>
</div>
</body>
</html>
@endsection
