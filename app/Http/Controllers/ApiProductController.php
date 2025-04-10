<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        if ($products !== null) {
            return ProductResource::collection($products);
        } else {
            return response()->json(['message' => 'No products found'], 404);
        }
    }
    public function show($id)
    {
        $product = Product::find($id);
        if ($product !== null) {
            return new ProductResource($product);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'desc' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 301);
        }
        //image
        $image = Storage::putFile('products', $request->file('image'));
        // create
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'desc' => $request->desc,
            'image' => $image,
        ]);
        // message
        return response()->json(['message' => 'Product created successfully'], 201);
    }
    //
    public function update(Request $request, $id)
    {
        //select one
        $product = Product::find($id);
        if ($product === null) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'desc' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        //image
        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $image = Storage::putFile('products', $request->file('image'));
            // $image = $request->file('image')->store('products');
        } else {
            $image = $product->image;
        }

        // update
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'desc' => $request->desc,
            'image' => $image,
        ]);
        // message
        return response()->json(['message' => 'Product updated successfully', 'product' => new ProductResource($product)], 200);
    }
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product === null) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        if ($product->image !== null) {
            Storage::delete($product->image);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
