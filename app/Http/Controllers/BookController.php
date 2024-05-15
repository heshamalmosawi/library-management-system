<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function showAddForm()
    {
        return view('addbook');
    }

    public function addBook(Request $request){
        // dd($request->input('Author'));
        
        $request->validate([
          'ISBN' => 'required|digits:13',
          'Title' => 'required|string|max:50',
          'Author.*' =>'required',
          'Category' => 'required',
          'BookCover' => 'required|string|max:255',
          'publisher' => 'required|string|max:50',
          'publish_year' => 'required|integer|min:1000|max:' . date('Y'), // Assuming publish year is between 1000 and current year
          'Description' => 'required|string', // can have lots of characters!
          'total_copies' => 'required|integer|min:0|max:999', 
          'num_of_pages' => 'required|integer|min:1|max:9999', 
        ]);

        $book = new Book();
        // dd($request->all());
        $book->ISBN = $request->ISBN;
        $book->title = $request->Title;

        $authors = implode(', ', $request->input('Author.*'));
        $book->author = $authors;
        $book->bookcover_url = $request->BookCover;
        $book->publisher = $request->publisher;
        $book->publish_date = $request->publish_year;
        $book->abstract = $request->Description;
        $book->available_copies = $request->total_copies; // initially, available copies = total copies
        $book->total_copies = $request->total_copies;
        $book->location = $request->location;
        $book->numOfPages = $request->num_of_pages;
        $book->is_archived = false;
        // dd($request->all());
        $book->save();
        return redirect('/')->with('success', 'Add book successful!');
    }
    public function allBooksPage(){
        $books = Book::all();
        return view('allbooks', ['books' => $books]);
    }
}
