<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cartItems = $request->session()->get('cart_items', []);
        $cartProducts = $this->getCartProducts($cartItems);
        ($cartItems);

        $viewData = [
            'title' => 'Cart - Online Store',
            'subtitle' => 'Shopping Cart',
            'cartProducts' => $cartProducts,
        ];

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, int $id, string $type): RedirectResponse
    {
        // Validate the product type
        if (! in_array($type, ['Instrument', 'Lesson'])) {
            return redirect()->back()->withErrors('Invalid product type.');
        }

        // Validate the product exists based on type
        $model = $type === 'Instrument' ? Instrument::class : Lesson::class;
        $product = $model::find($id);
        if (! $product) {
            return redirect()->back()->withErrors('Product not found.');
        }

        // Validate quantity
        $quantity = $request->input('quantity', 1);
        if ($type === 'Instrument' && $quantity > $product->getQuantity()) {
            return redirect()->back()->withErrors(['quantity' => 'The requested quantity exceeds the available stock.']);
        }

        // Get current cart items from session
        $cartItems = $request->session()->get('cart_items', []);
        $existingItemKey = $this->findCartItem($cartItems, $id, $type);

        if ($existingItemKey !== null) {
            $cartItems[$existingItemKey]['quantity'] = $quantity;
        } else {
            $cartItems[] = [
                'id' => $id,
                'type' => $type,
                'quantity' => $quantity,
            ];
        }

        $request->session()->put('cart_items', $cartItems);

        return redirect()->route('cart.index')->with('message', 'Item added to cart!');
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart_items');

        return back();
    }

    private function getCartProducts(array $cartItems): array
    {
        $cartProducts = [];

        foreach ($cartItems as $item) {
            if ($item['type'] === 'Instrument') {
                $product = Instrument::find($item['id']);
                if ($product) {
                    $cartProducts[] = [
                        'type' => 'Instrument',
                        'product' => $product,
                        'quantity' => $item['quantity'],
                    ];
                }
            } elseif ($item['type'] === 'Lesson') {
                $product = Lesson::find($item['id']);
                if ($product) {
                    $cartProducts[] = [
                        'type' => 'Lesson',
                        'product' => $product,
                    ];
                }
            }
        }

        return $cartProducts;
    }

    private function findCartItem(array $cartItems, int $id, string $type): ?int
    {
        foreach ($cartItems as $index => $item) {
            if ($item['id'] === $id && $item['type'] === $type) {
                return $index;
            }
        }

        return null;
    }
}
