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
        <h2>Card Title</h2>
        <p>This is a card description. It can contain text, images, or any other HTML elements.</p>
        <button class="btn">Click Me</button>
        <ul>
        @foreach($categories as $category)
        <li><a href="{{ route('showBooksByCategory', ['category' => $category]) }}">{{ $category }}</a></li>
    @endforeach
        </ul>
    </div>
</div>


   
</body>
</html>