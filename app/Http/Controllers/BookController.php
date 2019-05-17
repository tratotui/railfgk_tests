<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
// Requests
use App\Http\Requests\Books\BookStoreRequest;
// Jobs
use App\Jobs\Books\GetAllBooks;
use App\Jobs\Books\CreateNewBook;
use App\Jobs\Books\UpdateBook;
use App\Jobs\Books\DeleteBook;

/**
 * Создан контроллер как для польщовательского интерфейса,
 * так и для api
 */
class BookController extends DefaultController
{
    const VIEW_PATH = 'books';

    public function index(Request $request)
    {
        $src = $this->dispatchNow(new GetAllBooks);

        if (!$request->ajax()) {
            return $this->showView(__FUNCTION__, ['src' => $src]);
        }

        return $src;
    }

    public function create(Request $request)
    {
        if (!$request->ajax()) {
            return $this->showView(__FUNCTION__);
        }

        return abort(400);
    }

    public function store(BookStoreRequest $request)
    {
        // Create
        $result = $this->dispatchNow(
            new CreateNewBook(
                $request->all()
            )
        );

        return $this->returnResult($result);
    }

    public function show(Book $book, Request $request)
    {
        if (!$request->ajax()) {
            return $this->showView('create', [
                'path' => '/' .self::VIEW_PATH . '/' . $book->id,
                'is_show' => true,
                'method' => 'delete',
                'data' => $book->toArray()
            ]);
        }

        return $book;
    }

    public function edit(Book $book, Request $request)
    {
        if (!$request->ajax()) {
            return $this->showView('create', [
                'path' => '/' .self::VIEW_PATH . '/' . $book->id,
                'method' => 'put',
                'data' => $book->toArray()
            ]);
        }

        return $book;
    }

    public function update(BookStoreRequest $request, Book $book)
    {
        $result = $this->dispatchNow(
            new UpdateBook(
                $book,
                $request->all()
            )
        );

        return $this->returnResult($result);
    }

    public function destroy(Book $book)
    {
        $result = $this->dispatchNow(
            new DeleteBook($book)
        );

        return $this->returnResult($result);
    }
}