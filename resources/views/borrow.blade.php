<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow book</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/borrow.css') }}">
</head>
<body>
    @include('header')
    <h1>Borrow Book</h1>
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
                <option value="{{ $book->ISBN }}" {{ isset($selectedBook) && $selectedBook->ISBN == $book->ISBN ? 'selected' : '' }}>
                    {{ $book->title }}
                </option>
            @endforeach
        </select>
        @if (session('userType') == 'staff')
        <select name="studentoption" id="studentchoice">
            <option value="" disabled selected>Choose Student</option>
            @foreach($users as $user)
                <option value="{{ $user->user_id }}">{{ $user->email }}</option>
            @endforeach
        </select>
        @endif
        <h3> Due date (after 30 days): {{ now()->addMonth()->format('F j, Y') }}</h3>
        
        <button type="submit">Borrow</button>
    </form>
    @include('footer')

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