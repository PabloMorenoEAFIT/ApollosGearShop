<?php

namespace App\Util;

use App\Models\Order;
use App\Models\User;
use App\Models\ItemInOrder;
use App\Models\Instrument;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use InvalidArgumentException;

class OrderUtils
{
    public static function validateSessionItems(array $cartItems)
    {
        foreach ($cartItems as $item) {
            if (!isset($item['type']) || !isset($item['quantity'])) {
                return false;
            }
        }
        return true;
    }

    public static function processCheckoutItems(array $cartItems)
    {
        $itemInOrders = [];
        $total = 0;

        foreach ($cartItems as $item) {
            $quantity = $item['type'] == 'Lesson' ? 1 : $item['quantity'];
            $productData = $item['product'];
            
            // Find the correct product
            $product = $item['type'] == 'Lesson'
                ? Lesson::find($productData['id'])
                : Instrument::find($productData['id']);

            if (!$product) {
                throw new InvalidArgumentException('Product not found.');
            }

            // Ensure available stock
            $availableQuantity = $item['type'] == 'Lesson' ? 1 : $product->getQuantity();
            $price = $productData['price'];
            $productName = $productData['name'];

            $total += $price * $quantity;
            
            if ($quantity > $availableQuantity) {
                throw new InvalidArgumentException('Requested quantity exceeds available stock for ' . $productName);
            }
            
            // Lower stock for instruments
            if ($item['type'] != 'Lesson') {
                try {
                    $product->getStocks()->latest()->first()->lowerStock($quantity, 'Order checkout');
                } catch (InvalidArgumentException $e) {
                    throw new InvalidArgumentException('Error updating stock for ' . $productName . ': ' . $e->getMessage());
                }
            }
            
            // Create ItemInOrder object
            $itemInOrder = new ItemInOrder([
                'type' => $item['type'] == 'Lesson' ? 'lesson' : 'instrument',
                'quantity' => $quantity,
                'price' => $price,
                'instrument_id' => $item['type'] != 'Lesson' ? $productData['id'] : null,
                'lesson_id' => $item['type'] == 'Lesson' ? $productData['id'] : null,
            ]);
            $itemInOrders[] = $itemInOrder;
        }
        //dd( $itemInOrders);
        return ['itemInOrders' => $itemInOrders, 'total' => $total];
    }

    // Create the order and save it to the database
    public static function createOrder(float $total, array $itemInOrders, int $userId): Order
    {
        $order = new Order();
        $order->creationDate = now();
        $order->deliveryDate = now()->addDays(7);
        $order->totalPrice = $total;
        $order->user_id = $userId;
        $order->save();

        // Save ItemInOrders
        foreach ($itemInOrders as $itemInOrder) {
            $itemInOrder->order_id = $order->id;
            $itemInOrder->save();
        }

        return $order;
    }

    public static function restoreStock(Order $order) : ?RedirectResponse
    {
        foreach ($order->itemInOrders as $itemInOrder) {
            if ($itemInOrder->type == 'instrument') {
                $instrument = $itemInOrder->instrument;

                if ($instrument) {
                    $latestStock = $instrument->stocks()->latest()->first();

                    if ($latestStock) {
                        try {
                            $latestStock->addStock($itemInOrder->quantity, 'Order cancellation');
                        } catch (InvalidArgumentException $e) {
                            return redirect()->back()->withErrors('Error updating stock: ' . $e->getMessage());
                        }
                    }
                }
            }
        }
    }
}
