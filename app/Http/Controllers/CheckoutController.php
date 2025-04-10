<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout');
        }

        // Debug the session cart
        Log::info('Checkout session cart', ['cart' => session()->get('cart')]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('user-showCart')->with('error', 'Your cart is empty');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('user-showCart')->with('error', 'Your cart is empty');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending',
            'shipping_address' => $request->address,
            'shipping_city' => $request->city,
            'shipping_postal_code' => $request->postal_code,
            'shipping_phone' => $request->phone,
            'payment_method' => 'cash_on_delivery',
        ]);

        // Create order items
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('checkout.success', ['order' => $order->id]);
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home');
        }

        return view('checkout.success', compact('order'));
    }
}