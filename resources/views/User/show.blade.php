@extends('layouts.app')
@section('title')

{{$data['name']}}
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> {{$data['name']}} </title>
  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <style>
    .pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px; /* Adjust the margin as needed */
}
.post-description {
        display: -webkit-box;
        overflow: hidden;
        -webkit-line-clamp: 3; /* Limit to three lines */
        -webkit-box-orient: vertical;
    }
  </style>
</head>
<body>
<div class="container mb-5 table-responsive">
  <table class="table table-dark table-striped">
    <tr>
      <th>ID</th>
      <td>{{$data['id']}}</td>
    </tr>
    <tr>
      <th>Name</th>
      <td>{{$data['name']}}</td>
    </tr>
    <tr>
      <th>Email</th>
      <td>{{$data['email']}}</td>
    </tr>
    <tr>
      <th>Role</th>
      <td>{{$data['role']}}</td>
    </tr>
    <tr>
      <th>Number of posts</th>
      <td>{{$data->posts()->total()}}</td>
    </tr>
   
  </table>
</div>

<div class="container mb-5">
  <h2 class="text-center mb-5">All Posts by {{$data['name']}}</h2>
  <div class="row g-4">
@foreach($data -> posts() as $post)
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
      {{ $data->posts()->links() }}

      </div>
<!-- Add Bootstrap JS and Popper.js script links -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

</body>
</html>
@endsection
