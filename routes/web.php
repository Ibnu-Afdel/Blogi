<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::controller(PostController::class)->group(function(){
    Route::get('/posts' , 'index')->name('posts.index') ;
    Route::get('/posts/create' , 'create')->name('posts.create') ;
    Route::post('/posts' , 'store')->name('posts.store') ;
    Route::get('/posts/{post}' , 'show')->name('posts.show') ;
    Route::get('/posts/{post}/edit' , 'edit')->name('posts.edit') ;
    Route::patch('/posts/{post}' , 'update')->name('posts.update') ;
    Route::delete('/posts/{post}' , 'destroy')->name('posts.destroy') ;
}) ;