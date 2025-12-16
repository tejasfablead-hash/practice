<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CITY;
use App\Models\emp;

class COUNTRY extends Model
{
  protected $table = 'country_tbl';

  protected $fillable = ['country_name'];

  public function city()
  {
    return $this->hasOne(CITY::class, 'country_id', 'id');
  }

    public function getemp()
  {
    return $this->hasOne(emp::class, 'country', 'id');
  }
}
