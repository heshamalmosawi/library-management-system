<!DOCTYPE html>
<html lang="en">
        <!-- When there is no desire, all things are at peace. - Laozi -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/return.css') }}">

</head>
<body>
    @include('header')
    <h1>Return Book</h1>
    @if (session('userType') != 'staff')
        <script>
        alert('Restriced page! Only library staff can add books!')
        window.location = "/login";</script>    
    @endif

    <form method="POST" id=returnForm>
        @csrf
        <label for="student">Choose student:</label>
        <select name="studentoption" id="studentchoice"  onchange="updateBooks()">
            <option value="" disabled selected>Choose Student</option>
            @foreach($users as $user)
                <option value="{{ $user->user_id }}">{{ $user->email }}</option>
            @endforeach
        </select>

        <div id="bookSelectContainer" style="display: none;">
            <label for="book">Choose book:</label>
            <select name="bookoption" id="bookchoice" name=bookchoice>
                <option value="" disabled selected>Choose Book</option>
                <!-- Options will be populated dynamically -->
            </select>
        </div>
        <button type="submit">Return Book </button>
    </form>
    
    @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif

    @include('footer')
</body>


<script>
    document.getElementById('returnForm').addEventListener('submit', function(event) {
        var bookChoice = document.getElementById('bookchoice').value;
        var studentChoice = document.getElementById('studentchoice').value;
        if (bookChoice === '' || studentChoice === '') {
            alert('Please choose a student & book before submitting the form.');
            event.preventDefault(); // Prevent the form from submitting
        }
    });

    const transactions = @json($transactions);

    function updateBooks() {
        const studentId = document.getElementById('studentchoice').value;
        const bookSelectContainer = document.getElementById('bookSelectContainer');
        const bookSelect = document.getElementById('bookchoice');

        // Filter transactions to get books for the selected student
        const studentTransactions = transactions.filter(transaction => transaction.user_id == studentId);

        // Clear previous options
        bookSelect.innerHTML = '<option value="" disabled selected>Choose Book</option>';

        // Populate new options
        studentTransactions.forEach(transaction => {
            const option = document.createElement('option');
            option.value = transaction.book_id; // assuming there's a book_id field in transactions
            option.textContent = transaction.book_id; // assuming there's a book_title field in transactions
            bookSelect.appendChild(option);
        });

        // Display the book select if there are any books
        bookSelectContainer.style.display = studentTransactions.length ? 'block' : 'none';
    }
</script>

</html>



