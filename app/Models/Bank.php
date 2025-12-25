<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    protected $fillable = [
        'user',
        'bank_name',
        'branch_name',
        'ifsc',
        'balance'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user','id');
    }
}
