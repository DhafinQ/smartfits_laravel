<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'customers';
    protected $fillable = ['user_id','tipe_aktivitas','tgl_lahir'];
    protected $casts = ['tgl_lahir' => 'datetime','user_id' => 'string'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','_id');
    }

    public function foodnotes(){
        return $this->hasMany(FoodNote::class,'customer_id','_id');
    }
}
