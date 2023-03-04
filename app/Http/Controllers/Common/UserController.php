<?php
namespace App\Http\Controllers\Common;
use DB;
use Hash;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use App\Helpers\ErrorTryCatch;

class UserController extends Controller
{
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                return redirect('login');
            }
            return $next($request);
        });

        $this->middleware('permission:users-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:users-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $data = User::wherecreated_by_user_id($User->id)->latest();
            } else {
                $data = User::whereNot('user_type','=','Super Admin')->latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                         if ($User->can('users-edit')) {
                        $btn = '<a href=' . route(request()->segment(1) . '.users.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
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

            return view('backend.common.users.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('backend.common.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        Toastr::success("User Update Successfully", "Success");
        return redirect()->route(request()->segment(1) . '.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.common.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(decrypt($id));
        // $roles = Role::pluck('name','name')->all();
        // $userRole = $user->roles->pluck('name','name')->all();

        return view('backend.common.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
           ]);

       

        $user = User::find($id);
        $user->name =$request->name;
        $user->email =$request->email;
        $user->status =$request->status;
        if($request->password !==null){
            $this->validate($request, [
                'password' => 'required|min:8|max:30|same:confirm-password',
                ]);
         $user->password =Hash::make($request->password);
        }
       
        $user->save();
        // DB::table('model_has_roles')->where('model_id',$id)->delete();

        // $user->assignRole($request->input('roles'));
        Toastr::success("User Update Successfully", "Success");
        return redirect()->route(request()->segment(1) . '.users.index');
    }
    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        if ($user->save()) {
            return 1;
        }
        return 0;
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
