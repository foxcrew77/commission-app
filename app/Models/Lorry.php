<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Lorry extends Model
{
    use Sortable;
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $sortable = [
        'plate_no',
        'capacity',
        'outlet',
        'status',
        'created_at',
        'updated_at',
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
