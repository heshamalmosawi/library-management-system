<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Assuming your CSS file is in a folder named 'css' --> --}}
    <style>
        #allbooks{
            display: flex;
            flex-wrap:wrap;
            justify-content: space-around;
            flex-direction: row;
        }
        .singlebook{
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
        }
        .bookcover{
            /* max-height: 10%;
            max-width:10%; */
        }

        #filterbar{
            height:75%;
            width:20%;
            background-color: rgb(150, 0, 217);
        }
        body{
            height:100%;
        }
        html{
            height: 100%;
        }
    </style>
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
    <input type="number" name="start_date" id="start_date" value="{{ request('start_date') }}" min="1900" max="2024">
    <span id="start_date_error" style="color: red;"></span>

    <label for="end_date">End Date:</label>
    <input type="number" name="end_date" id="end_date" value="{{ request('end_date') }}" min="1900" max="2024">
    <span id="end_date_error" style="color: red;"></span>
 


        <button type="submit">Filter</button>
    </form>
    </div>
    <div id="allbooks">


    @foreach($books as $book)
        <div class="singlebook" name="book_{{$book->book_id}}">
            <a href="/book?q={{$book->ISBN}}">
                <img src="{{$book->bookcover_url}}" alt="{{$book->title}} book cover image" class="bookcover">
                <p>{{ $book->title }}</p>
                <p>By: {{ $book->author }}</p>
            </a>
        </div>
    @endforeach
    

</div>
</body>


<script>
function validateDateRange() {
    var startDate = parseInt(document.getElementById("start_date").value);
    var endDate = parseInt(document.getElementById("end_date").value);
    var startDateError = document.getElementById("start_date_error");
    var endDateError = document.getElementById("end_date_error");

    startDateError.textContent = "";
    endDateError.textContent = "";

    if (isNaN(startDate) || isNaN(endDate)) {
        startDateError.textContent = "Please enter valid years.";
        return false;
    }

    if (startDate > endDate) {
        endDateError.textContent = "End year must be greater than start year.";
        return false;
    }

    return true;
}
</script>