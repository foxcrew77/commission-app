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

    public function workmenDropdown()
    {
        // $workmen = Workman::orderBy('id', 'DESC')->get();
        $workmen = Workman::select('name','slug')->orderBy('id','desc')->get(); 
    
        return $workmen;
        // return [
        //     {
        //         "id": 33,
        //         "slug": "jane-doe",
        //         "name": "Jane Doe",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 6,
        //         "created_at": "2024-05-13T13:25:00.000000Z",
        //         "updated_at": "2024-05-13T13:25:00.000000Z"
        //     },
        //     {
        //         "id": 32,
        //         "slug": "joe",
        //         "name": "Joe",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 6,
        //         "created_at": "2024-05-13T13:10:03.000000Z",
        //         "updated_at": "2024-05-13T13:10:03.000000Z"
        //     },
        //     {
        //         "id": 31,
        //         "slug": "joe",
        //         "name": "Joe",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 6,
        //         "created_at": "2024-05-13T13:08:55.000000Z",
        //         "updated_at": "2024-05-13T13:08:55.000000Z"
        //     },
        //     {
        //         "id": 30,
        //         "slug": "joe",
        //         "name": "Joe",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 6,
        //         "created_at": "2024-05-13T13:08:48.000000Z",
        //         "updated_at": "2024-05-13T13:08:48.000000Z"
        //     },
        //     {
        //         "id": 29,
        //         "slug": "hanif",
        //         "name": "Hanif",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 6,
        //         "created_at": "2024-05-13T11:58:20.000000Z",
        //         "updated_at": "2024-05-13T11:58:20.000000Z"
        //     },
        //     {
        //         "id": 28,
        //         "slug": "F9Bjh",
        //         "name": "En Kuong Xiu",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 1,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 27,
        //         "slug": "VOkI3",
        //         "name": "Haji Wan Rehan bin Ridzwan",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "INACTIVE",
        //         "user_id": 3,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 26,
        //         "slug": "Vr3Oz",
        //         "name": "Nurshammeza binti Che Adnan",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 1,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 25,
        //         "slug": "5soX6",
        //         "name": "Fakhira Osman binti Afif",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 1,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 24,
        //         "slug": "72RoX",
        //         "name": "V.  Varman",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "INACTIVE",
        //         "user_id": 1,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 23,
        //         "slug": "OXHj6",
        //         "name": "Hazira Zamre",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 2,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 22,
        //         "slug": "xYJT4",
        //         "name": "Muhammad Haji Mie bin Nasir",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "INACTIVE",
        //         "user_id": 2,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 21,
        //         "slug": "qdnEi",
        //         "name": "Isaac Hang Gin Bung",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 20,
        //         "slug": "n0suS",
        //         "name": "Priya Jeevananthan a/l Nethaji Shanmuganathan",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 2,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 19,
        //         "slug": "cKqgb",
        //         "name": "Nor Shakinah binti Arif",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 1,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 18,
        //         "slug": "RKA0x",
        //         "name": "S. A. Zabrina",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 3,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 17,
        //         "slug": "UAWps",
        //         "name": "Gong Tao Kim",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "INACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 16,
        //         "slug": "sPrYw",
        //         "name": "Daniel Hooi Fong Ho",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "INACTIVE",
        //         "user_id": 2,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 15,
        //         "slug": "XhOEy",
        //         "name": "Ying Zen Ee",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 14,
        //         "slug": "8XD2m",
        //         "name": "Thun Chean Yit",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 13,
        //         "slug": "wujr4",
        //         "name": "Sangeeta a/l Sanisvara Kundargal",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 1,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 12,
        //         "slug": "PhMH4",
        //         "name": "Nur Aimuni Margono binti Shahrol",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 3,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 11,
        //         "slug": "9XmXG",
        //         "name": "Yiaw Heong Liau",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 3,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 10,
        //         "slug": "j0jJR",
        //         "name": "Pang Liao Pui",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 9,
        //         "slug": "DwYMX",
        //         "name": "Nurul Dalila Aizam binti Sukarni Zaimi",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 3,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 8,
        //         "slug": "tnd8F",
        //         "name": "Pushpa a/l Weeratunge",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 7,
        //         "slug": "7Qo1Y",
        //         "name": "Asha a/l Balden",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 6,
        //         "slug": "LGnRt",
        //         "name": "Lai Shum Yin",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "INACTIVE",
        //         "user_id": 3,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 5,
        //         "slug": "WaS3m",
        //         "name": "Chris Zhang Beng Xiang",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "ACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 4,
        //         "slug": "q1FTp",
        //         "name": "Mohd Haji Iraman bin Hassimon",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "INACTIVE",
        //         "user_id": 1,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 3,
        //         "slug": "FYVn9",
        //         "name": "Nor Pesona binti Jani Fuzi",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "INACTIVE",
        //         "user_id": 2,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 2,
        //         "slug": "m0NhI",
        //         "name": "Nur Norsyafiqah Khairani binti Latif",
        //         "position": "workman",
        //         "outlet": "KKIP",
        //         "status": "INACTIVE",
        //         "user_id": 4,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     },
        //     {
        //         "id": 1,
        //         "slug": "yOOsh",
        //         "name": "Anita Lakshmi a/l Thirumurugan",
        //         "position": "workman",
        //         "outlet": "KK2",
        //         "status": "ACTIVE",
        //         "user_id": 1,
        //         "created_at": "2024-05-09T14:05:51.000000Z",
        //         "updated_at": "2024-05-09T14:05:51.000000Z"
        //     }
        // ]
    }
}
