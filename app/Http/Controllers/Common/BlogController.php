<?php

namespace App\Http\Controllers\Common;
use App\Models\Blog;
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

class BlogController extends Controller
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

        $this->middleware('permission:blogs-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:blogs-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blogs-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blogs-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;

            if ($User->user_type == 'Admin') {
                $data = Blog::whereuser_id($User->id)->latest();
            } else {
                $data = Blog::latest();
            }
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                        if ($User->can('blogs-edit')) {
                            $btn = '<a href=' . route(request()->segment(1) . '.blogs.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
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
                        return '<a title="Click for View" data-lightbox="roadtrip" href="' . asset('blog',$data->image) . '"><img id="demo-test-gallery" class="border-radius-lg shadow demo-gallery" src="' . asset($data->image) . '" height="40px" width="40px"/>';
                    })
                    ->addColumn('link', function ($data) {
                        return '<a title="Click for View" target="_blank" href="' . url('blog', $data->slug) . '"><i class="fa fa-link"></i></a>';
                    })
                    ->rawColumns(['image', 'action', 'status', 'link'])
                    ->make(true);
            }

            return view('backend.common.blogs.index');
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

        return view('backend.common.blogs.create');
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
                'title' => 'required|min:1|max:198|unique:blogs',
                'short_description' => 'required|min:1|max:190',
                'long_description' => 'required|min:3|max:70000',
                'image' => 'required',
                'category' => 'required',
                'status' => 'required',
                'slug' => 'required|min:1|max:198|unique:blogs',

            ],
            [
                'short_description.required' => "The Short Description name field is required",
                'short_description.min' => "The Short Description Minimum Length 1",
                'short_description.max' => "The Short Description Maximum Length 190",
                'long_description.required' => "The Long Description name field is required",
                'long_description.min' => "The Long Description Minimum Length 1",
                'long_description.max' => "The Long Description Maximum Length 1000",
                'slider_image.required' => "The Slider Image name field is required",

            ]
        );

        try {
            DB::beginTransaction();
            $blog = new Blog();
            $blog->user_id = $this->User->id;
            $blog->title = $request->title;
            $blog->slug = Generate::Slug($request->slug);
            $blog->meta_title = $request->meta_title ?: $request->title;
            $blog->meta_description = $request->meta_description ?: $request->short_description;
            $blog->short_description = $request->short_description;
            $blog->json_screma = $request->json_screma;
            $blog->keyword = $request->keyword;
            $blog->status = $request->status;
            $blog->long_description = $request->long_description;
            $blog->category = $request->category;
            $blog->image = $request->image;
            $blog->save();
            DB::commit();

            Toastr::success("Blog Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.blogs.index');
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
     * @param  \App\Models\Blog   $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $data = Blog::whereuser_id($User->id)->findOrFail($id);
            } else {
                $data = Blog::findOrFail($id);
            }
            return view('backend.common.blogs.show')->with('slider', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function edit($id)
    {

        try {
            $User = $this->User;
            if ($User->user_type == 'Admin') {
                $data = Blog::whereuser_id($User->id)->findOrFail(decrypt($id));
            } else {
                $data = Blog::findOrFail(decrypt($id));
            }
            return view('backend.common.blogs.edit')->with('blog', $data);
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
     * @param  \App\Models\Blog   $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|min:1|max:198|unique:blogs,title,' . $id,
                'short_description' => 'required|min:1|max:190',
                'long_description' => 'required|min:3|max:70000',
                'category' => 'required|min:1|max:290',
                'image' => 'required',
                'status' => 'required',
                'slug' => 'required|min:1|max:198|unique:blogs,slug,' . $id,
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
            $blog = Blog::find($id);
            $blog->user_id = $this->User->id;
            $blog->title = $request->title;
            $blog->slug = Generate::Slug($request->slug);
            $blog->meta_title = $request->meta_title ?: $request->title;
            $blog->meta_description = $request->meta_description ?: $request->short_description;
            $blog->short_description = $request->short_description;
            $blog->json_screma = $request->json_screma;
            $blog->keyword = $request->keyword;
            $blog->long_description = $request->long_description;
            $blog->category = $request->category;
            $blog->status = $request->status;
            $blog->image = $request->image;
            $blog->save();
            DB::commit();

            Toastr::success("Blog Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.blogs.index');
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
     * @param  \App\Models\Blog   $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->status = $request->status;
        if ($blog->save()) {
            return 1;
        }
        return 0;
    }
}