<?php
namespace App\Http\Controllers;
use App\Models\Club;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;

class BloodClubController extends Controller
{
    public function index(){
        SEOMeta::setRobots('index, follow');
        OpenGraph::addProperty('type', 'website');
        JsonLd::setType('website');
        SEOTools::setTitle('Blood BD');
        SEOTools::setDescription('Blood BD !!!');
        SEOMeta::addKeyword('Blood');
       SEOTools::opengraph()->setUrl(url('/'));
       
  return view("frontend.welcome");
    }
    public function club()
    {
           SEOMeta::setRobots('index, follow');
              OpenGraph::addProperty('type', 'website');
              JsonLd::setType('website');
              SEOTools::setTitle('Blood Club Search');
              SEOTools::setDescription('Blood Club Search');
              SEOMeta::addKeyword('Staritltd');
             SEOTools::opengraph()->setUrl(url('/'));
             $clubs=Club::wherestatus(1)->paginate(10);
             return view("frontend.blood.club",compact('clubs'));
    }

    public function aboutUs(){
        return view("frontend.pages.about_us");
    }

   
}
