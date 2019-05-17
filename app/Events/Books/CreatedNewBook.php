<?php

namespace App\Events\Books;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\Book;

class CreatedNewBook
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $book = null;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
}
