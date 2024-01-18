<?php

namespace App\Http\Controllers\Common;
use App\Models\Club;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use App\Helpers\ErrorTryCatch;
use Spatie\Permission\Models\Permission;
class ClubController extends Controller
{
    private $User ;
    function __construct(){

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                return redirect('login');
            }
            return $next($request);
        });

        $this->middleware('permission:club-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:club-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:club-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:club-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
               $User = $this->User;
                $data = Club::latest();
            
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                         if ($User->can('club-edit')) {
                        $btn = '<a href=' . route(request()->segment(1) . '.clubs.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
                         }
                        $btn .= '</span>';
                        return $btn;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status == 0) {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" onchange="updateStatus(this)" class="form-check-input"  value=' . $data->id . ' /></div>';
                        } else {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" checked="" onchange="updateStatus(this)" class="form-check-input"  value=' . $data->id . ' /></div>';
                        }
                    })
                    ->addColumn('image', function ($data) {
                        return '<a title="Click for View" data-lightbox="roadtrip" href="'.asset($data->image).'"><img id="demo-test-gallery" class="border-radius-lg shadow demo-gallery" src="' . asset($data->image) . '" height="40px" width="40px"  />';

                    })


                    ->rawColumns(['image', 'action', 'status'])
                    ->make(true);
            }

            return view('backend.common.clubs.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.common.clubs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

       $this->validate($request, [
        'club_name' => 'required',
        'contact_person' => 'required',
        'email' => 'required',
        'phones.*' => 'required',
        'division' => 'required',
        'upazila' => 'required',
        'union' => 'required',
        'address' => 'required',
        'image' => 'required',
     
    ]);
           
            $club =new Club();
            $club->user_id =Auth::id();
            $club->club_name = $request->club_name;
            $club->contact_person=$request->contact_person;
            $club->email=$request->email;
            $club->phones=json_encode($request->phones);
            $club->email=$request->email;
            $club->division=$request->division;
            $club->district=$request->district;
            $club->upazila=$request->upazila;
            $club->union=$request->union;
            $club->address=$request->address;
            $club->image=$request->image;
            $club->save();
          Toastr::success("Club Create  Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.clubs.index');
    
            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $club = Club::find(decrypt($id));
        return view('backend.common.clubs.edit',compact('club'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
       $this->validate($request, [
        'club_name' => 'required',
        'contact_person' => 'required',
        'email' => 'required',
        'phones.*' => 'required',
        'division' => 'required',
        'upazila' => 'required',
        'union' => 'required',
        'address' => 'required',
        'image' => 'required',
     
    ]);
           
            $club =Club::findOrFail($id);
            $club->user_id =Auth::id();
            $club->club_name = $request->club_name;
            $club->contact_person=$request->contact_person;
            $club->email=$request->email;
            $club->phones=json_encode($request->phones);
            $club->email=$request->email;
            $club->division=$request->division;
            $club->district=$request->district;
            $club->upazila=$request->upazila;
            $club->union=$request->union;
            $club->address=$request->address;
            $club->image=$request->image;
            $club->save();
             Toastr::success("Club Update  Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.clubs.index');
    
    }

    public function updateStatus(Request $request)
    {
        $club = Club::findOrFail($request->id);
        $club->status = $request->status;
        if ($club->save()) {
            return 1;
        }
        return 0;
    }
    public function destroy(string $id)
    {
        //
    }
}
