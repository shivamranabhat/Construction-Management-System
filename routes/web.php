<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});
Route::get('/create', function () {
    return view('pages.create');
});
