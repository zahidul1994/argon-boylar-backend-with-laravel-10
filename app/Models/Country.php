<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  protected $fillable=[
      'countryname','id'
  ];
  public function division()
  {
      return $this->hasMany('App\Models\Division');
  }
}
