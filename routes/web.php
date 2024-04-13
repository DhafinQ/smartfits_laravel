<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\FoodNote;

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
    return view('welcome');
});

Route::get('/bruh',function(){
    try{
        $date1 = Carbon::today()->subDay(1)->subHour(rand(13,19));
        $id = Auth::user()->_id;
        $success = Feedback::create([
            'user_id' => $id,
            'keterangan' => "Terdapat Bug Dibagian Form Benambahan Makan Siang, Kalori Yang Dimasukan Tidak Termasuk Kedalam Jumlah Kalori.",
            'tgl_note' => $date1,
            'status' => "Proses"
        ]);
        $msg = "Note Created!" . $success;
    }catch(\Exception $e){
        $msg = "Mongo Server Error. " . $e->getMessage();
    }

    return ['msg' => $msg];

});

Route::get('/dashboard', function () {
    $data = FoodNote::where('customer_id','=',Auth::user()->customer->_id)->get(['kalori']);
    $count = FoodNote::where('customer_id','=',Auth::user()->customer->_id)->count();
    return view('dashboard',compact('data','count'));
})->name('dashboard');
// ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
