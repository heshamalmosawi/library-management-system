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
<body>
    @include('header')
<section class="home" id="home">
<div class="row">
<div class="content">

<h3>up to 55% offers</h3>
<p>Lorem ipsum dolor sit, amet consectetur 
    adipisicing elit. Aliquam harum tempore 
    voluptates dolor placeat possimus labore
     voluptate repudiandae dignissimos rem 
    inventore eveniet molestias numquam, 
    magni culpa fuga ad dolorum nobis?</p>
    <a href="/books" class="btn">Shop Now</a>
</div>

<div class="swiper books">
<div class="swiper-wrapper">
<a href="/books" class="swiper-slide"><img src="/images/book-1.jpg" alt="" ></a>
</div>
<img class="stand" src="">

</div>
</div>
</section>

    @include('footer')
</body>

</html>