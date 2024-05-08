<?php

namespace App\Http\Controllers;

use App\Models\Delivery_trip;
use App\Models\Lorry;
use App\Models\Driver;
use App\Models\Workman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DeliveryResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        // $delivery_lorry = Delivery_trip::first()->lorries()->get();
        $delivery_trip = Delivery_trip::orderBy('id', 'DESC')->paginate(20);
        return view('admin.deliverytrip.index', [
            'delivery_trip' => $delivery_trip,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lorries = Lorry::orderBy('capacity','ASC')->get()->unique('capacity');
        $drivers = Driver::orderBy('name','ASC')->get();
        $workmen = Workman::orderBy('name','ASC')->get();
        return view('admin.deliverytrip.create', [
            'title' => 'Add New Delivery Trip',
            'lorries' => $lorries,
            'drivers' => $drivers,
            'workmen' => $workmen
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery_trip $delivery_trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery_trip $delivery_trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery_trip $delivery_trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery_trip $delivery_trip)
    {
        //
    }
}