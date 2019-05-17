<?php

namespace App\Jobs\Books;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Book;

class UpdateBook
{
    use Dispatchable, Queueable;

    protected $book = null;
    protected $data = [];

    public function __construct(Book $book, $data = [])
    {
        $this->book = $book;
        $this->data = $data;
    }

    public function handle()
    {
        return $this->book->update(
            $this->data
        );
    }
}
