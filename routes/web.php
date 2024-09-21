<?php

use App\Http\Middleware\CheckGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

// lessons routes
Route::get('/lessons', 'App\Http\Controllers\LessonController@index')->name('lesson.index');
Route::get('/lessons/create', 'App\Http\Controllers\LessonController@create')->name('lesson.create');
Route::post('/lessons/save', 'App\Http\Controllers\LessonController@save')->name('lesson.save');
Route::get('/lessons/success', 'App\Http\Controllers\LessonController@success')->name('lesson.success');
Route::get('/lessons/{id}', 'App\Http\Controllers\LessonController@show')->name('lesson.show');
Route::delete('/lessons/{id}', 'App\Http\Controllers\LessonController@delete')->name('lesson.delete');

// orders routes
Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index');
Route::get('/orders/create', 'App\Http\Controllers\OrderController@create')->name('order.create');
Route::post('/orders/save', 'App\Http\Controllers\OrderController@save')->name('order.save');
Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show');
Route::delete('/orders/{id}', 'App\Http\Controllers\OrderController@delete')->name('order.delete');

// instrument routes
Route::get('/instruments', 'App\Http\Controllers\InstrumentController@index')->name('instrument.index');
Route::get('/instruments/create', 'App\Http\Controllers\InstrumentController@create')->name('instrument.create');
Route::get('/instruments/{id}', 'App\Http\Controllers\InstrumentController@show')->name('instrument.show');
Route::post('/instruments/save', 'App\Http\Controllers\InstrumentController@save')->name('instrument.save');
Route::delete('/instruments/{id}', 'App\Http\Controllers\InstrumentController@delete')->name('instrument.delete');

// stock routes
Route::get('/stocks', 'App\Http\Controllers\StockController@index')->name('stock.index');
Route::get('/stocks/{id}', 'App\Http\Controllers\StockController@show')->name('stock.show');
Route::post('/stocks/{id}/add', 'App\Http\Controllers\StockController@addStock')->name('stock.add');
Route::post('/stocks/{id}/lower', 'App\Http\Controllers\StockController@lowerStock')->name('stock.lower');
Route::delete('/stocks/{id}/delete', 'App\Http\Controllers\StockController@delete')->name('stock.delete');

// reviews routes
Route::get('/instruments/{id}/create-review', 'App\Http\Controllers\ReviewController@create')->name('review.create');
Route::post('/instruments/{id}/save-review', 'App\Http\Controllers\ReviewController@save')->name('review.save');

// cart routes
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/add/{id}/{type}', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::get('/cart/removeAll/', 'App\Http\Controllers\CartController@removeAll')->name('cart.removeAll');

/*
Route::middleware([CheckGroup::class.':user'])->group(function () {

});

Route::middleware([])->group(function () {
});
*/

Auth::routes();
