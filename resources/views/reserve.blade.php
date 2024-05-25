<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Book</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/reserve.css') }}">
</head>
<body>
    @include('header')
    <h1>Reserve Book</h1>
    @guest
        <script>window.location = "/login";</script>    
    @endguest


    <br>
    <form id=transactionForm method=POST>
        @csrf
        <label for="bookchoice">Book:</label>
        <select name="bookoption" id="bookchoice">
            <option value="" disabled selected>Choose book</option>
            @foreach($books as $book)
                <option value="{{ $book->ISBN }}" data-available-copies="{{ $book->available_copies }}">{{ $book->title }}</option>
            @endforeach
        </select>
        @if (session('userType') == 'staff')
        <select name="studentoption" id="studentchoice"style="margin-top:2%;">
            <option value="" disabled selected>Choose Student</option>
            @foreach($users as $user)
                <option value="{{ $user->user_id }}">{{ $user->email }}</option>
            @endforeach
        </select>
        @endif
        <h3> Reserve for 2 until: {{ now()->addDays(2)->format('F j, Y')}} </h3>
        
        <button type="submit">Reserve</button>
    </form>
    @include('footer')
    @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif
</body>
</html>
<script>
    document.getElementById('transactionForm').addEventListener('submit', function(event) {
        var bookChoice = document.getElementById('bookchoice');
        if (bookChoice.value === '') {
            alert('Please choose a book before submitting the form.');
            event.preventDefault(); // Prevent the form from submitting
        }
        if ( {{$userAmount}} > 5){
            alert('Maximum transactions reached by user!')
            event.preventDefault(); // Prevent the form from submitting
        }
        var selectedBook = bookChoice.options[bookChoice.selectedIndex];
        
        // Check if the selected book's available_copies is zero
        if (selectedBook.dataset.availableCopies === '0') {
            alert('No available copies left to borrow!');
            event.preventDefault(); // Prevent the form from submitting
        }
    });
</script>