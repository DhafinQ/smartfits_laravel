<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'feedbacks';
    protected $fillable = ['user_id','keterangan','status','tgl_feedback'];
    protected $casts = ['tgl_feedback' => 'datetime','user_id' => 'string'];

    public function feedback(){
        return $this->belongsTo(User::class,'user_id','_id');
    }

}
