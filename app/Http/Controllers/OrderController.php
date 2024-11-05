<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Models\ItemInOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Instrument;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [
            'title' => 'Order - Online Store',
            'subtitle' => __('navbar.list_orders'),
            'orders' => Order::all(),
        ];

        return view('order.index')->with('viewData', $viewData);
    }

    public function checkout(Request $request): RedirectResponse
    {
        $cartItems = $request->session()->get('cart_items', []);

        $validator = Validator::make($request->all(), [
            'cart_items' => 'required|json',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cartItems = json_decode($request->input('cart_items'), true) ?? $cartItems;

        $total = 0;
        $itemInOrders = [];

        foreach ($cartItems as $item) {
            if($item['type'] == "Lesson"){
                $quantity = 1;
            }else{
                $quantity = $item['quantity'];
            }
            $productData = $item['product'];

            $product = $item['type'] == "Lesson"
                ? Lesson::find($productData['id'])
                : Instrument::find($productData['id']);

            if (!$product) {
                return redirect()->back()->withErrors("Product not found.");
            }

            if ($item['type'] == "Lesson") {
                $availableQuantity = 1;
            } else {
                $availableQuantity = $product->getQuantity();
            }
            $price = $productData['price'];
            $productName = $productData['name'];

            $total += $price * $quantity;

            if ($quantity > $availableQuantity) {
                return redirect()->back()->withErrors([
                    'quantity' => 'Requested quantity exceeds available stock for ' . $productName
                ]);
            }

            // Lower stock for instruments
            if ($item['type'] != "Lesson") {
                try {
                    $product->getStocks()->latest()->first()->lowerStock($quantity, "Order checkout");
                } catch (InvalidArgumentException $e) {
                    return redirect()->back()->withErrors([
                        'quantity' => 'Error updating stock for ' . $productName . ': ' . $e->getMessage()
                    ]);
                }
            }

            $itemInOrder = new ItemInOrder([
                'type' => $item['type'] == "Lesson" ? 'lesson' : 'instrument',
                'quantity' => $quantity,
                'price' => $price,
                'instrument_id' =>$item['type'] != "Lesson" ? $productData['id'] : null,
                'lesson_id' => $item['type'] == "Lesson" ? $productData['id'] : null,
            ]);
            $itemInOrders[] = $itemInOrder;
        }

        if ($total <= 0) {
            return redirect()->back()->withErrors('Invalid total amount.');
        }

        $order = new Order();
        $order->creationDate = now();
        $order->deliveryDate = now()->addDays(7);
        $order->totalPrice = $total;
        $order->user_id = User::find(auth()->id())->getId();
        $order->save();

        foreach ($itemInOrders as $itemInOrder) {
            $itemInOrder->order_id = $order->id;
            $itemInOrder->save();
        }

        $request->session()->forget('cart_items');

        return redirect()->route('order.index')->with('message', 'Checkout successful! Your order total is $' . number_format($total / 100, 2));
    }


    public function show(int $id): View
    {
        $order = Order::with('itemInOrders')->findOrFail($id);
        $items = $order->getItemInOrder()->get();

        foreach ($items as $item) {
            $item->price = $item->getPrice() * $item->getQuantity();
        }


        $viewData = [
            'title' => 'Order Details',
            'subtitle' => 'Order ID: ' . $order->getId(),
            'order' => $order,
            'items' => $items,
        ];

        return view('order.show')->with('viewData', $viewData);
    }
}
