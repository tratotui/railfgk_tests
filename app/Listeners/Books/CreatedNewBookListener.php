<?php

namespace App\Listeners\Books;

use App\Events\Books\CreatedNewBook;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class CreatedNewBookListener
{
    public function handle(CreatedNewBook $event)
    {
        $msg = 'Created new book with id=' . $event->book->id;

        Mail::raw($msg, function ($mailer) use ($event) {
            return $mailer->to('tratotui@yandex.ru');
        });
    }
}
