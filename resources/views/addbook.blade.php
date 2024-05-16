<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add book</title>
     <link rel="stylesheet" href="{{ asset('css/addbook.css') }}"> 
</head>
<style>
    .errors {
        color: red;
    }
</style>
<div>
    @include('header')
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
    <form method="POST" action="#">
        @csrf
        <label for="ISBN">ISBN</label>
            <input type="text" name="ISBN" id=ISBN onkeyup="validate(this.value)" placeholder=ISBN-13 required>
            <p id=isbnvalidate> </p>
            @error('ISBN')
            <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="Title">Title</label>
            <input type="text" name="Title" required>
        <br>
        <label for="Author">Author</label>
            <div id="AuthorOption">
                <input type="text" placeholder="Author" name="Author[]" required>
            </div>
            @error('Author')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="Category">Category</label>
            <input type="text" name="Category" required>
            @error('Category')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="Description">Description</label>
            <textarea name="Description" required></textarea>
            @error('Description')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>

        <label for="BookCover">Book Cover URL</label>
            <input type="text" name="BookCover" required>
            @error('BookCover')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>    
        

        <label for="publisher">Publisher</label>
            <input type="text" name="publisher" required>
            @error('publisher')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="publish_year">Publish Year</label>
            <input type="number" name="publish_year" min="1900" max="{{ date('Y') }}" required>
            @error('publish_year')
                <p class=errors> {{ $message }}</p>
            @enderror

        <br>
        <label for="total_copies">Total Copies</label>
            <input type="number" name="total_copies" required>
            @error('total_copies')
                <p class=errors> {{ $message }}</p>
            @enderror
        
        <br>
        <label for="location">Branch Location</label>
            <input type="text" name="location" required>
            @error('location')
                <p class=errors> {{ $message }}</p>
            @enderror
        <br>
        <label for="num_of_pages">Number of Pages</label>
            <input type="number" name="num_of_pages" required>
            @error('num_of_pages')
                <p class=errors> {{ $message }}</p>
            @enderror        
        <br>
        <button type="button" onclick="callApi()" id=autofillBtn disabled> Autofill </button>
        <button type=button onclick="addAuthor()">Add Author</button>
        <button type=button onclick="removeAuthor()">Remove Author</button>

        <button type="submit">Add book</button>
    </form>
</div>
<script src="{{ asset('js/addbook.js') }}"></script>
