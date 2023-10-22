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
<div class="container mb-5">
  <div class="m-auto position-relative" style="max-width: 700px; max-height: 500px; overflow: hidden;">
  
    @if (Str::startsWith($data['image'], 'https'))
    <img src="{{$data['image']}}" alt="{{ $data['name'] }}" class="w-100 rounded-4 shadow" style="object-fit: cover;">
            @else
            <img src="{{ asset('img/' . $data['image']) }}" alt="{{ $data['name'] }}" class="w-100 rounded-4 shadow" style="object-fit: cover;">
              @endif
  </div>
</div>

<div class="modal" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form action="{{route('categories.destroy', $data['id'])}}" method="post">
          @method('delete')
          @csrf
        <input type="submit"class="btn btn-primary" value="Delete">

        </form>
      </div>
    </div>
  </div>
</div>

<div class="container mb-5 px-lg-5">
  <small class="me-3">Created at: {{$data['created_at']}}</small> 
  @if(\Gate::allows('is_admin') || \Auth::id())
  <a href="{{route('categories.edit',$data['id'])}}" class="btn btn-success me-3">Edit</a>
    @if(\Gate::allows('is_admin'))
  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Delete
  </button>
  @endif
  @endif
</div>

<div class="container mb-5">
  <h2 class="text-center mb-5">All Posts in {{$data['name']}} Category</h2>
  <div class="row g-4">
@foreach($data -> posts() as $post)
<div class="col-md-6 col-lg-4">
         
         <div class="card h-100 position-relative">
           <div class="position-absolute top-0 end-0" style="top:10px, right:10px">
         <a href="{{route('categories.show', $post -> category['id'])}}" class="badge bg-danger mt-2 me-2 text-decoration-none py-2 px-3">{{$post -> category['name']}}</a>
         </div>
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
