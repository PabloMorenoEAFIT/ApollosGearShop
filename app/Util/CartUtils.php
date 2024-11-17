<?php

namespace App\Util;

use App\Models\Instrument;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CartUtils
{
    public static function isValidProductType(string $type): bool
    {
        return in_array($type, ['Instrument', 'Lesson']);
    }

    public static function getProductById(int $id, string $type)
    {
        $model = $type === 'Instrument' ? Instrument::class : Lesson::class;

        return $model::find($id);
    }

    public static function getValidQuantity(Request $request, $product, string $type)
    {
        $quantity = $request->input('quantity', 1);
        if ($type === 'Instrument' && $quantity > $product->getQuantity()) {
            return false;
        }

        return $quantity;
    }

    public static function updateCart(Request $request, int $id, string $type, int $quantity): void
    {
        $cartItems = $request->session()->get('cart_items', []);
        $existingItemKey = self::findCartItem($cartItems, $id, $type);

        if ($existingItemKey !== null) {
            $cartItems[$existingItemKey]['quantity'] += $quantity;
        } else {
            $cartItems[] = [
                'id' => $id,
                'type' => $type,
                'quantity' => $quantity,
            ];
        }

        $request->session()->put('cart_items', $cartItems);
    }

    public static function getCartProducts(array $cartItems): array
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
                        'available_quantity' => $product->getQuantity(),
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

    public static function findCartItem(array $cartItems, int $id, string $type): ?int
    {
        foreach ($cartItems as $index => $item) {
            if ($item['id'] === $id && $item['type'] === $type) {
                return $index;
            }
        }

        return null;
    }
}
