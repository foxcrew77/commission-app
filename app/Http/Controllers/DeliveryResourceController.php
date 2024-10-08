<?php

namespace App\Http\Controllers;

use App\Models\Delivery_trip;
use App\Models\Lorry;
use App\Models\Driver;
use App\Models\Workman;
use App\Models\User;
use App\Models\DeliveryView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class DeliveryResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $model;

    // public function __construct(Delivery_trip $model)
    // {
    //     $this->model = $model;
    // }


    public function index(Request $request)
    {
        // dd($request->query());
        $workmen = Workman::orderBy('name','asc')->get(); 
        $drivers = Driver::orderBy('name','asc')->get(); 
        $lorries = Lorry::orderBy('capacity','ASC')->get();
        // $delivery_trips = Delivery_trip::orderBy('id','desc');
        // $trip_date = $request->query('trip_date');
        // $lorry = $request->query('lorry');
        // $driver = $request->query('driver');
        // $workman = $request->query('workmen');
        // $outlet = $request->query('outlet');
        // $total_weight = $request->query('total_weight');

        $query = Delivery_trip::query()->orderBy('id', 'desc')->sortable();

        if(!empty($request->query('trip_date')) && $request->query('trip_date') !== null){
            $query->where('trip_date',$request->query('trip_date'));
        }

        if(!empty($request->query('lorry')) && $request->query('lorry') !== null){
            $query->whereHas('lorries', function($q) use ($request){
                $q->where('id',$request->query('lorry'));
            });
        }

        if(!empty($request->query('driver')) && $request->query('driver') !== null){
            $query->whereHas('drivers', function($q) use ($request){
                $q->where('id',$request->query('driver'));
            });
        }

        if(!empty($request->query('workmen')) && $request->query('workmen') !== null){
            $query->whereHas('workmen', function($q) use ($request){
                $q->where('id',$request->query('workmen'));
            });
        }

        if(!empty($request->query('total_weight')) && $request->query('total_weight') !== null){
            $query->where('total_weight',$request->query('total_weight'));
        }

        if(!empty($request->query('outlet')) && $request->query('outlet') !== null){
            $query->whereHas('lorries', function($q) use ($request){
                $q->where('outlet',$request->query('outlet'));
            });
        }

        $delivery_trip = $query->paginate(10)
        ->appends($request->all());
        
        // $delivery_trip = DeliveryView::sortable()->orderBy('id','desc')->paginate(10);
        
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
        $lorries = Lorry::orderBy('capacity','ASC')->get();
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
        // $workmen = Workman::orderBy('name','asc')->get(); 
        // $drivers = Driver::orderBy('name','asc')->get(); 
        // $lorries = Lorry::orderBy('capacity','ASC')->get();
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
    public function edit(Delivery_trip $deliverytrip)
    {
        $workmen = Workman::orderBy('name','asc')->get(); 

        $selectedWorkmen = $deliverytrip->workmen()->get();
        $workmenList = [];
        foreach($selectedWorkmen as $w){
            array_push($workmenList,$w);
        }
        $workmenList;


        $drivers = Driver::orderBy('name','asc')->get(); 
        $lorries = Lorry::orderBy('capacity','ASC')->get();
        return view('admin.deliverytrip.edit', [
            'delivery_trip' =>  $deliverytrip,
            'lorries' => $lorries,
            'drivers' => $drivers,
            'workmen' => $workmen,
            'workmenList' => $workmenList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery_trip $delivery_trip)
    {
        $rules = $request->validate([
            'trip_date' => 'required',
            'total_weight' => 'required',
            'lorry' => 'required',
            'driver' => 'required',
            'workmen' => 'required',
            'outlet' => 'required|max:255',
        ]);

        if($request->slug != $delivery_trip->slug){
            $rules['slug'] = 'required|unique:delivery_trips|max:255';
        }

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id

        Delivery_trip::where('id', $delivery_trip->id)
        ->update($validatedData);
        
        return redirect(route('admin.deliverytrip.index'))->with('success','Delivery trip has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery_trip $delivery_trip)
    {
        Delivery_trip::destroy($delivery_trip->id);
        return redirect(route('admin.deliverytrip.index'))->with('success', 'Delivery trip has been deleted.');
    }

    public function DriverMonthlyCommission(Request $request){
        // dd($request);
    }
}
