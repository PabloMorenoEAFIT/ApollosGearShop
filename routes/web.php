<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/instruments', 'App\Http\Controllers\InstrumentController@index')->name('instrument.index');
Route::get('/instruments/create', 'App\Http\Controllers\InstrumentController@create')->name('instrument.create');
Route::get('/instruments/{id}', 'App\Http\Controllers\InstrumentController@show')->name('instrument.show');
Route::post('/instruments/save', 'App\Http\Controllers\InstrumentController@save')->name('instrument.save');
route::delete('/instruments/{id}', 'App\Http\Controllers\InstrumentController@delete')->name('instrument.delete');
