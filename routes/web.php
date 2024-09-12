<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/instruments', 'App\Http\Controllers\InstrumentController@index')->name('instrument.index');
Route::get('/instruments/create', 'App\Http\Controllers\InstrumentController@create')->name('instrument.create');
Route::get('/instruments/{id}', 'App\Http\Controllers\InstrumentController@show')->name('instrument.show');
Route::post('/instruments/save', 'App\Http\Controllers\InstrumentController@save')->name('instrument.save');
route::delete('/instruments/{id}', 'App\Http\Controllers\InstrumentController@delete')->name('instrument.delete');

Route::get('/stocks' , 'App\Http\Controllers\StockController@index')->name('stock.index');
Route::get('/stocks/{id}', 'App\Http\Controllers\StockController@show')->name('stock.show');
Route::post('/stocks/{id}/add', 'App\Http\Controllers\StockController@addStock')->name('stock.add');
Route::post('/stocks/{id}/lower','App\Http\Controllers\StockController@lowerStock')->name('stock.lower');
Route::delete('/stocks/{id}/delete', 'App\Http\Controllers\StockController@delete')->name('stock.delete');