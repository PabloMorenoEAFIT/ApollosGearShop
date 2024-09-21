<?php

namespace App\Http\Controllers;

use App\Models\Order; 
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function create(): View
    {
        $viewData['title'] = 'Create Order';

        return view('order.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $order = new Order;
        $validatedData = $order->validate($request->all());
        $order = Order::create($validatedData);

        $viewData['message'] = 'Order successfully created!';

        return redirect()->route('home.index')->with('success', $viewData['message']);
    }

    public function delete($id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'order deleted successfully.');
    }
}
