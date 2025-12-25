<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\COUNTRY;
use App\Models\Information;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MultipleController extends Controller
{
    public function multifield()
    {
        if (Auth::check()) {
            $country = COUNTRY::all();
            return view('pages.multiple', compact('country'));
        } else {
            return view('login');
        }
    }
    public function inputmultifield()
    {
        if (Auth::check()) {
            return view('pages.inputfield');
        } else {
            return view('login');
        }
    }

    public function store(Request $request)
    {
        
        if (Auth::check()) {
            $validate = Validator::make($request->all(), [
                'fname' => 'required|alpha',
                'lname' => 'required|alpha',
                'dob' => 'required|date',
                'phone' => 'required|digits:10|numeric',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required|numeric',
                'bankname'=>'required',
                'branchname'=>'required',
                'ifsc'=>'required',
                'balance'=>'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6'
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => 'false',
                    'errors' => $validate->errors()
                ], 422);
            }
            $name = $request->fname . '' . $request->lname;
               $data = User::create([
                'name' => $name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'dob' => $request->dob,
                'phone' => $request->phone,
                'city' => $request->city,
                'country' => $request->country,
                'state' => $request->state,
                'pincode' => $request->pincode,
            ]);

            Bank::create([
                'user' =>$data->id,
                'bank_name'=>$request->bankname,
                'branch_name'=>$request->branchname,
                'ifsc'=>$request->ifsc,
                'balance'=>$request->balance
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Record inserted Successfully'
            ]);
        } else {
            return view('login');
        }
    }
}
