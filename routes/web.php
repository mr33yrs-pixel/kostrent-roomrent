<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;

// Visitor routes — visit logging applies only here, not on admin or language switcher
Route::middleware([\App\Http\Middleware\LogVisit::class])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
});

// Language Switcher — no visit logging needed (it's just a redirect)
Route::get('/language/{locale}', [PageController::class, 'switchLanguage'])
    ->where('locale', 'en|id')
    ->name('language.switch');
