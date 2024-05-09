<?php

namespace App\Http\Controllers;

use App\Models\Lorry;
use App\Models\User;
use Illuminate\Http\Request;

class LorryResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lorries = Lorry::orderBy('id', 'DESC')->paginate(10);
        
        return view('admin.lorry.index', [
            'lorries' => $lorries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lorry.create',[
            'title' => 'Add New Lorry',
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
        
        $validatedData['user_id'] = auth()->user()->id; //take current user as user_id

        Lorry::create($validatedData);

        return redirect(route('admin.lorry.index'))->with('success', 'New Lorry has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lorry $lorry)
    {
        $created_by = User::find($lorry->user_id);
        return view('admin.lorry.show', [
            'lorry' =>  $lorry,
            'created_by' => $created_by,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lorry $lorry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lorry $lorry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lorry $lorry)
    {
        //
    }
}
