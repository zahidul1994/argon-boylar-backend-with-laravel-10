<?php

namespace App\Http\Traits;
use App\Models\Country;
use App\Models\District;
use App\Models\Thana;

trait LocationTrait
{
    function getCountry(){
        return Country::get();
    }

    function getDistrict(){
        return District::get();
    }
    function getThana(){
        return Thana::get();
    }

    function findDistrict($id){
        return District::wheredivision_id($id)->get();
    }
    function findThana($id){
        return Thana::wheredistrict_id($id)->get();
    }

}
