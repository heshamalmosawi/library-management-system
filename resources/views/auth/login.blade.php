<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Assuming your CSS file is in a folder named 'css' --> --}}
</head>
<body>
    {{-- <div class=form-container1> --}}
        <div class=form-container id='login-container'>
            <form action="#" method=post>
                @csrf
                <input type="text" placeholder=name name=name required>
                <input type="password" placeholder=Password name=password required>
                <button type="submit" name=login>Login</button>
                <div> Don't have an account? <a href="#" id="signup"><b style="color: red;">sign up</b></a></div>
            </form>
        </div>
        <div class="form-container" id="signup-container">
            <form method="post" action="#">
                @csrf 
                <input type="text" placeholder="name" name="name" required>
                <input type="text" placeholder="Email"  name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" name="signup" id="signup-button">Signup</button>
            </form>
            <div>Already have an account? <a href="#" id="login"><b style="color: red;">login</b></a></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('login-container').style.display = 'block';
            document.getElementById('signup-container').style.display = 'none';

            function showLoginForm() {
                document.getElementById('login-container').style.display = 'block';
                document.getElementById('signup-container').style.display = 'none';
            }

            function showSignupForm() {
                document.getElementById('login-container').style.display = 'none';
                document.getElementById('signup-container').style.display = 'block';
            }

            document.getElementById('signup').addEventListener('click', function(e) {
                showSignupForm();
            });

            document.getElementById('login').addEventListener('click', function(e) {
                e.preventDefault();
                showLoginForm();
            });
        });
    </script>
</body>
</html>