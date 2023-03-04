<?php

namespace App\Http\Controllers\Common;

use File;
use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\ErrorTryCatch;

class BusinessSettingsController extends Controller
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

    public function smtp_settings(Request $request)
    {
        // CoreComponentRepository::instantiateShopRepository();
        // CoreComponentRepository::initializeCache();
        return view('backend.common.business_settings.smtp_settings');
    }

    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        Toastr::success("Settings updated successfully", "Success");
        return back();
    }

    public function overWriteEnvFile($type, $val)
    {
        if(env('DEMO_MODE') != 'On'){
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
        }
    }
}
