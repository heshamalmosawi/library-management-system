<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReturnedBook;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function showBorrow(Request $request)
    {
        $selectedBook = null;
        $isbn = $request->input('isbn');
    
        if ($isbn) {
            $selectedBook = Book::where('ISBN', $isbn)->first();
        }
    
        if (!Auth::user()){
            return redirect('/login')->with('message', 'Page restricted! Login first!');
        } else {
            if (session('userType') == 'student'){
                $userid = session('id');
                $transactionCount = Transaction::where('user_id', $userid)->count();
                return view('borrow', [
                    "books" => Book::all(),
                    "userAmount" => $transactionCount,
                    "selectedBook" => $selectedBook,
                    "users" => User::all()
                ]);
            } else {
                return view('borrow', [
                    "books" => Book::all(),
                    "selectedBook" => $selectedBook,
                    "userAmount" => 0,
                    "users" => User::all()
                ]);
            }
        }
    }
    
    public function borrowaction(Request $request){

        $foundbook = Book::where('ISBN', $request->bookoption)->first(); /* if we dont specify first it returns instance of query builder */
        if ($request->studentoption){
            $userid= $request->studentoption;
        } else {
            $userid = session('id');            
        }

        $transactionCount = Transaction::where('user_id', $userid)->count();
        if ($transactionCount > 5){
            return redirect('/borrow')->with('error', 'Maximum transactions reached by user!');
        }
        $transaction = new Transaction();
        
        if ($foundbook->available_copies < 1) {
            return redirect('/borrow')->with('error', 'No available copies left to borrow!');
        }

        $transaction->book_id = $foundbook->book_id;
        $transaction->user_id = $userid;
        $transaction->transaction_type = 0; // meaning it is borrow not reserve
        $transaction->transaction_date = now()->toDateString();
        $transaction->due_date = now()->addMonth();
        $transaction->period_extended = false; // not extended yet
        $transaction->is_returned = false;
        $transaction->save();

        $foundbook->available_copies -= 1; // Once transaction is done, the book chosen available copies will decerement
        $foundbook->save();
        session()->flash('success', 'The book has been borrowed successfully!');
        return redirect('/');

    }

    public function showReserve(){

        if (!Auth::user()){
            return redirect('/login')->with('message', 'Page restricted! Login first!');
        } else{ 
            // for easier load time, pass everything to front end !
            if (session('userType') == 'student'){
                $userid = session('id');
                $transactionCount = Transaction::where('user_id', $userid)->count();
                return view('reserve', ["books" => Book::all() , "userAmount" => $transactionCount, "users" => User::all()]);
            } else {
                return view('reserve', ["books" => Book::all(), "userAmount" => 0, "users" => User::all() ]);
            }
        }

    }

    public function reserveAction(Request $request){
        $foundbook = Book::where('ISBN', $request->bookoption)->first(); /* if we dont specify first it returns instance of query builder */
        if ($request->studentoption){
            $userid= $request->studentoption;
        } else {
            $userid = session('id');            
        }

        $transactionCount = Transaction::where('user_id', $userid)->count();
        if ($transactionCount > 5){
            return redirect('/reserve')->with('error', 'Maximum transactions reached by user!');
        }
        $transaction = new Transaction();
        
        if ($foundbook->available_copies < 1) {
            return redirect('/reserve')->with('error', 'No available copies left to reserve!');
        }
        
        $transaction->book_id = $foundbook->book_id;
        $transaction->user_id = $userid;
        $transaction->transaction_type = 1; // meaning it is reserve not borrow
        $transaction->transaction_date = now()->toDateString();
        $transaction->due_date = now()->addDays(2);
        $transaction->period_extended = false; // not extended yet
        $transaction->is_returned = false;
        $transaction->save();

        $foundbook->available_copies -= 1; // Once transaction is done, the book chosen available copies will decerement
        $foundbook->save();
        session()->flash('success', 'The book has been reserved successfully!');
        return redirect('/');
    }

    public function showReturn(){
        if (session('userType') != 'staff'){
            return redirect('/login')->with('message', 'Page restricted! Refer to library staff to return book');
        } 
        return view('returnbook', ['users' => User::all(), 'transactions' => Transaction::all()]);
    }

    public function returnAction(Request $request){
        $student_id = $request->studentoption;
        $book_id = $request->bookoption;

        // dd($request);
        $transaction_to_return = Transaction::where('user_id', $student_id)->where('book_id', $book_id)->first();

        $return_book = new ReturnedBook();

        $return_book->transaction_id = $transaction_to_return->transaction_id;
        $return_book->return_date =  now()->toDateString();

        $islate = false;
        if (now()->gt($transaction_to_return->due_date)){ // check if due date passed
            $daysPassed = now()->diffInDays($transaction_to_return->due_date);
            $return_book->return_fees = 0.3 * $daysPassed; // 300 fils per day
            $islate = true;
        } else {
            $return_book->return_fees = 0;
        }

        $return_book->save();


        session()->flash('success', 'The book has been Return successfully!');
        return redirect()->back();
    }

    public function showTransaction(Request $request)
    {
        $query = Transaction::with('book', 'user');
    
        if ($request->has('email') && $request->email != '') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('email', $request->email);
            });
        }
    
        $transactions = $query->get();
    
        return view('allTransaction', compact('transactions'));
    }

    public function cancelReservation(Request $request){
        $student_id = session('id');
        $isbn = $request->input('isbn');
        $book_id = Book::where('isbn', $isbn)->first()->book_id;

        if (!$book_id){
            return redirect('profile')->with('error', 'Book not found.');
        }
        $returnRequest = new Request([
            'studentoption' => $student_id,
            'bookoption' => $book_id,
        ]);
        // Call returnAction with the new request
        $this->returnAction($returnRequest);

        return redirect('profile')->with('success', 'Reservation canceled successfuly!');
    }
}
