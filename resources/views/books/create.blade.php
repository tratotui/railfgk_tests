@extends('layouts.base')

@section('title', 'Book create')


@section('content')
    <div class="container">
        <h1>
            @if(isset($data))
                <span>Книга # {{ $data['id'] }}</span>
            @else
                <span>Добавление новой книги</span>
            @endif
        </h1>
        {{-- Show errors --}}
        @if($errors->count())
            @include('fragments.errors', ['erorrs' => $errors])
        @endif
        {{-- /Show errors --}}
        <hr>
        <form
            name="form_create"
            action="{{ isset($path) ? $path : '/books' }}"
            method="post">
            {{ csrf_field() }}
            @if(isset($method))
                {{ method_field($method) }}
            @endif
            <div class="form-group">
                <label for="author">Автор</label>
                <input
                    class="form-control"
                    id="author"
                    name="author"
                    placeholder="Введите автора"
                    value="{{ isset($data) && isset($data['author']) ? $data['author'] : ''}}"
                    {{ isset($is_show) ? "readonly" : ''}}>
            </div>
            <div class="form-group">
                <label for="title">Название</label>
                <input
                    class="form-control"
                    name="title"
                    id="title"
                    placeholder="Введите название"
                    value="{{ isset($data) && isset($data['title']) ? $data['title'] : ''}}"
                    {{ isset($is_show) ? "readonly" : ''}}>
            </div>
            <div class="form-group">
                <label for="seria">Серия</label>
                <input
                    class="form-control"
                    id="seria"
                    name="seria"
                    placeholder="Введите серию"
                    value="{{ isset($data) && isset($data['seria']) ? $data['seria'] : ''}}"
                    {{ isset($is_show) ? "readonly" : ''}}>
            </div>

            @if(!isset($is_show))
                <button type="submit" class="btn btn-primary">Сохранить</button>
            @else
                <a
                    class="btn btn-primary"
                    href="/books/{{ $data['id'] }}/edit">
                    Редактировать
                </a>
                <button type="submit" class="btn">Удалить</button>
            @endif
        </form>
    </div>
@endsection