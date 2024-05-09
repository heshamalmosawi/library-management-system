<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

</body>
</html>