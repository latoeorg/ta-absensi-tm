<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Models\ItemHistory;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItem = Item::count();
        $totalStock = Item::sum('stock');
        $totalLowStock = Item::where('stock', '<', 'stock_alert')->count();

        $totalAmountPurchaseOrder = PurchaseOrder::where('status', 'DONE')->sum('total_amount');
        $totalAmountSalesOrder = SalesOrder::where('status', 'DONE')->sum('total_amount');
        $totalProfit = $totalAmountSalesOrder - $totalAmountPurchaseOrder;

        $totalPurchaseOrder = PurchaseOrder::where('status', 'DONE')->count();
        $totalPurchaseOrderNotDone = PurchaseOrder::where('status', '!=', 'DONE')->count();
        $totalSalesOrder = SalesOrder::where('status', 'DONE')->count();
        $totalSalesOrderNotDone = SalesOrder::where('status', '!=', 'DONE')->count();

        $items = ItemHistory::orderBy('created_at', 'desc')->take(10)->get();

        return view('pages.dashboard.index', [
            'totalItem' => $totalItem,
            'totalStock' => $totalStock,
            'totalLowStock' => $totalLowStock,

            'totalAmountPurchaseOrder' => $totalAmountPurchaseOrder,
            'totalAmountSalesOrder' => $totalAmountSalesOrder,
            'totalProfit' => $totalProfit,

            'totalPurchaseOrder' => $totalPurchaseOrder,
            'totalPurchaseOrderNotDone' => $totalPurchaseOrderNotDone,
            'totalSalesOrder' => $totalSalesOrder,
            'totalSalesOrderNotDone' => $totalSalesOrderNotDone,

            'items' => $items,
        ]);
    }
}
