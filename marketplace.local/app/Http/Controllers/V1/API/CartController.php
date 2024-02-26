<?php

namespace App\Http\Controllers\V1\API;

use App\Constants\OrderState;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use App\Models\Product;

class CartController extends Controller
{
    public function cartItems()
    {

        $order = Order::with(['user', 'product'])
            ->where([['state', '=', OrderState::DRAFT], ['user_id', '=', auth()->id()]])
            ->first();
        if (!$order) {
            $order = Order::create([
                "state" => OrderState::DRAFT,
                'user_id' => auth()->id(),
                "amount" => "0"
            ]);
        }

        return new OrderResource($order);
    }

    public function addCartProduct()
    {
        $data = request()->validate([
            'product_id' => 'required|integer|exists:products,id',
            'color_id' => 'required|integer|exists:colors,id',
            'size_id' => 'required|integer|exists:sizes,id',
            'count' => 'required|integer|min:1'
        ]);

        $order = Order::with('user')
            ->where([['state', '=', OrderState::DRAFT], ['user_id', '=', auth()->id()]])
            ->first();

        if (!$order) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'state' => OrderState::DRAFT
            ]);
        }

        $product = Product::query()
            ->whereHas("size", function ($q) use ($data) {
                $q->where("sizes.id", $data['size_id']);
            })
            ->whereHas("color", function ($q) use ($data) {
                $q->where("colors.id", $data['color_id']);
            })
            ->find($data['product_id']);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 403);
        }
        $amount = 0;

        $order_product = $order->product()->where([
            ["product_id", "=", $product->id],
            ["size_id", "=", $data["size_id"]],
            ["color_id", "=", $data["color_id"]]
        ])->first();

        if ($order_product) {
            $pivot = $order_product->pivot;
            $pivot->count = $data['count'];
            $pivot->price = $product->price;
            $pivot->save();
        } else {
            $order->product()->attach($product, [
                'count' => $data['count'],
                'price' => $product->price,
                'color_id' => $data['color_id'],
                'size_id' => $data['size_id']
            ]);
        }

        foreach ($order->product as $product) {
            $amount += $product->pivot->price * $product->pivot->count;
        }

        $order->amount = $amount;
        $order->save();

        return new OrderResource($order);
    }

    public function removeCartProduct()
    {
        $data = request()->validate([
            'product_id' => 'required|integer',
            'color_id' => 'required|integer',
            'size_id' => 'required|integer',
        ]);

        $order = Order::with('user')
            ->where([['state', '=', OrderState::DRAFT], ['user_id', '=', auth()->id()]])
            ->first();

        if (!$order) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'state' => OrderState::DRAFT
            ]);
        }

        $order_product = $order->product()->where([
            ["product_id", "=", $data["product_id"]],
            ["size_id", "=", $data["size_id"]],
            ["color_id", "=", $data["color_id"]]
        ])->first();

        if ($order_product) {
            $order_product->pivot->delete();
        }
        $amount = 0;
        foreach ($order->product as $product) {
            $amount += $product->pivot->price * $product->pivot->count;
        }

        $order->amount = $amount;
        $order->save();

        return new OrderResource($order);
    }

    public function changeOrderStateToPending()
    {
        $order = Order::with('user')
            ->where([['state', '=', OrderState::DRAFT], ['user_id', '=', auth()->id()]])
            ->first();

        if (!$order) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'state' => OrderState::DRAFT
            ]);
        }

        if ($order->product->count() === 0) {
            return response()->json([
                'message' => 'Cart is empty'
            ], 403);
        }

        $order->state = OrderState::PENDING;
        $order->save();

        return new OrderResource($order);
    }
}
