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
                <p> Dive into a world of books.<br>Join our community, share your thoughts, <br>
                    and find your next great read.<br>
                    Discover your next favorite book here. <br>Happy reading!</p>
                    <a href="/books" class="btn">Read Now</a>
            </div>  
            <img class=homepic src="/images/book-1.jpg" alt="" >  
        </div>
    </div>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif
    @include('footer')
</body>

</html>