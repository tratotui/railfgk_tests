<?php

Route::get('vuetify', function () {
    return view('vuetify');
});


Route::resource('books', 'BookController');
