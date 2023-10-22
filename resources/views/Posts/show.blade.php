@extends('layouts.app')
@section('title')
{{$post['title']}}
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$post['title']}}</title>
  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mb-5">
  <div class="m-auto position-relative" style="max-width: 700px; max-height: 500px; overflow: hidden;">
  @if (Str::startsWith($post['image'], 'https'))
            <img src="{{$post['image']}}" class="card-img-top" alt="{{$post['title']}}" style="height:200px; object-fit: cover">
            @else
              <img src="{{asset('img/'.$post['image'])}}" class="card-img-top" alt="{{$post['title']}}" style="height:200px; object-fit: cover">
              @endif
  </div>
</div>

<div class="modal" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form action="{{route('posts.destroy', $post['id'])}}" method="post">
          @method('delete')
          @csrf
        <input type="submit"class="btn btn-primary" value="Delete">

        </form>
      </div>
    </div>
  </div>
</div>

<div class="container mb-5 px-lg-5">
  <small class="me-3">Created at: {{$post['created_at']}}</small> 
  @if(\Gate::allows('is_admin') || \Auth::id() === $post['user_id'])
  <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-success me-3">Edit</a>
  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Delete
  </button>
  @endif
  <div class="my-5">
    {{$post['body']}}
  </div>
  <div class="d-flex">
    @if($post -> category)
  <div class="me-3">  Categories:   <a href="{{route('categories.show', $post -> category['id'])}}" class="badge bg-danger mt-2 me-2 text-decoration-none py-2 px-3 text-white">{{$post -> category['name']}}</a></div>
  @endif
  <div class="me-3">  Created by:   <a href="{{route('users.show', $post -> user['id'])}}" class="badge bg-danger mt-2 me-2 text-decoration-none py-2 px-3 text-white">{{$post -> user['name']}}</a></div>
  </div>
</div>

<!-- Add Bootstrap JS and Popper.js script links -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

</body>
</html>
@endsection
