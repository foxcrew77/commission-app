<?php

namespace App\Http\Controllers;

use App\Models\Workman;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class WorkmanResourceController extends Controller
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
            $workmen = Workman::sortable()
            ->where($filterBy , 'like', '%'.$filter.'%')
            ->where('status', 'like', $status.'%')
            ->paginate(10);
        } else {
            $workmen = Workman::sortable()->paginate(10);
        }
        return view('admin.workman.index', [
            'workmen' => $workmen,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.workman.create',[
            'title' => 'Add New Workman'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $found = Workman::where('slug',$request->slug)->count();
        $found += Driver::where('slug',$request->slug)->count();
        // dd($request);
        if($found != 0) {
            return redirect(route('admin.workman.create'))->with('failed', 'The staff you have entered already exists');
        } else {
            $request->merge([  //replace name with new value
                'name' => implode(' ',array_map('ucfirst', explode(' ',$request->name))),
            ]);
            $validatedData = $request->validate([
                'slug' => 'required|unique:lorries|max:255',
                'name' => 'required|max:255',
                'position' => 'required|max:255',
                'outlet' => 'required|max:255',
                'status' => 'required',
                'asWorkman_id' => 'required'
            ]);
        
            $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id
            Workman::create($validatedData);

            return redirect(route('admin.workman.index'))->with('success', 'New Workman has been added.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Workman $workman)
    {
        $created_by = User::find($workman->user_id);
        return view('admin.workman.show', [
            'workman' =>  $workman,
            'created_by' => $created_by
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workman $workman)
    {
        return view('admin.workman.edit',[
            'workman' => $workman,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workman $workman)
    {
        // Request contain new data 
        // $driver contain old data (passed)
        $rules = [
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'outlet' => 'required|max:255',
            'status' => 'required'
        ];

        if($request->slug != $workman->slug){
            $rules['slug'] = 'required|unique:drivers|max:255';
        }

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id

        Workman::where('id', $workman->id)
        ->update($validatedData);
        
        return redirect(route('admin.workman.index'))->with('success','Workman has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workman $workman)
    {
        workman::destroy($workman->id);
        return redirect(route('admin.workman.index'))->with('success', 'Workman has been deleted.');
    }

    public function workmenDropdown()
    {
        // $workmen = Workman::orderBy('id', 'DESC')->get();
        $tempCollection = collect([\App\Models\Workman::all(), \App\Models\Driver::all()]);
            //combined collection 

        //combined collection 
        $Collection = $tempCollection->flatten(1)
            //   ->sortBy("name");
            ->shuffle()
            ->sortBy("name")
            ;
    
    }
}
