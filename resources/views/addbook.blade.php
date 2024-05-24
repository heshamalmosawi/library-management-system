<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add book</title>
     <link rel="stylesheet" href="{{ asset('css/addbook.css') }}"> 
     <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>
<style>
    .errors {
        color: red;
    }
</style>
<div>
    @if (session('userType') != 'staff')
        <script>
        alert('Restriced page! Only library staff can add books!')
        window.location = "/login";</script>    

    @endif

    @include('header')
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
    <form method="POST" class="inputform" action="#">
        @csrf
        <label for="ISBN"></label>
            <input type="text" name="ISBN" id=ISBN onkeyup="validate(this.value)" placeholder=ISBN-13 required>
            <p id=isbnvalidate> </p>
            @error('ISBN')
            <p class=errors> {{ $message }}</p>
            @enderror
        
        <label for="Title"></label>
            <input type="text"placeholder="Title" name="Title" required>
        
        <label for="Author"></label>
            <div id="AuthorOption">
                <input type="text" placeholder="Author" name="Author[]" required>
            </div>
            @error('Author')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="Category"></label>
            <input type="text" name="Category" placeholder="Category" required>
            @error('Category')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="Description"></label>
        <input type="text" name="Description" placeholder="Description" required>
            @error('Description')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>

        <label for="BookCover"></label>
            <input type="text" name="BookCover"placeholder="Book Cover URL" required>
            @error('BookCover')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>    
        

        <label for="publisher"></label>
            <input type="text" name="publisher" placeholder="Publisher" required>
            @error('publisher')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="publish_year">Publish Year</label>
            <input type="number" name="publish_year" min="1900" max="{{ date('Y') }}" required>
            @error('publish_year')
                <p class=errors> {{ $message }}</p>
            @enderror

        <br><br>
        <label for="total_copies">Total Copies</label>
            <input type="number" name="total_copies"id="num_of_pages" min="0" step="1" required>
            @error('total_copies')
                <p class=errors> {{ $message }}</p>
            @enderror
        
        <br><br>
        <label for="location"></label>
            <input type="text" name="location" placeholder="Branch Location" required>
            @error('location')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="num_of_pages">Number of Pages</label>
            <input type="number" name="num_of_pages" id="num_of_pages" min="0" step="1" required>
            @error('num_of_pages')
                <p class=errors> {{ $message }}</p>
            @enderror        
        <br><br>
        <button type="button" onclick="callApi()" id=autofillBtn disabled> Autofill </button>
        <button type=button onclick="addAuthor()">Add Author</button>
        <button type=button onclick="removeAuthor()">Remove Author</button>
        <br><br>
        <button type="submit">Add book</button>
    </form>
</div>
@include('footer')
<script src="{{ asset('js/addbook.js') }}"></script>
