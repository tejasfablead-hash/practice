<?php

namespace App\Http\Controllers;

use App\Models\CITY;
use App\Models\COUNTRY;
use App\Models\emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManageController extends Controller
{

    public function view()
    {
        if (Auth::check()) {
            $data  = emp::with(['getcountry', 'getcity'])->get();
            $city = CITY::all();
            return view('view', ['data' => $data, 'city' => $city]);
        } else {
            return view('login');
        }
    }
    public function display()
    {
        if (Auth::check()) {
            $data  = emp::with(['getcountry', 'getcity'])->get();
            // dd($data);
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            return view('login');
        }
    }


    public function main()
    {
        if (Auth::check()) {
            $country = COUNTRY::all();
            return view('form', ['country' => $country]);
        } else {
            return view('login');
        }
    }

    public function store(Request $request)
    {

        // dd($request->all());
        if (Auth::check()) {
            $validate =  Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:emp_tbl,email',
                'address' => 'required',
                'city' => 'required|string',
                'country' => 'required|string',
                'gender' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif'
            ]);


            if ($validate->fails()) {
                return response()->json([
                    'status' => 'false',
                    'errors' => $validate->errors()
                ], 422);
            }


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
                'message' => 'Data Inserted',

            ]);
        }
    }

    public function edit($id)
    {
        $country = COUNTRY::all();
        $single = emp::where('id', $id)->first();
        return view('update', ['single' => $single, 'country' => $country]);
    }


    public function updatedata(Request $request)
    {

        $updatedata = emp::where('id', $request->id)->first();

        $newimage = $updatedata->image;
        // dd($request->all());
        $validate =  Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required|string',
            'country' => 'required|string',
            'gender' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'false',
                'errors' => $validate->errors()
            ], 422);
        }


        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('upload/' . $updatedata->image);
            $file = $request->file('image');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->storeAs('upload', $filename, 'public');
            $newimage = $filename;
        }

        $updatedata->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'gender' => $request->gender,
            'image' => $newimage
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Data Updated'
        ]);
    }

    public function delete($id)
    {
        $delete = emp::where('id', $id)->first();
        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data deleted'
        ]);
    }

    public function filter($country_id)
    {

        $city = CITY::where('country_id', $country_id)->pluck('city_name', 'id');

        // dd($city);
        return response()->json($city);
    }
}
