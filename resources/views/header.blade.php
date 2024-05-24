
<link rel="stylesheet" href="{{ asset('css/header.css') }}"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
   
<div class="form-search">
    <form action="#" method="post">
        <img src="/images/logo.png"  id="logo"alt="" >
       
        <input type="search" placeholder="Search..." name="name">
       
        <button type="submit" name="signup" >Signup</button>
    </form>
</div>

<div class="topnav">
    <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">HOME</a>
    <a class="{{ request()->is('books') ? 'active' : '' }}" href="/books">BOOKS</a>
    <a class="{{ request()->is('category') ? 'active' : '' }}" href="/category">CATEGORIES</a>
    <a class="{{ request()->is('borrow') ? 'active' : '' }}" href="/borrow">BORROW BOOK</a>
    <a class="{{ request()->is('reserve') ? 'active' : '' }}" href="/reserve">RESERVE BOOK</a>
    @if(session('userType') == 'staff')
        <a class="{{ request()->is('returnbook') ? 'active' : '' }}" href="/returnbook">RETURN BOOK</a>
        <a class="{{ request()->is('allTransaction') ? 'active' : '' }}" href="/allTransaction">ALL TRANSACTION</a>
    @endif
    @auth
        <a class="{{ request()->is('profile') ? 'active' : '' }}" href="/profile">PROFILE</a>
        <a href=/logout>LOG OUT</a>
    @else
        <a class="{{ request()->is('login') ? 'active' : '' }}" href="/login">LOG IN</a>
        <a class="{{ request()->is('register') ? 'active' : '' }}" href="/register">REGISTER</a>
    @endauth

  </div>
