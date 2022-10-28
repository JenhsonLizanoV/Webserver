<?php

<<<<<<< HEAD
=======
use App\Http\Controllers\PostCommentController;
>>>>>>> 26fe21fcfc591448412209005741297683ae6a55
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
<<<<<<< HEAD
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
=======
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store']);
>>>>>>> 26fe21fcfc591448412209005741297683ae6a55
