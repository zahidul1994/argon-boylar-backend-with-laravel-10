<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Division extends Model

{

    protected $fillable = [

       'id','division','slug','country_id','bndivision'

    ];

    public function district()

    {

        return $this->hasMany('App\Models\District');

    }

}

