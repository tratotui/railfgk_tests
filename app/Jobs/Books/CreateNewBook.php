<?php

namespace App\Jobs\Books;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
// Models
use App\Models\Book;
// Services
use App\Services\RemoteService;
// Event
use App\Events\Books\CreatedNewBook;

/*
 - Имитация сохранения во внешний сервис  или ошибка (будет возвращено id)
 - сохранение данных в базу данных с id внешнего сервиса (достаточна просто вывести сообщение "Данные сохранены") 
 - отправка данных на почту (достаточна просто вывести сообщение "Данные отправленны на почту")
 - Если произошла ошибка то нужно ее обработать, и имитировать отправку на почту поддержке
*/

class CreateNewBook
{
    use Dispatchable, Queueable;

    protected $data = [];

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {
            // Save data on remote service
            $r_object = with(new RemoteService)->createNewRecord($this->data);
            // Create record in db
            $book = Book::create($this->data);
            // Fire event
            event(new CreatedNewBook($book));
            return $book;
        } catch (Exception $e) {
            return Mail::raw('So bad, so bad...', function ($mailer) {
                return $mailer->to('tratotui@yandex.ru');
            });
        }

    }
}
