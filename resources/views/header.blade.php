
<link rel="stylesheet" href="{{ asset('css/header.css') }}"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="form-search">
    <form action="#" method="post">
        <a href="#" ><i class="fa fa-search"></i></a>
        <input type="text" placeholder="Search..." name="name">
        <button type="submit" name="signup" >Signup</button>
    </form>
</div>

<div class="topnav">
    <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">HOME</a>
    <a class="{{ request()->is('books') ? 'active' : '' }}" href="/books">BOOKS</a>
    <a class="{{ request()->is('categories') ? 'active' : '' }}" href="/category">CATEGORIES</a>
    <a class="{{ request()->is('reserve-book') ? 'active' : '' }}" href="#about">RESERVE BOOK</a>
    {{-- @if(request()) --}}
    <a class="{{ request()->is('login') ? 'active' : '' }}" href="/login">LOG IN</a>
    @auth
    <a href=/logout>LOG OUT</a>
    @else
        <a class="{{ request()->is('register') ? 'active' : '' }}" href="/register">REGISTER</a>
    @endauth


  </div>
