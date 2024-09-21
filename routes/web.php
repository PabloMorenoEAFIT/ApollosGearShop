<?php

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
Route::get('/orders/success', 'App\Http\Controllers\OrderController@success')->name('order.success');
Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show');
Route::delete('/orders/{id}', 'App\Http\Controllers\OrderController@delete')->name('order.delete');
