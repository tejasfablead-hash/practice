<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:4',
            'role' => 'required|in:1,2',
            'phone' => 'required|numeric|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Record Inserted Successfully'
        ], 200);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials =  $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $tokenName = $request->token_name ?? 'auth_token';
            $token = $user->createToken($tokenName);

            return response()->json([
                'status' => true,
                'message' => 'Login successfully',
                'token' => $token->plainTextToken,
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Invalid Credentials'
        ], 401);
    }

    public function view()
    {
        $data = User::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        dd($data);
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function update(Request $request,$id)
    {
        $data = User::where('id', $id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($data->id)
            ],
            'password' => 'required|min:4',
            'role' => 'required|in:1,2',
            'phone' => 'required|numeric|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $user=$data->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Record Updated Successfully',
            'data'=>$user
        ], 200);
    }
public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $data=$user->delete();
        return response()->json([
            'status' => true,
            'user'=>$data,
            'message' => 'Record Deleted Successfully',
        ], 200);
    }

}
