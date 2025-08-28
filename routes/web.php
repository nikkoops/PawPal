<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // resources/views/home.blade.php
});

