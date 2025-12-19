<?php

namespace App\Http\Controllers;

use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public  function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|numeric|digits:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        // dd($validate);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'false',
                'errors' => $validate->errors()
            ], 422);
        }
       

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->storeAs('user', $filename, 'public');
        }
        
        User::create([
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

    public function login(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // dd($validate);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'false',
                'errors' => $validate->errors()
            ], 422);
        }


        $credentials =  $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return response()->json([
                'status' => true,
                'message' => 'login Successfully',
            ]);
        }

        return response()->json([
            'status' => "false",
            'message' => 'Invalid email or password'
        ]);
    }

    public function userlogout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        return response()->json([
            'status' => true,
            'message' => 'You are logout'
        ]);
    }



    public function profile()
    {
        if (Auth::check()) {
            $profile = Auth::user();
            return view('profile', ['data' => $profile]);
        }
        return view('login');
    }

    public function edit($id)
    {

        $update = User::where('id', $id)->first();
        return view('updateprofile', ['single' => $update]);
    }

    public function updatedata(Request $request)
    {

        $updatedata = User::where('id', $request->id)->first();
        $newimage = $updatedata->image;
        // dd($request->all());
        $validate =  Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'false',
                'errors' => $validate->errors()
            ], 422);
        }


        if ($request->hasFile('image')) {

            Storage::disk('public')->delete('user/' . $updatedata->image);

            $file = $request->file('image');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->storeAs('user', $filename, 'public');
            $newimage = $filename;
        }

        $updatedata->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $newimage
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Your Profile Updated Successfully'
        ]);
    }
}
