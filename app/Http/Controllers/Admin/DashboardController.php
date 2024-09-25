<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {

        $stock = new Stock;
        $latestStocks = $stock->getLatestStocks();

        $viewData = [
            'title' => __('messages.admin_title'),
            'subtitle' => __('messages.admin_subtitle'),
            'stocks' => $latestStocks,
            'orders' => Order::all(),
        ];

        return view('admin.dashboard')->with('viewData', $viewData);
    }
}
