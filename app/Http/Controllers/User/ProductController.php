<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function all()
    {
        try {
            $products = Product::withCount('favorites')
                ->withAvg('reviews', 'rating')
                ->withCount('reviews')
                ->paginate(12);

            $favorites = [];
            if (Auth::check()) {
                $favorites = Favorite::where('user_id', Auth::id())
                    ->pluck('product_id')
                    ->toArray();
            }

            return view('user.products.index', compact('products', 'favorites'));
        } catch (\Exception $e) {
            Log::error('Error in all method: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading products.');
        }
    }
    public function show($id)
    {
        try {
            $product = Product::withCount('favorites')
                ->withAvg('reviews', 'rating')
                ->withCount('reviews')
                ->findOrFail($id);
            
            $favorites = [];
            if (Auth::check()) {
                $favorites = Favorite::where('user_id', Auth::id())
                    ->pluck('product_id')
                    ->toArray();
            }

            return view('user.Products.view', compact('product', 'favorites'));
        } catch (\Exception $e) {
            Log::error('Error in show method: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the product.');
        }
    }
    public function addToCart($id, Request $request)
    {
        $qty = $request->qty;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
                $id => [
                    'name' => $product->name,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'image' => $product->image
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        } else {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $qty;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $qty,
                'price' => $product->price,
                'image' => $product->image
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }
    public function showCart()
    {
        try {
            // Get cart from session
            $cart = session()->get('cart', []);

            // Log cart data for debugging
            Log::info('Cart data:', ['cart' => $cart]);

            // Check if user is authenticated
            if (!Auth::check()) {
                Log::warning('User not authenticated when accessing cart');
                return redirect()->route('login')->with('error', 'Please login to view your cart');
            }

            return view('user.products.showCart', compact('cart'));
        } catch (\Exception $e) {
            Log::error('Error in showCart method: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading your cart. Please try again.');
        }
    }
    public function makeOrder(Request $request)
    {
        $cart = session()->get('cart');
        $user = Auth::user();
        $order = Order::create([
            'user_id' => $user->id,
            // "required_date" => $request->requiredDate,
        ]);
        foreach ($cart as $id => $product) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }
        return redirect()->back();
    }
    public function addToWhishlist($id)
    {
        $product = Product::findOrFail($id);
        $whishlist = session()->get('whishlist');
        if (!$whishlist) {
            $whishlist = [
                $id => [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image
                ]
            ];
            session()->put('whishlist', $whishlist);
            return redirect()->back()->with('success', 'Product added to whishlist successfully!');
        } else {
            if (isset($whishlist[$id])) {
                // session()->unset($whishlist[$id]);
                return redirect()->back()->with('success', 'Product already in whishlist!');
            }
            $whishlist[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image
            ];
            session()->put('whishlist', $whishlist);
            return redirect()->back()->with('success', 'Product added to whishlist successfully!');
        }
    }
    public function myWhishlist()
    {
        $whishlist = session()->get('whishlist');
        return view('user.Products.whishlist', compact('whishlist'));
    }
    public function removeFromWhishlist($id)
    {
        $whishlist = session()->get('whishlist');
        if (isset($whishlist[$id])) {
            unset($whishlist[$id]);
            session()->put('whishlist', $whishlist);
        }
        return redirect()->back()->with('success', 'Product removed from whishlist successfully!');
    }
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
    public function clearWhishlist()
    {
        session()->forget('whishlist');
        return redirect()->back()->with('success', 'Whishlist cleared successfully!');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('name', 'LIKE', "%{$search}%")->paginate(3);
        return view('user.home', compact('products'));
    }
    public function filter(Request $request)
    {
        $products = Product::where('category_id', $request->category_id)->paginate(3);
        return view('user.home', compact('products'));
    }
    public function sort(Request $request)
    {
        $sort = $request->input('sort');
        if ($sort == 'asc') {
            $products = Product::orderBy('price', 'asc')->paginate(3);
        } elseif ($sort == 'desc') {
            $products = Product::orderBy('price', 'desc')->paginate(3);
        } else {
            $products = Product::paginate(3);
        }
        return view('user.home', compact('products'));
    }
    public function addToFavorite($id)
    {
        try {
            $product = Product::findOrFail($id);
            
            // Handle guest favorites using session
            if (!Auth::check()) {
                $guestFavorites = session()->get('guest_favorites', []);
                
                if (in_array($id, $guestFavorites)) {
                    // Remove from favorites
                    $guestFavorites = array_diff($guestFavorites, [$id]);
                    $message = 'Product removed from favorites';
                    $status = false;
                } else {
                    // Add to favorites
                    $guestFavorites[] = $id;
                    $message = 'Product added to favorites';
                    $status = true;
                }
                
                session()->put('guest_favorites', $guestFavorites);
                
                if (request()->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => $message,
                        'status' => $status,
                        'favorites_count' => count($guestFavorites)
                    ]);
                }
                
                return redirect()->back()->with('success', $message);
            }

            // Handle authenticated user favorites
            $user = Auth::user();
            $favorite = Favorite::where('user_id', $user->id)->where('product_id', $id)->first();

            if ($favorite) {
                $favorite->delete();
                $message = 'Product removed from favorites';
                $status = false;
            } else {
                Favorite::create([
                    'user_id' => $user->id,
                    'product_id' => $id,
                ]);
                $message = 'Product added to favorites';
                $status = true;
            }

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'status' => $status,
                    'favorites_count' => Favorite::where('product_id', $id)->count()
                ]);
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error in addToFavorite method: ' . $e->getMessage());

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating favorites'
                ], 500);
            }

            return redirect()->back()->with('error', 'An error occurred while updating favorites');
        }
    }
    public function toggleFavorite(Product $product)
    {
        $user = auth()->user();
        
        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            $isFavorited = false;
        } else {
            $user->favorites()->attach($product->id);
            $isFavorited = true;
        }
        
        $count = $product->favorites()->count();
        
        return response()->json([
            'success' => true,
            'is_favorited' => $isFavorited,
            'count' => $count
        ]);
    }
}
