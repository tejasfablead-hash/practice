<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:user,email|email',
            'role'=>'required',
            'password'=>'required',
            'phone'=>'required|numeric',
        ]); 

        if($validate->fails()){
            return response()->json([
                'status'=>true,
                'message'=>'Registration Successfully'
            ],422);
}
            User::create([
                
            ]);
        
    } 
}
