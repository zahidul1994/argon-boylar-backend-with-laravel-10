<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model

{

    protected $fillable = [

        'id','district_id','thana','created_at','bnthana','slug'

     ];

     

          public function district()

    {

        return $this->belongsTo('App\Models\District');

    }

}

