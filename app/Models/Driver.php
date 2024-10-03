<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Driver extends Model
{
    use sortable;
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $sortable = [
        'name',
        'outlet',
        'status',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function delivery_trips(){
        return $this->belongsToMany(Delivery_trip::class);
    }

    // public function workman(){
    //     return $this->hasOne(Driver::class, 'delivery_trip_driver', 'delivery_trip_id', 'driver_id');
    // }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
