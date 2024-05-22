<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Books</title>
</head>
<body>
    @include('header')

    @auth
        <p> hey {{ Auth::check() }} </p>
    @else   
        <p> yo man</p>
    @endauth
    <br>
    <form method=POST>
        @csrf
        <label for="bookchoice">Book:</label>
        <select name="bookoption" id="bookchoice">
            <option value="" disabled selected>Choose book</option>
            @foreach($books as $book)
                <option value="{{ $book->ISBN }}">{{ $book->title }}</option>
            @endforeach
        </select>
        <br><br>
        <button type="submit">Borrow</button>
    </form>
</body>
</html>
