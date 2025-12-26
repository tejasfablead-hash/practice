<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'All fields are mandetory',
                'errors' => $validate->errors()
            ], 422);
        }
        $data = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Product Created Successfully',
            'product' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'All fields are mandatory',
                'errors' => $validate->errors()
            ], 422);
        }

        $updated = $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price
        ]);

        if ($updated) {
            return response()->json([
                'status' => true,
                'message' => 'Product Updated Successfully',
                'product' => $product
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Product Update Failed'
        ], 500);
    }


    public function delete(Request $request)
    {

        $delete = Product::where('id', $request->id)->first();

        if ($delete == true) {
             $delete->delete();
            return response()->json([
                'status' => true,
                'message' => 'Record Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'This Record Not Available '
            ], 404);
        }

      
    }
    public function view()
    {
        $data = Product::all();
        if ($data->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No Product Found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
}
