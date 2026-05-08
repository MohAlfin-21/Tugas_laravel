<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

Route::redirect('/', '/siswa');
Route::resource('siswa', SiswaController::class)->except(['show']);
