<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'All fields are mandetory',
                'errors' => $validate->errors()
            ], 422);
        }

        $path = [];


        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path[] =  $file->store('product', 'public');
            }
        }
        $data = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price,
            'image' => $path,

        ]);
        return response()->json([
            'status' => true,
            'message' => 'Product Created Successfully',
            'product' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $path = $product->image;

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'This Record Not Available '
            ], 404);
        }
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'All fields are mandatory',
                'errors' => $validate->errors()
            ], 422);
        }



        if ($request->hasFile('image')) {
            if (!empty($product->image) && is_array($product->image)) {
                foreach ($product->image as $oldFile) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
        }


        $path = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path[] =  $file->store('product', 'public');
            }
        }

        $updated = $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price,
            'image' => $path,

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
        $product = Product::where('id', $request->id)->first();
        $product->image;

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'This Record Not Available '
            ], 404);
        }

        if (!empty($product->image)) {
            $images = is_array($product->image) ? $product->image : json_decode($product->image, true);
            if (is_array($images)) {
                foreach ($images as $oldFile) {
                    Storage::disk('public')->delete($oldFile);
                }
            } else {
                Storage::disk('public')->delete($product->image);
            }
        }
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ], 200);
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
