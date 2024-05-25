<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'feedback';
    protected $fillable = ['user_id','subjek','keterangan','status'];
    protected $casts = ['user_id' => 'string'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','_id');
    }

}
