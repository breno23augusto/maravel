<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('index');
Route::get('/some', 'HeroesController@some')->name('some');
Route::post('/search', 'HeroesController@search')->name('search');
