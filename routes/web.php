<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuangController;

Route::get('/', [HomeController::class, 'index']);

Route::get('login', [AuthController::class, 'loginView'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('home', [HomeController::class, 'index']);
Route::get('ruangan/{ruang}', [HomeController::class, 'getDataRuang']);
Route::post('ruangan/book', [HomeController::class, 'bookRuang']);
Route::delete('ruangan/event/{event_id}', [HomeController::class, 'deleteEvent'])->name('ruangan.event.destroy');
Route::get("print/event/{id}", [HomeController::class, 'setSurat'])->name('print.event');
Route::get("print/kgt/{id}", [HomeController::class, 'printSurat'])->name('print.kgt');
