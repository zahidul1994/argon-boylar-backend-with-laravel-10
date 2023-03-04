<?php

namespace App\Http\Controllers\Common;

use File;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
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

        // $this->middleware('permission:slides-list', ['only' => ['index', 'show']]);
        // $this->middleware('permission:slides-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:slides-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:slides-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $data = Setting::whereuser_id($User->id)->latest();
            } else {
                $data = Setting::latest();
            }
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                        // if ($User->can('slides-edit')) {
                        $btn =
                            '<a href=' .
                            route(
                                request()->segment(1) . '.setting.edit',
                                $data->id
                            ) .
                            ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
                        // }
                        $btn .= '</span>';
                        return $btn;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status == 0) {
                            return '<span class="badge badge-danger"> <i class="fa fa-ban"></i> </span>';
                        } else {
                            return '<span class="badge badge-success"><i class="fa fa-check-square"></i></span>';
                        }
                    })
                    ->addColumn('favicon', function ($data) {
                        return '<img class="border-radius-lg shadow" src="' .
                            asset($data->favicon) .
                            '" height="30px" width="30px"  />';
                    })
                    ->addColumn('logo', function ($data) {
                        return '<img class="border-radius-lg shadow" src="' .
                            asset($data->logo) .
                            '" height="30px" width="30px"  />';
                    })
                    ->addColumn('footer_logo', function ($data) {
                        return '<img class="border-radius-lg shadow" src="' .
                            asset($data->footer_logo) .
                            '" height="30px" width="30px"  />';
                    })
                    ->addColumn('admin_logo', function ($data) {
                        return '<img class="border-radius-lg shadow" src="' .
                            asset($data->admin_logo) .
                            '" height="30px" width="30px"  />';
                    })
                    ->rawColumns(['favicon','logo','footer_logo','admin_logo','action', 'status'])
                    ->make(true);
            }

            return view('backend.common.setting.index');
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Setting $setting)
    {
        //
    }

    public function edit($id)
    {
        // try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $data = Setting::whereuser_id($User->id)->findOrFail($id);
            } else {
                $data = Setting::findOrFail($id);
            }
            return view('backend.common.setting.edit')->with('setting', $data);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     $response = ErrorTryCatch::createResponse(
        //         false,
        //         500,
        //         'Internal Server Error.',
        //         null
        //     );
        //     Toastr::error($response['message'], 'Error');
        //     return back();
        // }
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:1|max:290',
            ]
        );

         try {
             DB::beginTransaction();
            $setting = Setting::find($id);
            $setting->user_id = $this->User->id;
            $setting->name = $request->name;
            $setting->title = $request->title;
            $setting->phone = $request->phone;
            $setting->email = $request->email;
            $setting->address = $request->address;
            $setting->description = $request->description;
            $setting->facebook = $request->facebook;
            $setting->youtube = $request->youtube;
            $setting->twitter = $request->twitter;
            $setting->instagram = $request->instagram;
            $setting->meta_title = $request->meta_title;
            $setting->meta_description = $request->meta_description;
            if ($request->hasFile('favicon')) {
                $this->validate($request, [
                    'favicon' =>
                        'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
                ]);
                Storage::delete($setting->favicon);
                $setting->favicon = $request->favicon->store('uploads/setting');
            }
            if ($request->hasFile('logo')) {
                $this->validate($request, [
                    'logo' =>
                        'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
                ]);
                Storage::delete($setting->logo);
                $setting->logo = $request->logo->store('uploads/setting');
            }
            if ($request->hasFile('footer_logo')) {
                $this->validate($request, [
                    'footer_logo' =>
                        'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
                ]);
                Storage::delete($setting->footer_logo);
                $setting->footer_logo = $request->footer_logo->store('uploads/setting');
            }
            if ($request->hasFile('admin_logo')) {
                $this->validate($request, [
                    'admin_logo' =>
                        'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
                ]);
                Storage::delete($setting->admin_logo);
                $setting->admin_logo = $request->admin_logo->store('uploads/setting');
            }
            $setting->save();
            Cache::forget('setting'); 
             DB::commit();
            Toastr::success('Setting Update Successfully', 'Success');
            return redirect()->route(request()->segment(1) . '.setting.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(
                false,
                500,
                'Internal Server Error.',
                null
            );
            Toastr::error($response['message'], 'Error');
            return back();
        }
    }

    public function destroy(Setting $setting)
    {
        //
    }
}
