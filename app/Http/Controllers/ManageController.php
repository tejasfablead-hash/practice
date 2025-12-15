<?php

namespace App\Http\Controllers;

use App\Models\emp;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    
    public function view()
    {
        $data  = emp::all();
       return view('view',['data'=>$data]); 
    }
    // public function display()
    // {
    //     $data  = emp::all();

    //    return response()->json([
    //         'status' => 'success',
    //         'data' => $data
    //     ]); 
    // }


    public function main()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
    

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->storeAs('upload', $filename, 'public');
        }


        emp::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'gender' => $request->gender,
            'image' => $filename
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Data Inserted'
        ]);
    }
}
