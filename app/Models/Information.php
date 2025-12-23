<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table= 'information_tbl';
    protected $fillable = ['fname','lname','dob','phone','country','state','city','pincode','email','password'];
}
