<?php

namespace Larapress\Quantied\Services\QuantiedProduct;

use Illuminate\Contracts\Queue\ShouldQueue;
use Larapress\ECommerce\Models\Cart;
use Larapress\ECommerce\Services\Cart\CartPurchasedEvent;
use Larapress\ECommerce\Models\Product;

class SyncInStockOnCartPurchase implements ShouldQueue
{
    public function handle(CartPurchasedEvent $event)
    {
        /** @var Cart $cart */
        $cart = Cart::with(['products'])->find($event->cartId);

        /** @var Product[] $products */
        $products = $cart->products;
        foreach ($products as $product) {
            if ($product->isQuantized()) {
                $pData = $product->data;
                if (isset($pData['in_stock'])) {
                    $pData['in_stock'] -= $product->pivot->data['quantity'];
                    $product->update([
                        'data' => $pData,
                    ]);
                }
            }
        }
    }
}
