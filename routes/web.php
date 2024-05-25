<?php

use Akaunting\Apexcharts\Chart;
use App\Http\Controllers\FeedBackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodNoteController;
use App\Http\Controllers\UsersController;
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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [FoodNoteController::class,'dashboard'])->name('dashboard');
    
    Route::middleware('role:client')->group(function (){
        Route::get('/profile/plan', [ProfileController::class, 'userPlan'])->name('profile.plan');
        Route::post('/feedback',[FeedBackController::class, 'store'])->name('feedback.store');
        Route::get('/jadwal-makan/{jadwal?}', [FoodNoteController::class, 'index'])->name('foodnote.index');
        Route::get('/tambah-makan/{kategori}/{jadwal?}', [FoodNoteController::class, 'create'])->name('foodnote.create');
        Route::post('/tambah-makan/{kategori}', [FoodNoteController::class, 'store'])->name('foodnote.store');
        Route::get('/edit-makan/{foodNote}', [FoodNoteController::class, 'edit'])->name('foodnote.edit');
        Route::patch('/update-makan/{foodNote}', [FoodNoteController::class, 'update'])->name('foodnote.update');
        Route::delete('/delete-makan/{foodNote}', [FoodNoteController::class, 'destroy'])->name('foodnote.delete');
    });

    Route::middleware('role:admin')->group(function (){
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('/users/{user}',[UsersController::class, 'show'])->name('users.show');
        Route::get('/users/edit/{user}',[UsersController::class, 'edit'])->name('users.edit');
        Route::patch('/users/update/{user}',[UsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}',[UsersController::class, 'destroy'])->name('users.delete');

        Route::get('/feedbacks',[FeedBackController::class,'index'])->name('feedback.index');
        Route::get('/feedbacks/{feedback}',[FeedBackController::class,'show'])->name('feedback.show');
        Route::get('/feedbacks/{feedback}/edit',[FeedBackController::class,'edit'])->name('feedback.edit');
        Route::patch('/feedbacks/{feedback}',[FeedBackController::class,'update'])->name('feedback.update');
        Route::delete('/feedbacks/{feedback}',[FeedBackController::class,'destroy'])->name('feedback.destroy');
    });

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
