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
        return $this->belongsToMany(Lorry::class, 'delivery_trip_lorry', 'delivery_trip_id', 'lorry_id');
        // ->withPivot(['lorry_id']);
    }

    public function drivers(){
        return $this->belongsToMany(Driver::class, 'delivery_trip_driver', 'delivery_trip_id', 'driver_id');
    }

    public function workmen(){
        return $this->belongsToMany(Workman::class, 'delivery_trip_workman', 'delivery_trip_id', 'workman_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
