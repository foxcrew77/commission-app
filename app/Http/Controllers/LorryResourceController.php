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
        //
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
