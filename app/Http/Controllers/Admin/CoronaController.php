<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CoronaController extends Controller
{
    public function index()
    {
        $productCount = Product::count();

        return view('admin.corona', [
            'productCount' => $productCount
        ]);
    }
}
