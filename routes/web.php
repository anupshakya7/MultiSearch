<?php

use App\Http\Controllers\DropdownController;
use App\Http\Controllers\HomeController;
use App\Models\Country;
use App\Models\Institute;
use App\Models\StudyLevel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/search', [HomeController::class,'search'])->name('search');
Route::prefix('dropdown')->group(function () {
    Route::get('country/{id}', [DropdownController::class,'country'])->name('country');
});

Route::get('institute-course', function () {
    $institute = Institute::get();
    $institute[1]->course()->attach([2,4,5]);
});
