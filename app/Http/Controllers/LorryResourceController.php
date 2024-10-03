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
    public function index(Request $request)
    {
        $status = $request->query('status');
        $filterBy = $request->query('filterBy');
        $filter = $request->query('filter');
        if(!empty($request->query())){
            if(empty($request->query('filterBy'))){
                $filterBy = 'plate_no';
            }
            $lorries = Lorry::sortable()
            ->where($filterBy , 'like', '%'.$filter.'%')
            ->where('status', 'like', $status.'%')
            ->paginate(10);
        } elseif(empty($request->query())) {
            $lorries = Lorry::sortable()
            ->paginate(10);
        }
        return view('admin.lorry.index', [
            'lorries' => $lorries,
        ]);
    }

    // public function indexFiltering(Request $request)
    // {
    //     $filter = $request->query('filter');

    //     if(!empty($filter)){
    //         $lorries = Lorry::sortable()
    //         ->where('lorries.plate_no', 'like', '&'.$filter.'&')
    //         ->paginate(10);
    //     } else {
    //         $lorries = Lorry::sortable()
    //         ->paginate(10);
    //     }

    //     return view('admin.lorry.index', [
    //         'lorries' => $lorries,
    //     ])->with('filter', $filter);
    // }

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
        $found = Lorry::where('slug',$request->slug)->count();
        if($found != 0) {
            return redirect(route('admin.lorry.create'))->with('failed', 'Lorry already exists!');
        } else {
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
        return view('admin.lorry.edit', [
            'lorry' =>  $lorry,
            // 'created_by' => $created_by,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lorry $lorry)
    {
        // Request contain new data 
        // $Lorry contain old data (passed)
        $rules = [
            'plate_no' => 'required|max:255',
            'capacity' => 'required',
            'outlet' => 'required|max:255',
            'status' => 'required'
        ];

        if($request->slug != $lorry->slug){
            $rules['slug'] = 'required|unique:lorries|max:255';
        }

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = auth()->user()->id; //take current  user as user_id

        Lorry::where('id', $lorry->id)
        ->update($validatedData);
        
        return redirect(route('admin.lorry.index'))->with('success','Lorry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lorry $lorry)
    {
        Lorry::destroy($lorry->id);
        return redirect(route('admin.lorry.index'))->with('success', 'Lorry has been deleted.');
    }
}







