<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MultipleController extends Controller
{
    public function multifield()
    {
        return view('pages.multiple');
    }
    public function inputmultifield()
    {
        return view('pages.inputfield');
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'fname' => 'required|alpha',
            'lname' => 'required|alpha',
            'dob' => 'required|date',
            'phone' => 'required|digits:10|numeric',
            'country' => 'required|alpha',
            'state' => 'required|alpha',
            'city' => 'required|alpha',
            'pincode' => 'required|numeric',
            'email' => 'required|email|unique:information_tbl,email',
            'password' => 'required|confirmed|min:6'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'false',
                'errors' => $validate->errors()
            ], 422);
        }

        Information::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'Record inserted Successfully'
        ]);
    }
}
