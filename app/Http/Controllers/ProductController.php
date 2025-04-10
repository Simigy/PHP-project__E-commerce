<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(2);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'desc' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data['image'] = Storage::putFile('products', $request['image']);

        $product =  Product::create($data);

        return redirect(url('product/create'))->with('success', 'Product created successfully');
    }
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'desc' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data['image'] = Storage::putFile('products', $request['image']);

        $product = Product::find($id);
        $product->update($data);

        return redirect(url('product/edit/' . $id))->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();
        return redirect(url('products'))->with('success', 'Product deleted successfully');
    }
}
