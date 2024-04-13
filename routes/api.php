<?php

use App\Models\CustomerMongoDB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test-api', function (Request $request) {
    $connect = DB::connection('mongodb');
    $msg = "Mongo Is Accessable";
    try{
        $connect->command(['PING' => 1]);
    }catch(\Exception $e){
        $msg = "Mongo Is Not Accessable " . $e->getMessage();
    }

    return ['Messsage' => $msg];
});

Route::get('/insert-customer/test', function(Request $request){
    try{
        $date = Carbon::today()->subYear(rand(12,30))->subMonth(rand(2,9))->subDay(2,16);
        $id = Auth::getUser()->_id;
        $success = CustomerMongoDB::create([
            'guid' => 'cstmr_1',
            'name' => 'Dhafin Qinthara K',
            'email' => 'dhafinq@gmail.com',
            'tgl_lahir' => $date->toString(),
            'tp_aktivitas' => 'Aktif'
        ]);
        $msg = "User Created!" . $success;
    }catch(\Exception $e){
        $msg = "Mongo Server Error. " . $e->getMessage();
    }
    $msg = Auth::user()->id;
    return ['msg' => $msg];
});
