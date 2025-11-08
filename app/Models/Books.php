<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Books extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'published_year',
        'genre',
        'summary',
        'category_id',
        'book_type_id',
        'status',
        'user_id',
        'price',
        'image',
    ];

    /**
     * Get the category that owns the book.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the book type that owns the book.
     */
    public function bookType(): BelongsTo
    {
        return $this->belongsTo(BookType::class, 'book_type_id');
    }



    /**
     * Get the user that owns the book.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the transactions for the book.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'book_id');
    }
}
