<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class DeliveryView extends Model
{
    use sortable;
    use HasFactory;
    public function delivery_trips(){
        return $this->belongsToMany(Delivery_trip::class);
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
}
