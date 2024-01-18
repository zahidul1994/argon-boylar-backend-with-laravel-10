<?php

namespace App\Http\Controllers\Common;

use App\Models\Category;
use File;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Sohibd\Laravelslug\Generate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    private $User;
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

        $this->middleware('permission:categories-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;

            if ($User->user_type == 'Admin') {
                $data = Category::whereuser_id($User->id)->latest();
            } else {
                $data = Category::latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                        if ($User->can('categories-edit')) {
                            $btn = '<a href=' . route(request()->segment(1) . '.categories.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
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
                        return '<a title="Click for View" data-lightbox="roadtrip" href="' . ($data->image) . '"><img id="demo-test-gallery" class="border-radius-lg shadow demo-gallery" src="' . ($data->image) . '" height="40px" width="40px"  />';
                    })
                    ->addColumn('link', function ($data) {
                        return '<a title="Click for View" target="_blank" href="' . url($data->slug) . '"><i class="fa fa-link"></i></a>';
                    })
                    ->rawColumns(['image', 'action', 'status', 'link'])
                    ->make(true);
            }

            return view('backend.common.categories.index');
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
        
        return view('backend.common.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => 'required|min:1|max:198|unique:categories',
                'short_description' => 'required|min:1|max:190',
                'long_description' => 'required|min:3|max:30000',
                'image' => 'required',
                
            ],
            [
                'short_description.required' => "The Short Description name field is required",
                'short_description.min' => "The Short Description Minimum Length 1",
                'short_description.max' => "The Short Description Maximum Length 190",
                'long_description.required' => "The Long Description name field is required",
                'long_description.min' => "The Long Description Minimum Length 1",
                'long_description.max' => "The Long Description Maximum Length 1000",
                

            ]
        );

         try {
            DB::beginTransaction();
            $category = new Category();
            $category->user_id = $this->User->id;
            $category->name = $request->name;
            $category->slug = Generate::Slug($request->name);
            $category->meta_title = $request->meta_title ?: $request->name;
            $category->meta_description = $request->meta_description ?: $request->short_description;
            $category->short_description = $request->short_description;
            $category->json_screma = $request->json_screma;
            $category->image = $request->image;
            $category->save();
            DB::commit();
            Toastr::success("Category Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.categories.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $data = Category::whereuser_id($User->id)->findOrFail($id);
            } else {
                $data = Category::findOrFail($id);
            }
            return view('backend.common.categories.show')->with('slider', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $data = Category::whereuser_id($User->id)->findOrFail(decrypt($id));
            } else {
                $data = Category::findOrFail(decrypt($id));
            }
            return view('backend.common.categories.edit')->with('category', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:1|max:198|unique:categories,name,' . $id,
                'short_description' => 'required|min:1|max:190',
                'long_description' => 'required|min:3|max:30000',
                 'image' => 'required',

            ],
            [
                'short_description.required' => "The Short Description name field is required",
                'short_description.min' => "The Short Description Minimum Length 1",
                'short_description.max' => "The Short Description Maximum Length 190",
                'long_description.required' => "The Long Description name field is required",
                'long_description.min' => "The Long Description Minimum Length 1",
                'long_description.max' => "The Long Description Maximum Length 1000",

            ]
        );

        try {
            DB::beginTransaction();
            $category = Category::find($id);
            $category->user_id = $this->User->id;
            $category->name = $request->name;
            $category->slug = Generate::Slug($request->name);
            $category->meta_title = $request->meta_title ?: $request->name;
            $category->meta_description = $request->meta_description ?: $request->short_description;
            $category->short_description = $request->short_description;
            $category->json_screma = $request->json_screma;
            $category->long_description = $request->long_description;
            $category->image = $request->image;
            $category->save();
            DB::commit();

            Toastr::success("Category Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.categories.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status;
        if ($category->save()) {
            return 1;
        }
        return 0;
    }
}