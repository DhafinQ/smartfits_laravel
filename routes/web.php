<?php

use Akaunting\Apexcharts\Chart;
use App\Http\Controllers\FeedBackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodNoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\FoodNote;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});


// ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/plan', [ProfileController::class, 'userPlan'])->name('profile.plan');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/feedback',[FeedBackController::class, 'store'])->name('feedback.store');

    
    Route::get('/dashboard', [FoodNoteController::class,'dashboard'])->name('dashboard');
    
    Route::get('/jadwal-makan/{jadwal?}', [FoodNoteController::class, 'index'])->name('foodnote.index');
    Route::get('/tambah-makan/{kategori}/{jadwal?}', [FoodNoteController::class, 'create'])->name('foodnote.create');
    Route::post('/tambah-makan/{kategori}', [FoodNoteController::class, 'store'])->name('foodnote.store');
    Route::get('/edit-makan/{foodNote}', [FoodNoteController::class, 'edit'])->name('foodnote.edit');
    Route::patch('/update-makan/{foodNote}', [FoodNoteController::class, 'update'])->name('foodnote.update');
    Route::delete('/delete-makan/{foodNote}', [FoodNoteController::class, 'destroy'])->name('foodnote.delete');

});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->name('buttons.text-icon');

require __DIR__ . '/auth.php';
