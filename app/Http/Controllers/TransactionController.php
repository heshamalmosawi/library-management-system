<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transactions;
use App\Models\Book;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showBorrow()
    {
        return view('borrow', ["books" => Book::all()]);
    }
    
    public function borrowbook(Request $request){
        $foundbook = Book::where('ISBN', $request->bookoption)->first(); /* if we dont specify first it returns instance of query builder */
        $transaction = new Transactions();
        
        $transaction->book_id = $foundbook->book_id;
    }
}
