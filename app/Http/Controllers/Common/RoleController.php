<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Helpers\ErrorTryCatch;
use App\Helpers\Helper;

class RoleController extends Controller
{
    private $User;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        try {
            $User = $this->User;
          if($User->user_type == 'Super Admin') {
            $roles = Role::orderBy('id', 'DESC')->get();
          }
            else{
                    $roles = Role::where('name', '!=', 'Super Admin')->orderBy('id', 'DESC')->get();
                }
            if ($request->ajax()) {return Datatables::of($roles)
                    ->addIndexColumn()
                    ->addColumn('action', function ($roles) use ($User) {
                        $btn = '';
                        if ($User->can('role-edit')) {
                        $btn = '<a href=' . route(request()->segment(1) . '.roles.edit', $roles->id) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
                         }
                        $btn .= '</span>';
                        return $btn;
                    })
                    ->addColumn('permission' ,function($data){
                        $info=[];
                        foreach($data->permissions as  $v)
                            {
                              $info[]=$v->name.' ';
                              
                            }
                         return  $info;
                   
                  }) 
                    ->rawColumns(['action','permission'])
                    ->make(true);
            }

            return view('backend.common.roles.index');
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

      
        $permission = Permission::get();
        return view('backend.common.roles.create', compact('permission'));
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
            'name' => 'required|unique:roles,name',
            'permission.*' => 'required|min:1',
        ]);
     
        $role = Role::create(['name' => $request->input('name'),'guard_name'=>'web']);
        $role->syncPermissions($request->input('permission'));

        Toastr::success('Role Created Successfully ');
        return redirect()->route(request()->segment(1) . '.roles.index');
    }
    
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)

        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')

        ->all();

       
        return view('backend.common.roles.edit', compact('role', 'permission', 'rolePermissions'));
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
            'permission.*' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        
        Toastr::success('Role Created Successfully ');
        return redirect()->route(request()->segment(1) . '.roles.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
    }
}
