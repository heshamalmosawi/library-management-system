<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'transaction_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id',
        'user_id',
        'transaction_type',
        'transaction_date',
        'due_date',
        'period_extended',
        'is_returned',
    ];

    /**
     * Get the book that owns the transaction.
     */
    public function book()
    {
        // by default, eloquent will add "_id" at the end of method name, so no need to specify id name :)
        return $this->belongsTo(Book::class); 
    }

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
