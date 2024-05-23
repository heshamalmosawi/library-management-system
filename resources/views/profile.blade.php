<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>
<body>
    @include('header')
    <div id="profile-container">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <h1>Update Profile</h1>

            <input type="text" placeholder="Name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="text" placeholder="Phone number" name="contact_no" value="{{ old('contact_no') }}">
            @error('contact_no')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="password" placeholder="New Password (leave blank if not changing)" name="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit" id="update-button">Update</button>

            @if(session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif
        </form>
    </div>
    @include('footer')
</body>
</html>