<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
@include('header')
<div id="profile-container">
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <h1>Update Profile</h1>
        
        <input type="text" placeholder="Name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        
        <input type="text" placeholder="Email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        
        <input type="text" placeholder="Phone number" name="contact_no" value="{{ old('contact_no', Auth::user()->contact_no) }}" required>
        @error('contact_no')
            <div style="color: red;">{{ $message }}</div>
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