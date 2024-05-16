@php
    // use \Illuminate\Support\Facades\Session;
    // echo Session::get('email')
@endphp
<!DOCTYPE html>
<html lang="en">
<header style="background-color:blue; :100%;">
    @include('header')
    <h1> hello {{ Session::get('name')}}</h1>
    @include('footer')
</header>
</html>