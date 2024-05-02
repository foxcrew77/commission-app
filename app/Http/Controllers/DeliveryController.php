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
        // $delivery_lorry = Delivery_trip::with('lorries')->get();
        $delivery_lorry = Delivery_trip::where('id', '>', 10)->paginate(25)->get();
        $delivery_driver = Delivery_trip::with('drivers')->get();
        $delivery_workmen = Delivery_trip::with('workmen')->get();
        return view('admin.tables', [
            // 'delivery_trips' => Delivery_trip::all(),
            'delivery_lorry' => $delivery_lorry->paginate(25),
            // 'delivery_driver' => $delivery_driver,
            // 'delivery_workmen' => $delivery_workmen,
        ]);
    }
}
