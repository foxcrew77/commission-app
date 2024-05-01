<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery_trip extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lorries(){
        return $this->belongsToMany(Lorry::class);
    }

    public function drivers(){
        return $this->belongsToMany(Driver::class);
    }

    public function workmen(){
        return $this->belongsToMany(Workman::class);
    }
}
