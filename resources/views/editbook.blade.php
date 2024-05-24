<!-- resources/views/books/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="{{ asset('css/editbook.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>
<body>
    @include('header')
    <div id="edit-container">
        <form method="POST" action="{{ route('books.update', ['book_id' => $book->book_id]) }}">
            @csrf
            <h1>Edit Book</h1>
            <label for="">ISBN</label>
            <input type="text" placeholder="ISBN" name="ISBN" onkeyup="validate(this.value)" value="{{ old('ISBN', $book->ISBN) }}">
            <p id=isbnvalidate> </p>
            @error('ISBN')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Title</label>
            <input type="text" placeholder="Title" name="title" value="{{ old('title', $book->title) }}">
            @error('title')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Author</label>
            <div id="AuthorOption">
                {{-- <input type="text" placeholder="Author" name="Author[]" value="{{ old('author', $book->author) }}"> --}}
                @foreach($authors as $index => $author)
                <input type="text" name="Author[]" value="{{ $author }}" required>
                <br>
                @endforeach
            </div>
            @error('author')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Category</label>
            <input type="text" placeholder="Category" name="category" value="{{ old('category', $book->category) }}">
            @error('category')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Book Cover</label>
            <input type="text" placeholder="Book Cover URL" name="bookcover_url" value="{{ old('bookcover_url', $book->bookcover_url) }}">
            @error('bookcover_url')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Publisher</label>
            <input type="text" placeholder="Publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}">
            @error('publisher')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Publish Date</label>
            <input type="number" placeholder="Publish Date" name="publish_date" value="{{ old('publish_date', $book->publish_date) }}">
            @error('publish_date')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Description</label>
            <input type="text" placeholder="Description" name="abstract" value="{{ old('abstract', $book->abstract) }}">
            @error('abstract')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Available Copies</label>
            <input type="number" placeholder="Available Copies" name="available_copies" value="{{ old('available_copies', $book->available_copies) }}">
            @error('available_copies')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Total Copies</label>
            <input type="number" placeholder="Total Copies" name="total_copies" value="{{ old('total_copies', $book->total_copies) }}">
            @error('total_copies')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Location</label>
            <input type="text" placeholder="Location" name="location" value="{{ old('location', $book->location) }}">
            @error('location')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            <label for="">Number of Pages</label>
            <input type="number" placeholder="Number of Pages" name="numOfPages" value="{{ old('numOfPages', $book->numOfPages) }}">
            @error('numOfPages')
                <div style="color: red;">{{ $message }}</div>
            @enderror

            <label for="is_archived">Archive Book</label>
            <input type="checkbox" name="is_archived" {{ old('is_archived', $book->is_archived) ? 'checked' : '' }}>

            <button type="submit" id="update-button">Update Book</button>

            @if(session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif
        </form>
        <button type=button onclick="addAuthor()">Add Author</button>
        <button type=button onclick="removeAuthor()">Remove Author</button>
    </div>
    @include('footer')
</body>
</html>
<script src="{{ asset('js/addbook.js') }}"></script>
