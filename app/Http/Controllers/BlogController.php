<?php
namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;

class BlogController extends Controller
{
    public function index(Request $request){
        SEOMeta::setRobots('index, follow');
        OpenGraph::addProperty('type', 'website');
        JsonLd::setType('website');
        SEOTools::setTitle('Blood BD Blog');
        SEOTools::setDescription('Blood BD  Blog ');
        SEOMeta::addKeyword('Blood');
       SEOTools::opengraph()->setUrl(url('/blog'));
       $id=$request->q;
       if($id){
            $LatestBlog=Blog::wherestatus(1)->where('title','LIKE','%'.urldecode($id).'%')->select('slug','image','title','created_at','short_description')->latest()->paginate(20);
            }
       else{
          $LatestBlog=Blog::wherestatus(1)->select('slug','image','title','created_at','short_description')->latest()->paginate(20);
       }
       
  return view("frontend.blog.index",compact('LatestBlog'));
    }
    public function show($id){
      
        $data=Blog::whereslug($id)->first();
       
        if($data){
        SEOMeta::setRobots('index, follow');
              OpenGraph::addProperty('type', 'website');
              JsonLd::setType('website');
              SEOTools::setTitle(@$data->title);
              SEOTools::setDescription(@$data->meta_title);
              SEOMeta::addKeyword(@$data->keyword);
             SEOTools::opengraph()->setUrl(url('/search'));
     return view('frontend.blog.show')->with('blogDetails',$data);
    }else{
        abort(404,"Blog not found");
    }
    }
   
}
