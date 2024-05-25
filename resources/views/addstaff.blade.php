<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>add staff</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"> {{--<!-- Assuming your CSS file is in a folder named 'css' --> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>
<body>
 
    @include('header')
    @if (!session('is_admin'))
    <script>
    alert('Restriced page! Only library admin can add staff!')
    window.location = "/login";</script>    
    @endif
    <div id="signup-container">
        <form method="post" action="#" name=session value=register>
            @csrf 
            <h1>Add staff</h1>
            <input type="text" placeholder="Name" name="name" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <input type="text" placeholder="Email" name="email" required>
            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <input type="password" placeholder="Password" name="password" required>
            @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <input type="text" placeholder="Phone number" name="phone" required>
            @error('phone')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <button type="submit" name="signup" id="signup-button">Add</button>

        </form>
    </form>
    @include('footer')
</body>