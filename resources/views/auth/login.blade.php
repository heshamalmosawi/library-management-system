<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup</title>
    <link rel="stylesheet" href="{{ asset('CSS/login.css') }}"> {{--<!-- Assuming your CSS file is in a folder named 'css' --> --}}
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

   
     <div class=form-container1> 
        <div class=form-container id='login-container'>
            <form action="#" method=post>
            <h1>Login</h1>
    <h4>Log in to access your Books</h4>
                <input type="text" placeholder=name name=name required>
                <input type="password" placeholder=Password name=password required>
                <button type="submit" name=login>Login</button>
                <div> Don't have an account? <a href="/register" id="signup"><b style="color: red;">sign up</b></a></div>
                
            </form>
            <div class="buttomnav">
            <a href>Home</a>
            <a href>Privacy Policy</a>
            <a href>Contact Us</a>
            <a href>About Us</a>
            
            
        </div>
        </div>
        </body>
</html>