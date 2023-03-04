<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
class HomeController extends Controller
{
    public function index(){
        SEOMeta::setRobots('index, follow');
        OpenGraph::addProperty('type', 'website');
        JsonLd::setType('website');
        SEOTools::setTitle('Car Dekho BD');
        SEOTools::setDescription('FOR THE PEOPLE, BY THE PEOPLE, WE ARE HERE FOR YOU!!!');
        SEOMeta::addKeyword('SohiBD');
       SEOTools::opengraph()->setUrl(url('/'));
       
  return view("frontend.welcome");
    }
    public function main()
    {
          SEOMeta::setRobots('index, follow');
              OpenGraph::addProperty('type', 'website');
              JsonLd::setType('website');
              SEOTools::setTitle('Car Dekho BD');
              SEOTools::setDescription('FOR THE PEOPLE, BY THE PEOPLE, WE ARE HERE FOR YOU!!!');
              SEOMeta::addKeyword('SohiBD');
             SEOTools::opengraph()->setUrl(url('/'));
             
        return view("frontend.index");
    }

    public function aboutUs(){
        return view("frontend.pages.about_us");
    }

   
}
