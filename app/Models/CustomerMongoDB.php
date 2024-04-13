<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class CustomerMongoDB extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'listusers';
    protected $fillable = ['guid','name','email','tgl_lahir','tp_aktivitas'];
    protected $casts = ['tgl_lahir' => 'datetime'];

    
}
