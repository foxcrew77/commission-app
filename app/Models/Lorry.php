<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lorry extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function delivery_trips(){
        return $this->belongsToMany(Delivery_trip::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
