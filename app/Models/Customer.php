<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'customers';
    protected $fillable = ['user_id','tipe_aktivitas','jekel','tgl_lahir'];
    protected $casts = ['tgl_lahir' => 'datetime','user_id' => 'string'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','_id');
    }

    public function foodnotes(){
        return $this->hasMany(FoodNote::class,'customer_id','_id');
    }

    public function getCalories(){
        $cal = 0;
        $age = Carbon::parse($this->tgl_lahir)->age;
        if($this->jekel == 'Laki-Laki'){
            if($age < 10){
                $cal = 1450;
            }else if($age < 50){
                $cal = 2450;
                if($this->tipe_aktivitas == 'Aktif'){
                    $cal += 100;
                }else if($this->tipe_aktivitas == 'Sangat Aktif'){
                    $cal += 250;
                }
            }else if($age < 80){
                $cal = 2050;
            }else if($age >= 80){
                $cal = 1600;
            }
        }

        if($this->jekel == 'Perempuan'){
            if($age < 10){
                $cal = 1450;
            }else if($age < 50){
                $cal = 2150;
                if($this->tipe_aktivitas == 'Aktif'){
                    $cal += 100;
                }else if($this->tipe_aktivitas == 'Sangat Aktif'){
                    $cal += 250;
                }
            }else if($age < 80){
                $cal = 1650;
            }else if($age >= 80){
                $cal = 1400;
            }
        }
        return $cal;
    }

}
