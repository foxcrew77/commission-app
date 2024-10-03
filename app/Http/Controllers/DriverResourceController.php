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
    public function index(Request $request)
    {
        
        $status = $request->query('status');
        $filterBy = $request->query('filterBy');
        $filter = $request->query('filter');

        if(!empty($request->query())){
            if(empty($request->query('filterBy'))){
                $filterBy = 'name';
            }
            $drivers = Driver::sortable()
            ->where($filterBy , 'like', '%'.$filter.'%')
            ->where('status', 'like', $status.'%')
            ->paginate(10);
        } else {
            $drivers = Driver::sortable()->paginate(10);
        }
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
            'title' => 'Add New Driver'
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
            return redirect(route('admin.driver.create'))->with('failed', 'The staff you have entered already exists!');
        } else {

            $request->merge([  //replace name with new value
                'name' => implode(' ',array_map('ucfirst', explode(' ',$request->name))),
            ]);
            $validatedData = $request->validate([
                'slug' => 'required|unique:drivers|max:255',
                'name' => 'required|max:255',
                'position' => 'required|max:255',
                'outlet' => 'required|max:255',
                'status' => 'required'
            ]);
        
            $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id
        
            Driver::create($validatedData);
            $asWorkman_id = Driver::orderBy('created_at', 'desc')->first()->id;
            Workman::create($validatedData +
            [
                'asWorkman_id' => $asWorkman_id,
            ]); //save the driver as workman as well

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
        return view('admin.driver.edit',[
            'driver' => $driver,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        // Request contain new data 
        // $driver contain old data (passed)
        $rules = [
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'outlet' => 'required|max:255',
            'status' => 'required'
        ];

        if($request->slug != $driver->slug){
            $rules['slug'] = 'required|unique:drivers|max:255';
        }

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id

        Driver::where('id', $driver->id)
        ->update($validatedData);
        
        return redirect(route('admin.driver.index'))->with('success','Driver has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        Driver::destroy($driver->id);
        return redirect(route('admin.driver.index'))->with('success', 'Driver has been deleted.');
    }
}
