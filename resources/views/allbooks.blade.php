<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
   <link rel="stylesheet" href="{{ asset('css/books.css') }}"> 
   <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    
</head>
<body>
    @include('header')
    <div id=filterbar> 
    <form method="GET" onsubmit="return validateDateRange()" action="{{ route('allBooksPage') }}">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">All</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
            @endforeach
        </select>
        <br>

   
    <label for="publish_date">Publish Date:</label>
    <br>
    <label for="start_date">Start Date:</label>
    <input type="number" name="start_date" id="start_date" value="{{ request('start_date')}}" min="1900" max="2024">
    <span id="start_date_error" style="color: red;"></span>

    <label for="end_date">End Date:</label>
    <input type="number" name="end_date" id="end_date" value="{{ request('end_date') }}" min="1900" max="2024">
    <span id="end_date_error" style="color: red;"></span>
 


        <button type="submit" class="sub">Filter</button> 
    </form>
    </div>
    <div id="allbooks">


    @foreach($books as $book)
    <div class="singlebook" name="book_{{$book->book_id}}">
        <a href="{{ route('book.show', $book->ISBN) }}">
            <img src="{{$book->bookcover_url}}" alt="{{$book->title}} book cover image" class="bookcover">
            <p>{{ $book->title }}</p>
            {{-- <p>By: {{ $book->author }}</p>
            <p>category: {{$book->category}}</p> --}}
        </a>
    </div>
@endforeach
    
@include('footer')
</div>
</body>


<script>
    // document.getElementById("start_date").defaultValue = "1900";
    // document.getElementById("end_date").defaultValue = "2024";

    function validateDateRange() {
    var startDateInput = document.getElementById("start_date").value;
    var endDateInput = document.getElementById("end_date").value;
    var startDateError = document.getElementById("start_date_error");
    var endDateError = document.getElementById("end_date_error");

    // Reset error messages
    startDateError.textContent = "";
    endDateError.textContent = "";

    // Parse input values
    var startDate = startDateInput ? parseInt(startDateInput) : null;
    var endDate = endDateInput ? parseInt(endDateInput) : null;

    // Check if both values are empty, if so allow submission to show all records
    if (startDateInput === "" && endDateInput === "") {
        return true;
    }

    // Validate if the inputs are not numbers
    if (startDateInput !== "" && isNaN(startDate)) {
        startDateError.textContent = "Please enter a valid year.";
        return false;
    }
    if (endDateInput !== "" && isNaN(endDate)) {
        endDateError.textContent = "Please enter a valid year.";
        return false;
    }

    // Validate the date range
    if (startDate !== null && endDate !== null && startDate > endDate) {
        endDateError.textContent = "End year must be greater than or equal to start year.";
        return false;
    }

    return true;
}
</script>