<?php

namespace App\Jobs\Books;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Book;

class DeleteBook
{
    use Dispatchable, Queueable;

    protected $book = null;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function handle()
    {
        return $this->book->delete();
    }
}
