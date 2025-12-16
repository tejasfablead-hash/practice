<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\COUNTRY;

class CITY extends Model
{
      protected $table = 'city_tbl';

    protected $fillable = ['city_name', 'country_id'];

public function country(){
  return $this->belongsTo(COUNTRY::class,'country_id','id');

}
 public function getemp()
  {
    return $this->hasOne(emp::class, 'country', 'id');
  }


}
