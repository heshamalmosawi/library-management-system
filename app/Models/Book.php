<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'book_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ISBN',
        'title',
        'author',
        'bookcover_url',
        'publisher',
        'category',
        'publish_date',
        'abstract',
        'available_copies',
        'total_copies',
        'location',
        'numOfPages',
        'is_archived',
    ];

 }
