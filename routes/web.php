<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/contact', 'contact');

Route::controller(PostController::class)->group(function(){
    Route::get('/posts' , 'index')->name('posts.index') ;
    Route::get('/posts/create' , 'create')->name('posts.create') ;
    Route::post('/posts' , 'store')->name('posts.store') ;
    Route::get('/posts/{post}' , 'show')->name('posts.show') ;
    Route::get('/posts/{post}/edit' , 'edit')->name('posts.edit')
    ->middleware('auth')
    ->can('edit-post', 'post') ;
    Route::patch('/posts/{post}' , 'update')->name('posts.update') ;
    Route::delete('/posts/{post}' , 'destroy')->name('posts.destroy') ;
}) ;

Route::get('/register' , [RegistrationController::class , 'create'])->name('register.create') ;
Route::post('/register' , [RegistrationController::class , 'store'])->name('register.store') ;

Route::get('/login' , [SessionController::class , 'create'])->name('login.create') ;
Route::post('/login' , [SessionController::class , 'store'])->name('login.store') ;
Route::post('/logout' , [SessionController::class , 'logout'])->name('logout.store') ;