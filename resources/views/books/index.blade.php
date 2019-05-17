@extends('layouts.base')

@section('title', 'Books index')


@section('content')
    <div class="container">
        <h1>Книги</h1>
        <hr>
        <ul>
            @foreach($src as $book)
                <li>
                    <a href="/books/{{ $book->id }}">
                        <span>{{ $book->title }}</span>
                        <span>от</span>
                        <span>{{ $book->author }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <a
            class="btn btn-primary"
            href="/books/create">Добавить новую книгу</a>
    </div>
@endsection