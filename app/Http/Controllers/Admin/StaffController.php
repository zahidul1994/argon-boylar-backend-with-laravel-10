<?php

namespace App\Http\Controllers\Admin;
// use App\Http\Traits\UserTrait;

use App\Models\User;
use App\Models\Route;
use App\Models\Employee;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use App\Models\ChartOfAccount;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\WarehouseChartOfAccount;

class StaffController extends Controller
{
    // use UserTrait;

    // function __construct()
    // {
    //      $this->middleware(function ($request, $next) {
    //     $this->User = Auth::user();
    //     if($this->User->status==0){
    //       $request->session()->flush();
    //       return redirect('login');
    //   }
    //     return $next($request);
    // });
    //     $this->middleware('permission:staffs-list', ['only' => ['index']]);
    //     $this->middleware('permission:staffs-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:staffs-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:staffs-delete', ['only' => ['destroy']]);
    // }

    public function index()
    {
        // dd('staff');
        // php 8 new featured => named argument no delete (Robiul)
        // $UserNamePHP8Argument = $this->getUserNamePHP8Argument(last_name:'Hasan',first_name:'Robi');
        // dd($UserNamePHP8Argument);
        // php 8 new featured => named argument no delete (Robiul)


        $users = User::latest()->get();

        return view('backend.staffs.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('status', 1)
            ->where('name', '!=', 'Super Admin')
            ->get();
        $warehouses = Warehouse::wherestatus(1)->select('name', 'id')->get();
        $routes = Route::wherestatus(1)->select('name', 'id')->get();
        return view('backend.common.staffs.create', compact('roles', 'warehouses','routes'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            //'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required',
             'warehouse_id' => 'required',
             'user_type' => 'required',
        ]);
        // try {
        //     DB::beginTransaction();
            $input = $request->all();
            $input['user_type'] = $request->user_type;
            $input['password'] = Hash::make($input['password']);
            $input['created_by_user_id'] = Auth::user()->id;
            $input['updated_by_user_id'] = Auth::user()->id;
            $input['status'] = 1;
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
             $warehouse_id=$request->warehouse_id;
            // create employee
            $employee = new Employee();
            $employee->user_id = $user->id;
            $employee->save();


            $headAccountDetail  = WarehouseChartOfAccount::wherewarehouse_id($warehouse_id)->where('head_name', 'ACCOUNT PAYABLES')->orderBy('id', 'desc')->first();
            if (empty($headAccountDetail)) {
                Toastr::error('Sorry Chart Of Account Not Ready To Create Account Payble', "Error");
                return back();
            }

            $parentHeadAccountDetail = WarehouseChartOfAccount::wherewarehouse_id($warehouse_id)->where('parent_head_name', 'ACCOUNT PAYABLES')->orderBy('id', 'desc')->first();
            if (empty($parentHeadAccountDetail)) {
                $head_code = $headAccountDetail->head_code . '00000001';
            } else {
                $head_code = $parentHeadAccountDetail->head_code + 1;
            }

            $head_name = strtoupper('STA' . $request->name);
            $parent_head_name = 'ACCOUNT PAYABLES';
            $head_level = $headAccountDetail->head_level + 1;
            $head_type = $headAccountDetail->head_type;
            $coa = new WarehouseChartOfAccount();
            $coa->head_code = $head_code;
            $coa->head_name = $head_name;
            $coa->warehouse_id =  $warehouse_id;
            $coa->parent_head_name = $parent_head_name;
            $coa->head_type = $head_type;
            $coa->head_level = $head_level;
            $coa->is_active = '1';
            $coa->created_by_user_id = Auth::User()->id;
            $coa->updated_by_user_id = Auth::User()->id;
            $coa->save();
            // DB::commit();
            Toastr::success("Staff Created Successfully", "Success");
            return redirect()->route(\Request::segment(1) . '.staffs.index');
        // } catch (\Exception $e) {
        //     $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
        //     Toastr::error($response['message'], "Error");
        //     return back();
        // }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $staff = User::find($id);
            $roles = Role::where('status', 1)
            ->where('name', '!=', 'Super Admin')
            ->get();
        $userRole = $staff->roles->first();

        $warehouses = Warehouse::wherestatus(1)->select('name', 'id')->get();
        $routes = Route::wherestatus(1)->select('name', 'id')->get();
        return view('backend.common.staffs.edit', compact('roles', 'staff', 'userRole', 'warehouses','routes'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            //'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'roles' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input['password'] = $user->password;
            }

            if ($request->warehouse_id) {
                $input['warehouse_id'] = $request->warehouse_id;
                $warehouse_id=$request->warehouse_id;
            }

            if ($request->route_id) {
                $input['route_id'] = $request->route_id != '' ? $request->route_id : NULL;
            }

            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('roles'));
            if ($user) {
                $coa = WarehouseChartOfAccount::wherewarehouse_id($warehouse_id)->where('user_id', $id)->first();
                $coa->head_name = ('STA'. $request->name);
                $coa->updated_by_user_id = Auth::User()->id;
                $coa->save();
            }
            DB::commit();
            Toastr::success("Staff Update Successfully", "Success");
            return redirect()->route(\Request::segment(1) . '.staffs.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->user_type != 'admin') {
            $user->delete();
            Toastr::success('User Role Deleted Successfully');
        } else {
            Toastr::warning('You can not delete Super admin');
        }

        return back();
    }
}
