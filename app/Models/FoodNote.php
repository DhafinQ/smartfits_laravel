<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class FoodNote extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'food_notes';
    protected $fillable = ['customer_id','nama_makanan','jadwal_makan','qty','kalori','tgl_note'];
    protected $casts = ['tgl_note' => 'datetime','customer_id' => 'string'];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','_id');
    }

    public function sumKalori($tgl){
        if($this->tgl_note == $tgl){
            return $this->kalori;
        }
    }
}
