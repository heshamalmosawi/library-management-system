<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category</title>
    <link rel="stylesheet" href="{{ asset('css/category.css') }}"> 
</head>
<body>
    @include('header')

<div class="container">
    <h1>Browse Category</h1>
    

    <div class="card">
        
        @foreach($categories as $category)
        <div class="category-card">
            <a href="{{ route('showBooksByCategory', ['category' => $category]) }}">{{ $category }}</a>
        </div>
    @endforeach
    
    
    </div>
</div>

@include('footer')
   
</body>
</html>