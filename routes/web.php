<?php

use App\Http\Controllers\DropdownController;
use App\Http\Controllers\HomeController;
use App\Models\Country;
use App\Models\Course;
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


Route::get('/create-country',function(){
    Country::create([
        'name'=>'Australia'
    ]);
    Country::create([
        'name'=>'New Zealand'
    ]);
    Country::create([
        'name'=>'UK'
    ]);
    Country::create([
        'name'=>'Canada'
    ]);
    Country::create([
        'name'=>'USA'
    ]);
});

Route::get('/create-course-institute',function(){
    $institute = Institute::get();
    $institute[1]->course()->attach([3,5]);
    $institute[2]->course()->attach([6,7]);
    $institute[3]->course()->attach([7,9]);
    $institute[4]->course()->attach([10,12,13]);
    $institute[5]->course()->attach([8,11]);
    $institute[6]->course()->attach([5,7]);
});

Route::get('/create-course',function(){
    $level = StudyLevel::get();
    $level[0]->course()->create([
        'name'=>'Horticulture'
    ]);
    $level[0]->course()->create([
        'name'=>'Anthropology'
    ]);
    $level[1]->course()->create([
        'name'=>'Dance'
    ]);
    $level[2]->course()->create([
        'name'=>'Journalism'
    ]);
    $level[2]->course()->create([
        'name'=>'Hospitality'
    ]);
    $level[2]->course()->create([
        'name'=>'Carpentry'
    ]);
    $level[3]->course()->create([
        'name'=>'Library'
    ]);
    $level[3]->course()->create([
        'name'=>'Recreation'
    ]);
    $level[4]->course()->create([
        'name'=>'Museum'
    ]);
    $level[4]->course()->create([
        'name'=>'Community development'
    ]);
    $level[5]->course()->create([
        'name'=>'Accounting'
    ]);
    $level[6]->course()->create([
        'name'=>'Animation'
    ]);
    $level[6]->course()->create([
        'name'=>'Marine science'
    ]);
});
Route::get('/create-institute',function(){
    $country = Country::get();
    $country[0]->institute()->create([
        'university'=>'ACAP',
        'intake' => 'Jan,Feb'
    ]);
    $country[0]->institute()->create([
        'university'=>'Alphacrucis College',
        'intake' => 'Feb,Apr'
    ]);
    $country[1]->institute()->create([
        'university'=>'ACG Parnell College',
        'intake' => 'Sep,Dec'
    ]);
    $country[2]->institute()->create([
        'university'=>'Bangor University',
        'intake' => 'Feb,Apr'
    ]);
    $country[2]->institute()->create([
        'university'=>'De Montford University',
        'intake' => 'Jan,Feb'
    ]);
    $country[3]->institute()->create([
        'university'=>'Accelerate',
        'intake' => 'Feb,Apr'
    ]);
    $country[3]->institute()->create([
        'university'=>'College of the Rockies',
        'intake' => 'Mar,Apr'
    ]);
});

Route::get('/create-study-level',function(){
    StudyLevel::create([
        'name'=>'Pre-graduate'
    ]);
    StudyLevel::create([
        'name'=>'Graduate Certificate'
    ]);
    StudyLevel::create([
        'name'=>'Honours'
    ]);
    StudyLevel::create([
        'name'=>'Diploma'
    ]);
    StudyLevel::create([
        'name'=>'Postgraduate'
    ]);
    StudyLevel::create([
        'name'=>'Undergraduate'
    ]);
    StudyLevel::create([
        'name'=>'Doctorate'
    ]);
    StudyLevel::create([
        'name'=>'Foundation'
    ]);
});

Route::get('institute-course', function () {
    $institute = Institute::get();
    $institute[1]->course()->attach([2,4,5]);
});
