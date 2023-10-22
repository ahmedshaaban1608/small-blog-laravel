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
  <title>All Users</title>
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
  <a href="{{route('users.create')}}" class="btn btn-success mb-4">Create new User</a>
  <div class="container">
    <div class="table-responsive">
    


    <table class="table table-striped">
 
<thead>
  <th>id</th>
  <th>name</th>
  <th>email</th>
  <th>role</th>
  <th>no. posts</th>
  <th>Actions</th>
</thead>
      @foreach($data as $user)
<tr>
  <td>{{$user['id']}}</td>
  <td>{{$user['name']}}</td>
  <td>{{$user['email']}}</td>
  <td>{{$user['role']}}</td>
  <td>{{$user-> posts()->total()}}</td>
  <td class="d-flex">
    <a href="{{route('users.show',$user)}}" class="btn btn-warning me-2">Show</a>
    @if(\Gate::allows('is_admin'))
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setDeleteUrl('{{ route('users.destroy', $user['id']) }}')">   Delete
    </button>

    @endif
  </td>
</tr>
      @endforeach
      </table>
      <script>
        function setDeleteUrl(url) {
        
            // Set the action URL for the delete form
            document.getElementById('deleteForm').action = url;
        }
    </script>
      <div class="modal" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form action="asdasd" id="deleteForm" method="post">
          @method('DELETE')
          @csrf
        <input type="submit"class="btn btn-primary" value="Delete">

        </form>
      </div>
    </div>
  </div>
</div>
    </div>
    <div>
      {{$data}}
    </div>
  </div>
</div>
</body>
</html>
@endsection
