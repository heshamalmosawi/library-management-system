<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> {{--<!-- Assuming your CSS file is in a folder named 'css' --> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    @include('header')
     <div class=form-container1> 
        <div class=form-container id='login-container'>
            <form action="#" method=post>
                @csrf
                <h1>Login</h1>
                <h4>Log in to access your Books</h4>
                <input type="text" placeholder='example@email.com' name=email required>
                <input type="password" placeholder=Password name=password required>
                {{-- @error('password')
                    {{error}} 
                @enderror --}}
                <button type="submit" name=login>Login</button>
                <div> Don't have an account? <a href="/register"><b style="color: red;">sign up</b></a></div>        
            </form>
        </div>
    </div>
    
    @include('footer')

    </body>
</html>