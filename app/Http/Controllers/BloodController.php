<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;

class BloodController extends Controller
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
    public function search()
    {
           SEOMeta::setRobots('index, follow');
              OpenGraph::addProperty('type', 'website');
              JsonLd::setType('website');
              SEOTools::setTitle('Blood BD Search');
              SEOTools::setDescription('Blood BD Search');
              SEOMeta::addKeyword('Staritltd');
             SEOTools::opengraph()->setUrl(url('/'));
             return view("frontend.blood.search");
    }

    public function aboutUs(){
        return view("frontend.pages.about_us");
    }

   
}
