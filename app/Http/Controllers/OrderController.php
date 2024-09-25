<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ImageService;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected ImageService $imageService;

    public function index(): view
    {
        $viewData = [
            'title' => 'Order - Online Store',
            'subtitle' => __('navbar.list_orders'),
            'orders' => Order::all(),
        ];

        return view('order.index')->with('viewData', $viewData);

    }

    public function show(string $id): View
    {
        $order = Order::findOrFail($id);

        $viewData = [
            'title' => $order->getId().' - AGS',
            'subtitle' => $order->getId().' - order information',
            'order' => $order,
        ];

        return view('order.show')->with('viewData', $viewData);
    }
}
