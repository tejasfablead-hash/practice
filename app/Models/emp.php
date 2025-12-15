<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class emp extends Model
{
    protected $table= 'emp_tbl';

    protected $fillable=['name','email','address','city','country','gender','image'];
}
