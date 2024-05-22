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
          'Title' => 'required|string|max:100',
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
        $book->category = $request->Category;
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
    public function show($book)
    {
        // Assuming 'book' is the primary key
        $book = Book::where('ISBN', $book)->firstOrFail();
        return view('showbook', compact('book'));
    }
    // public function showBooksByCategory($category)
    // {
    //     // Retrieve all books that belong to the given category
    //     $books = Book::where('category', $category)->get();

    //     return view('bookbycategory', ['category' => $category, 'books' => $books]);
    // }
    public function allBooksPage(Request $request)
    {
        // Get all books
        $query = Book::query();

        // Apply category filter if selected
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('start_date')) {
            $query->where('publish_date', '>=', $request->input('start_date'));
        }
    
        if ($request->filled('end_date')) {
            $query->where('publish_date', '<=', $request->input('end_date'));
        }

        // Retrieve filtered books or all books if no filters provided
        $books = $query->get();



        // Pass books and other necessary data to the view
        return view('allbooks', [
            'books' => $books,
            'categories' => Book::distinct()->pluck('category'),
            'start_year' => $request->input('start_year'),
            'end_year' => $request->input('end_year'),
        ]);
    }
        public function showCategories()
        {
            // Retrieve all categories from the books table
            $categories = Book::distinct()->pluck('category');

            return view('category', ['categories' => $categories]);
        }  
        
        public function showBooksByCategory($category)
        {
            // Retrieve all books that belong to the given category
            $books = Book::where('category', $category)->get();

            return view('bookbycategory', ['category' => $category, 'books' => $books]);
        }

        
        public function editBook($book_id)
        {
            $book = Book::findOrFail($book_id);
            
            $authors = [];
            if ($book->author) {
                $authors = explode(', ', $book->author);
            }
            return view('editbook', compact('book', 'authors'));
        }
    
        public function updateBook(Request $request, $book_id)
        {
            $request->validate([
                'ISBN' => 'required|digits:13',
                'title' => 'required|string|max:100',
                'Author.*' => 'required',
                'category' => 'required|string|max:30',
                'bookcover_url' => 'required|string|max:255',
                'publisher' => 'required|string|max:20',
                'publish_date' => 'required|integer|min:1000|max:' . date('Y'),
                'abstract' =>  'required|string', 
                'available_copies' => 'required|integer|min:0|max:999',
                'total_copies' => 'required|integer|min:0|max:999',
                'location' => 'required|string|max:255',
                'numOfPages' => 'required|integer|min:1|max:9999',
                'is_archived' => 'boolean'
            ]);
    
            $book = Book::findOrFail($book_id);
            $book->ISBN = $request->ISBN;
            $book->title = $request->title;
            $authors = implode(', ', $request->input('Author.*'));
            $book->author = $authors;
            $book->bookcover_url = $request->bookcover_url;
            $book->publisher = $request->publisher;
            $book->category = $request->category;
            $book->publish_date = $request->publish_date;
            $book->abstract = $request->abstract;
            $book->available_copies = $request->available_copies;
            $book->total_copies = $request->total_copies;
            $book->location = $request->location;
            $book->numOfPages = $request->numOfPages;
            $book->is_archived = $request->has('is_archived');
    
            $book->save();
    
            return redirect()->route('books.edit', ['book_id' => $book_id])->with('success', 'Book updated successfully!');
        }
}
