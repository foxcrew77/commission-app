<?php

namespace App\Http\Controllers;

use App\Models\Workman;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Workman $workman)
    {
        //
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
