<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>signup</title>
</head>
<body>
    <div id="signup-container">
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

            {{-- <div> Already have an account? <a href="login" id="signup"><b style="color: red;">login</b></a></div> --}}
        </form>
    </div>
</body>
</html>