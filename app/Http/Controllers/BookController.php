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
        $request->validate([
          'ISBN' => 'required|digits:13',
          'Title' => 'required|string|max:50',
        //   'authors' =>'required'
           'BookCover' => 'required|string|max:255',
           'publisher' => 'required|string|max:50',
           'publish_year' => 'required|integer|min:1000|max:' . date('Y'), // Assuming publish year is between 1000 and current year
           'Description' => 'required|string', // can have lots of characters!
           'available_copies' => 'required|integer|min:0|max:999', 
           'total_copies' => 'required|integer|min:0|max:999', 
           'num_of_pages' => 'required|integer|min:1|max:9999', 
           'is_archived' => 'required|boolean',
        ]);
    
        $book = new Book();
        $book->ISBN = $request->ISBN;
        $book->title = $request->Title;
        $book->author = $request->Author;
        $book->bookcover_url = $request->BookCover;
        $book->publisher = $request->publisher;
        $book->publish_year = $request->publish_year;
        $book->abstract = $request->Description;
        $book->available_copies = $request->available_copies;
        $book->total_copies = $request->total_copies;
        $book->num_of_pages = $request->num_of_pages;
        $book->is_archived = $request->is_archived;
        
        $book->save();
        return redirect('/')->with('success', 'Add book successful!');
    }
}
