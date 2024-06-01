<?php

use App\Http\Controllers\Chatcontroller;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


Route::get('dashboard',[Chatcontroller::class,'dashboard'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::get('chat/{id}',[Chatcontroller::class,'chat'])
->middleware(['auth', 'verified'])
->name('chat');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
