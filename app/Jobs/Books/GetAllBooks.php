<?php

namespace App\Jobs\Books;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Book;
use App\Http\Resources\Books as BooksCollection;

class GetAllBooks
{
    use Dispatchable, Queueable;

    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return new BooksCollection(
            Book::all()
        );
    }
}
