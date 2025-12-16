<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CITY;
use App\Models\COUNTRY;

class emp extends Model
{
    protected $table = 'emp_tbl';

    protected $fillable = ['name', 'email', 'address', 'city', 'country', 'gender', 'image'];


  public function getcity()
  {
    return $this->belongsTo(CITY::class, 'city', 'id');
  }
    public function getcountry()
  {
    return $this->belongsTo(COUNTRY::class, 'country', 'id');
  }

}
