<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\lorry;

class Delivery_trip extends Model
{
    use HasFactory;
    public function lorry(){
        return $this->belongsTo(Lorry::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
