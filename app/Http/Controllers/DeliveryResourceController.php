<?php

namespace App\Http\Controllers;

use App\Models\Delivery_trip;
use App\Models\Lorry;
use App\Models\Driver;
use App\Models\Workman;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class DeliveryResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        // $delivery_lorry = Delivery_trip::first()->lorries()->get();

        $workmen = Workman::orderBy('name','asc')->get(); 
        $drivers = Driver::orderBy('name','asc')->get(); 
        $lorries = Lorry::orderBy('capacity','ASC')->get()->unique('capacity');
        

        $trip_date = $request->query('trip_date');
        $lorry = $request->query('lorry');
        $driver = $request->query('driver');
        $workman = $request->query('workmen');
        $outlet = $request->query('outlet');
        $total_weight = $request->query('total_weight');
        // $trip->lorry()->get() as $lorry
        // $trip->driver()->get() as $driver
        // $trip->workmen()->get() as $workman

        // $test = DB::table('delivery_trip_lorry')->select('lorry_id')->first();
        $delivery_trip = Delivery_trip::orderBy('id', 'DESC')
        ->select('id','trip_date','lorry_id','driver_id','workman_id','total_weight','created_at','updated_at')
        ->join('delivery_trip_lorry_details', 'delivery_trips.id', '=', 'delivery_trip_lorry_details.delivery_trip_id')
        ->join('delivery_trip_driver', 'delivery_trips.id', '=', 'delivery_trip_driver.delivery_trip_id')
        ->join('delivery_trip_workman', 'delivery_trips.id', '=', 'delivery_trip_workman.delivery_trip_id')
        ;
        // if(!empty($request->query())){
        //     $delivery_trip = Delivery_trip::where('total_weight' , 'like', '%' . $request->query('total_weight') . '%')
        //     ->orWhere('trip_date' , 'like', '%' . $request->query('trip_date') . '%')->get();
        // }

        // $delivery_trip = Delivery_trip::select('id', 'trip_date','total_weight')->with('delivery_trip_lorry_details')->get();
        // dd($delivery_trip);
        // ->get();
        // ->sortable();
        // ->skip(0)->take(1000);
        // dd($delivery_trip);
        // dd($delivery_trips);
        
        
         // if(!empty($request->query('workman'))){
            //     $delivery_trip_workman = DB::table('delivery_trip_workman')
            //         ->select('delivery_trip_id')
            //         ->where('delivery_trip_workman.workman_id','=','81')
            //         ->get();
            //     dd($delivery_trip_workman);

        // $delivery_trip = Delivery_trip::orderBy('id', 'DESC');
        // $delivery_trip = Delivery_trip::orderBy('id', 'DESC')
        if(!empty($request->query())){
            $delivery_trip
                ->where('trip_date','=',$trip_date)
                ->where('lorry_id','=',$lorry)
                ->where('driver_id','=',$driver)
                ->where('workman_id','=',$workman)
                ->where('outlet','=',$outlet)
                ->where('total_weight','=',$total_weight)
                ->paginate(10);
        } elseif(empty($request->query())) {
            $delivery_trip = Delivery_trip::orderBy('id', 'DESC')->paginate(10);
        }
        
        // $delivery_trip = DB::table('delivery_trip_complete;')->get();
        // dd($delivery_trip);
        // if(!empty($request->query())){
        //     $delivery_trip = Delivery_trip::sortable()
        //     ->where($filterBy , 'like', '%'.$filter.'%')
        //     ->where('status', 'like', $status.'%')
        //     ->paginate(10);
        // } elseif(empty($request->query())) {
        //     $delivery_trip = Delivery_trip::sortable()
        //     ->paginate(10);
        // }
        // return view('admin.lorry.index', [
        //     'lorries' => $lorries,
        // ]);
        // $delivery_trip = Delivery_trip::orderBy('id', 'DESC')->paginate(20);
        return view('admin.deliverytrip.index', [
            'delivery_trip' => $delivery_trip,
            'lorries' => $lorries,
            'drivers' => $drivers,
            'workmen' => $workmen,
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
        // $workmenJson = json_encode($workmen);
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
        $dailyTripCount = Delivery_trip::where('trip_date', '=', $request->trip_date)->get()->count()+1;
        $dailyLorryCount = Delivery_trip::whereHas('lorries', function ($query) use ($request) {
            $query->where('lorry_id', '=', explode("-",$request->lorry)[0])
            ->where('trip_date', '=', $request->trip_date);
        })->get()->count()+1;
        
        
        $request->merge([  
            'slug' => str_replace("-","",$request->trip_date)."-".str_replace(" ","",explode("-",$request->lorry)[1])."-".$dailyTripCount."-".$dailyLorryCount,
            'outlet' => Lorry::where('id', explode("-",$request->lorry)[0])->pluck("outlet")->first()
        ]);

        $validatedData = $request->validate([
            'slug' => 'required|unique:delivery_trips|max:255',
            'trip_date' => 'required',
            'total_weight' => 'required',
            'lorry' => 'required',
            'driver' => 'required',
            'workmen' => 'required',
            'outlet' => 'required|max:255',
        ]);
        // $entrySlug = $request->slug;
        $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id
        $delivery = new Delivery_trip();  //create instance from class
        $delivery->fill($validatedData);  //fill instance with validated data
        $delivery->save();
        $delivery->lorries()->attach(explode("-",$request->lorry)[0]);
        $delivery->drivers()->attach($request->driver);
        $delivery->workmen()->attach($request->workmen);

        return redirect(route('admin.deliverytrip.index'))->with('success', 'New Delivery Trip has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery_trip $deliverytrip)
    {
        $created_by = User::find($deliverytrip->user_id);
        $outlet = $deliverytrip->lorries()->get()[0]->outlet;
        return view('admin.deliverytrip.show', [
            'delivery_trip' =>  $deliverytrip,
            'created_by' => $created_by,
            'outlet' => $outlet
        ]);
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

    public function DriverMonthlyCommission(Request $request){
        // dd($request);
    }
}
