<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery_trip;
use App\Models\Lorry;

class DeliveryController extends Controller
{

    public function index(){
        // $delivery_lorry = Delivery_trip::first()->lorries()->get();
        $delivery_trip = Delivery_trip::orderBy('id', 'DESC')->paginate(20);
        
        return view('admin.deliverytrip', [
            'delivery_trip' => $delivery_trip,
        ]);
    }
}
