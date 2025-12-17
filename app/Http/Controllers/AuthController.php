<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public  function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:login_tbl,email',
            'password' => 'required',
            'phone' => 'require|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        // dd($validate);
            if($validate->failed()){
            return response()->json([
                'status'=>'false',
                'errors'=>$validate->errors()
            ],422);
        }
 
        
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->storeAs('user', $filename, 'public');
        }

        Login::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'image' => $filename
        ]);
        return response()->json([
            'status' => "true",
            'message' => 'Registration Successfully',
        ]);
    }

    public function login(Request $request){
        $credential = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd($validate);
            if($credential->failed()){
            return response()->json([
                'status'=>'false',
                'errors'=>$credential->errors()
            ],422);
        }
        $result = Auth::attempt($credential); 
    }
}
