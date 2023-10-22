<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('Landing.home')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('posts.index')}}">posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('categories.index')}}">Categories</a>
        </li>
    
        
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid bg-primary py-5 mb-5 text-center">
  <h1 class="text-white">@yield('title')</h1>
  
</div>
@yield('content')
</body>
