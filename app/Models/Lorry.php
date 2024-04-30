<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lorry extends Model
{
    use HasFactory;

    public function delivery_trip(){
        return $this->belongsTo(Delivery_trip::class);
    }
}
