<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function showBorrow()
    {
        // for easier load time, pass everything to front end !
        if (Auth::user()){
            $userid = Auth::user()->user_id;            
            $transactionCount = Transaction::where('user_id', $userid)->count();
            return view('borrow', ["books" => Book::all() , "userAmount" => $transactionCount, "users" => User::all()]);
        }
        return view('borrow', ["books" => Book::all(), "users" => User::all()]);
    }
    
    public function borrowaction(Request $request){
        $foundbook = Book::where('ISBN', $request->bookoption)->first(); /* if we dont specify first it returns instance of query builder */
        if ($request->userid){
            $userid= $request->userid;
        } else {
            $userid = Auth::user()->user_id;            
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

        return redirect('/')->with('message', 'Book successfully borrowed!');

    }

    public function showReserve(){
        // for easier load time, pass everything to front end !
        if (Auth::user()){
            $userid = Auth::user()->user_id;            
            $transactionCount = Transaction::where('user_id', $userid)->count();
            return view('reserve', ["books" => Book::all() , "userAmount" => $transactionCount, "users" => User::all()]);
        }
        return view('reserve', ["books" => Book::all(), "users" => User::all(), ]);
    }

    public function reserveAction(Request $request){
        $foundbook = Book::where('ISBN', $request->bookoption)->first(); /* if we dont specify first it returns instance of query builder */
        if ($request->userid){
            $userid= $request->userid;
        } else {
            $userid = Auth::user()->user_id;            
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
        return redirect('/')->with('message', 'Book successfully reserved!');
    }

    public function showReturn(){
        return view('returnbook');
    }
}
