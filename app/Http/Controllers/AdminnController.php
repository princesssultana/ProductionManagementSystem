<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Demand;
use App\Models\Product;
use App\Models\Stock;
use App\Models\PackagingMaterial;
use App\Models\User;
use Illuminate\Http\Request;

class AdminnController extends Controller
{
    public function dashboard(Request $request)
    {
        $year = $request->get('year', now()->year);

        // Key Statistics
        $totalMedicines = Product::count();
        $totalCategories = Category::count();
        $totalProductionOrders = Demand::count();
        $totalPackagingMaterials = PackagingMaterial::count();
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();

        // Production Orders Status Breakdown
        $ordersApproved = Demand::where('status', 'Approved')->count();
        $ordersPending = Demand::where('status', 'Pending')->count();
        $ordersRejected = Demand::where('status', 'Rejected')->count();

        // Low stock medicines (threshold: 50 units)
        $lowStockThreshold = 50;
        $lowStockMedicines = Product::where('stock', '<=', $lowStockThreshold)
            ->orderBy('stock', 'asc')
            ->get();

        // Monthly Production Orders
        $monthlyOrders = Demand::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Monthly Medicine Demand Quantity
        $monthlyDemandQty = Demand::selectRaw('MONTH(created_at) as month')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Recently Created Production Orders
        $recentOrders = Demand::orderBy('created_at', 'desc')
            ->with('items.product')
            ->limit(5)
            ->get();

        // Recent Medicines
        $recentMedicines = Product::orderBy('created_at', 'desc')
            ->with('category')
            ->limit(5)
            ->get();

        // Category-wise Medicine Count
        $medicinesByCategory = Product::selectRaw('category_id, COUNT(*) as count')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        // Packaging Material Stock Status
        $materialStats = PackagingMaterial::selectRaw('COUNT(*) as total, SUM(CASE WHEN status = "active" THEN 1 ELSE 0 END) as active')
            ->first();

        return view('pages.admin.dashboard', compact(
            'totalMedicines',
            'totalCategories',
            'totalProductionOrders',
            'totalPackagingMaterials',
            'totalUsers',
            'totalAdmins',
            'ordersApproved',
            'ordersPending',
            'ordersRejected',
            'lowStockMedicines',
            'lowStockThreshold',
            'monthlyOrders',
            'monthlyDemandQty',
            'recentOrders',
            'recentMedicines',
            'medicinesByCategory',
            'materialStats',
            'year'
        ));
    }
}
