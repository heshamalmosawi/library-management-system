
<link rel="stylesheet" href="{{ asset('css/header.css') }}"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
   
<div class="form-search">
    <form action="{{ route('search') }}" method="GET">
        <img src="/images/logo.png"  id="logo"alt="" >
        <div class="editbtn">
            <input type="search" placeholder="Search..." name="name">
            <button type="submit" class="btn1">Search</button>
            @if(Auth::User())
            <a href="/profile"><button type="button" id="btn2">{{session('name')}}</button></a> 
             @endif
        </div>
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
        <a class="{{ request()->is('addbook') ? 'active' : '' }}" href="/addbook">ADD BOOK</a>
    @endif
    @if(session('is_admin'))
    <a class="{{ request()->is('addstaff') ? 'active' : '' }}" href="/addstaff">ADD STAFF</a>
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
