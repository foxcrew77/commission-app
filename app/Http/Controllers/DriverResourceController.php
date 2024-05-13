<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Workman;
use App\Models\User;
use Illuminate\Http\Request;

class DriverResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::orderBy('id', 'DESC')->paginate(20);
        
        return view('admin.driver.index', [
            'drivers' => $drivers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.driver.create',[
            'title' => 'Add New Delivery Trip'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $found = Driver::where('slug',$request->slug)->count();
        $found += Workman::where('slug',$request->slug)->count();
        if($found != 0) {
            return redirect(route('admin.driver.create'))->with('failed', 'Driver already exists!');
        } else {

            $request->merge([  //replace plate_no with new value
                'name' => implode(' ',array_map('ucfirst', explode(' ',$request->name))),
            ]);
            $validatedData = $request->validate([
                'slug' => 'required|unique:lorries|max:255',
                'name' => 'required|max:255',
                'position' => 'required|max:255',
                'outlet' => 'required|max:255',
                'status' => 'required'
            ]);
        
            $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id

            Driver::create($validatedData);

            return redirect(route('admin.driver.index'))->with('success', 'New Driver has been added.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {   
        $created_by = User::find($driver->user_id);
        return view('admin.driver.show', [
            'driver' =>  $driver,
            'created_by' => $created_by,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
