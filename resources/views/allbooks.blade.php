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
            background-color: rgb(255, 0, 217);
        }
        body{
            height:100%;
            display: flex
        }
        html{
            height: 100%;
        }
    </style>
</head>
<body>
    <div id=filterbar></div>
    <div id=allbooks>
        @foreach($books as $book)
            <div class=singlebook name="book_{{$book->book_id}}">
                <a href="/book?q={{$book->ISBN}}">

                    <img src="{{$book->bookcover_url}}" alt="{{$book->title}} book cover image" class=bookcover>
                    <p>{{ $book->title }} </p>
                    <p> By: {{ $book -> author}}</p>
                </a>

            </div>
        @endforeach
    </div>
</body>