<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/instruments', 'App\Http\Controllers\InstrumentController@index')->name('instrument.index');
Route::get('/instrument/create', 'App\Http\Controllers\InstrumentController@create')->name('instrument.create');
Route::post('/instrument/save', 'App\Http\Controllers\InstrumentController@save')->name('instrument.save');
Route::get('/instrument/success', 'App\Http\Controllers\InstrumentController@success')->name('instrument.success');
route::delete('/instrument/{id}', 'App\Http\Controllers\InstrumentController@delete')->name('instruments.delete');
Route::get('/instrument/{id}', 'App\Http\Controllers\InstrumentController@show')->name('instrument.show');

Auth::routes();