<?php

namespace App\Http\Controllers;

use App\Models\Workman;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;

class WorkmanResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workmen = Workman::orderBy('id', 'DESC')->paginate(20);
        
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
            'title' => 'Add New Delivery Trip'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $found = Workman::where('slug',$request->slug)->count();
        $found += Driver::where('slug',$request->slug)->count();
        if($found != 0) {
            return redirect(route('admin.workman.create'))->with('failed', 'Workman already exists!');
        } else {
            $request->merge([  //replace name with new value
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workman $workman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workman $workman)
    {
        //
    }
}
