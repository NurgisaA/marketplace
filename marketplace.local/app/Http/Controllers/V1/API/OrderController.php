<?php

namespace App\Http\Controllers\V1\API;

use App\Constants\OrderState;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::query()
            ->where("user_id", auth()->id())
            ->whereIn('state', [OrderState::PENDING, OrderState::ORDERED]);
        // todo add filters

        // todo add sorting

        return new OrderCollection($order->paginate(10));
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

}
