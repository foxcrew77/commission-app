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
        $workmen = Workman::orderBy('name','asc')->get(); 
        $drivers = Driver::orderBy('name','asc')->get(); 
        $lorries = Lorry::orderBy('capacity','ASC')->get()->unique('capacity');
        $workmenJson = json_encode($workmen);
        return view('admin.deliverytrip.create', [
            'title' => 'Add New Delivery Trip',
            'lorries' => $lorries,
            'drivers' => $drivers,
            'workmen' => $workmen,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $letter = preg_split('/\d+/', $request->plate_no);
            $number = preg_match("/([0-9]+)/", $request->plate_no, $matches);

            $request->merge([  //replace plate_no with new value
            'plate_no' => strtoupper($letter[0]).' '.$matches[1].' '.strtoupper($letter[1]),
            ]);
            $validatedData = $request->validate([
                'slug' => 'required|unique:lorries|max:255',
                'plate_no' => 'required|max:255',
                'capacity' => 'required',
                'outlet' => 'required|max:255',
                'status' => 'required'
            ]);
        
            $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id

            Lorry::create($validatedData);

            return redirect(route('admin.lorry.index'))->with('success', 'New Lorry has been added.');
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
