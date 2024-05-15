<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>signup</title>
    <link rel="stylesheet" href="{{ asset('CSS/register.css') }}"> {{--<!-- Assuming your CSS file is in a folder named 'css' --> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="form-search">
        <form action="#" method="post">
          <input type="text" placeholder="Search..." name="name">
          <a href="#" id="searchButton"><i class="fa fa-search"></i></a>
          <button type="submit" name=login>Login</button>
          <button type="submit" name="signup" >Signup</button>
        </form>
      </div>
</div>
 <div class="topnav">
   <a class="active" href="#home">HOME</a>
    <a href="#news">BOOKS</a>
     <a href="#contact">CATEGORIES</a>
     <a href="#about">RESERVE BOOK</a>
     <a href="#log in">LOG IN</a>
     <a href="#about">REGISTER</a>
</div>
    <div id="signup-container">
        <form method="post" action="#" name=session value=register>
            @csrf 
            <h1>Register</h1>
            <h4>Get started!</h4>
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
            <button type="submit" name="signup" id="signup-button">Signup</button>

            {{-- <div> Already have an account? <a href="login" id="signup"><b style="color: red;">login</b></a></div> --}}
        </form>
    </form>
    <div class="buttomnav">
    <a href>Home</a>
    <a href>Privacy Policy</a>
    <a href>Contact Us</a>
    <a href>About Us</a>
    </div>
</body>
</html>