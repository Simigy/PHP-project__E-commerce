<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('category')
                ->where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->paginate(12);
                
            return view('user.home', compact('products'));
        } catch (\Exception $e) {
            \Log::error('Error in HomeController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading products. Please try again later.');
        }
    }
}
