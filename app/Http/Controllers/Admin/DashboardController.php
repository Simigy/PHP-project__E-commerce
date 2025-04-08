<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            Log::info('Loading Admin Dashboard', [
                'url' => request()->url(),
                'path' => request()->path(),
                'host' => request()->getHost()
            ]);
            
            // Calculate date ranges
            $today = Carbon::today();
            $lastMonth = Carbon::now()->subMonth();
            
            // Get total counts with growth percentages
            $totalProducts = Product::count();
            $productsLastMonth = Product::where('created_at', '<', $lastMonth)->count();
            $productGrowth = $productsLastMonth > 0 ? (($totalProducts - $productsLastMonth) / $productsLastMonth) * 100 : 0;
            
            // Get orders data
            $totalOrders = Order::count();
            $ordersLastMonth = Order::where('created_at', '<', $lastMonth)->count();
            $orderGrowth = $ordersLastMonth > 0 ? (($totalOrders - $ordersLastMonth) / $ordersLastMonth) * 100 : 0;
            
            // Get users data
            $totalUsers = User::count();
            $usersLastMonth = User::where('created_at', '<', $lastMonth)->count();
            $userGrowth = $usersLastMonth > 0 ? (($totalUsers - $usersLastMonth) / $usersLastMonth) * 100 : 0;
            
            // Get total revenue - using sum of order amounts
            $totalRevenue = Order::sum('total_amount') ?? 0;
            $revenueLastMonth = Order::where('created_at', '<', $lastMonth)->sum('total_amount') ?? 0;
            $revenueGrowth = $revenueLastMonth > 0 ? (($totalRevenue - $revenueLastMonth) / $revenueLastMonth) * 100 : 0;
            
            // Get recent orders with eager loading
            $recentOrders = Order::with(['user'])
                ->latest()
                ->take(5)
                ->get();

            // Get low stock products
            $lowStockProducts = Product::where('quantity', '<', 10)
                ->latest()
                ->take(5)
                ->get();

            // Get monthly transaction history
            $monthlyTransactions = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as total')
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->take(7)
                ->get();

            Log::info('Admin Dashboard Data Loaded Successfully', [
                'products_count' => $totalProducts,
                'orders_count' => $totalOrders,
                'users_count' => $totalUsers
            ]);

            return view('admin.dashboard', compact(
                'totalProducts',
                'productGrowth',
                'totalOrders',
                'orderGrowth',
                'totalUsers',
                'userGrowth',
                'totalRevenue',
                'revenueGrowth',
                'recentOrders',
                'lowStockProducts',
                'monthlyTransactions'
            ));
        } catch (\Exception $e) {
            Log::error('Error in Admin Dashboard', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An error occurred while loading the dashboard.');
        }
    }
}
