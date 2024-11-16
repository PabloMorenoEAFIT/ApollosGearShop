<?php

namespace App\Http\Controllers;

use App\Util\CartUtils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cartItems = $request->session()->get('cart_items', []);
        $cartProducts = CartUtils::getCartProducts($cartItems);

        $viewData = [
            'title' => 'Cart - Online Store',
            'subtitle' => 'Shopping Cart',
            'cartProducts' => $cartProducts,
        ];

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, int $id, string $type): RedirectResponse
    {
        if (! CartUtils::isValidProductType($type)) {
            return redirect()->back()->withErrors('Invalid product type.');
        }

        $product = CartUtils::getProductById($id, $type);
        if (! $product) {
            return redirect()->back()->withErrors('Product not found.');
        }

        $quantity = CartUtils::getValidQuantity($request, $product, $type);
        if ($quantity === false) {
            return redirect()->back()->withErrors(['quantity' => 'The requested quantity exceeds the available stock.']);
        }

        CartUtils::updateCart($request, $id, $type, $quantity);

        return redirect()->route('cart.index')->with('message', 'Item added to cart!');
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart_items');

        return back();
    }
}
