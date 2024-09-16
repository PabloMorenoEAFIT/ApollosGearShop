<?php

namespace App\Http\Controllers;

use App\Models\Order; // importar Request
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
            'Orders' => Order::all(),
        ];

        return view('order.index')->with('viewData', $viewData);

    }

    public function show(string $id): View|RedirectResponse
    {
        $viewData = [];
        $order = Order::findOrFail($id);
        $viewData['title'] = $order['id'].' - AGS';
        $viewData['subtitle'] = $order['id'].' - order information';
        $viewData['order'] = $order;

        return view('order.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = []; //to be sent to the view
        $viewData['title'] = 'Create Order';

        return view('order.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'creationDate' => 'required',
            'deliveryDate' => 'required',
            'totalPrice' => 'required|numeric|gt:0',
        ]);

        $order = Order::create($request->only(['creationDate', 'deliveryDate', 'totalPrice']));

        return redirect()->route('order.success', [
            'creationDate' => $order->creationDate,
            'deliveryDate' => $order->deliveryDate,
            'totalPrice' => $order->totalPrice,
        ]);
    }

    public function success(Request $request): View|RedirectResponse
    {
        $order = $request->only(['creationDate', 'deliveryDate', 'totalPrice']);

        if (empty($order['creationDate']) || empty($order['deliveryDate']) || empty($order['totalPrice'])) {
            Log::info('order details missing in query parameters.');

            return redirect()->route('home.index');
        }

        $viewData = [];
        $viewData['title'] = 'Success - AGS';
        $viewData['subtitle'] = 'Order successfully created!';
        $viewData['order'] = $order;

        return view('order.success')->with('viewData', $viewData);
    }

    public function delete($id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'order deleted successfully.');
    }
}
