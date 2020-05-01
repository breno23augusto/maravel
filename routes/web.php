<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('index');
Route::get('/all', 'HomeController@all')->name('all');
Route::post('/search', 'HomeController@search')->name('search');
