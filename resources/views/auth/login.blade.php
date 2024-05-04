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
        <div id="login-container">
            <form action="#" method="post" name=session value=login>
                @csrf
                <input type="text" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" name="login">Login</button>
                {{-- <div> Don't have an account? <a href="register" id="signup"><b style="color: red;">sign up</b></a></div> --}}
            </form>
        </div>
        {{-- <div id="signup-container">
            <form method="post" action="#" name=session value=register>
                @csrf 
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
                @if($errors->any()) 
                    <script>
                        const errorcode = true;
                    </script>
                @endif
            </form>
            <div>Already have an account? <a href="#" id="login"><b style="color: red;">login</b></a></div>
        </div> --}}
        <script>

        //         document.addEventListener('DOMContentLoaded', function() {
        //         document.getElementById('login-container').style.display = 'block';
        //         document.getElementById('signup-container').style.display = 'none';
        
        //         function showLoginForm() {
        //             document.getElementById('login-container').style.display = 'block';
        //             document.getElementById('signup-container').style.display = 'none';
        //         }

        //         function showSignupForm() {
        //             document.getElementById('login-container').style.display = 'none';
        //             document.getElementById('signup-container').style.display = 'block';
        //         }

        //         document.getElementById('signup').addEventListener('click', function(e) {
        //             showSignupForm();
        //         });

        //         document.getElementById('login').addEventListener('click', function(e) {
        //             e.preventDefault();
        //             showLoginForm();
        //         });

        //         if (errorcode) {
        //             showSignupForm();
        //         }
        // });
    </script>
</body>
</html>