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
        return view('pages.dashboard.index');
    }
}
