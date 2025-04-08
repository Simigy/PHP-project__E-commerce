<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $orders = Order::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('user.orders.index', compact('orders'));
        } catch (\Exception $e) {
            Log::error('Error in OrderController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading your orders.');
        }
    }

    public function show($id)
    {
        try {
            $user = Auth::user();
            $order = Order::where('user_id', $user->id)
                ->where('id', $id)
                ->firstOrFail();

            return view('user.orders.show', compact('order'));
        } catch (\Exception $e) {
            Log::error('Error in OrderController@show: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the order details.');
        }
    }
}
