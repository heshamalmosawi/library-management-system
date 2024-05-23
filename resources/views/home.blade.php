@php
    // use \Illuminate\Support\Facades\Session;
    // echo Session::get('email')
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="{{ asset('css/home.css') }}"> 
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    </head>
<body>
    
    @include('header')
    <div class="container">
        


<div class="content">
<div class="jon">
<h1>Welcome</h1>
<p> Dive into a world of books with our curated selection of bestsellers,<br>
     classics, and hidden gems. Join our community, share your thoughts, <br>
     and find your next great read. Happy reading!<br>
     Discover your next favorite book here. Happy reading!</p>
    <a href="/books" class="btn">Shop Now</a>
</div>  
    <a href="/books" ><img src="/images/book-1.jpg" alt="" ></a>
    
</div>







</div>
    @include('footer')
</body>

</html>