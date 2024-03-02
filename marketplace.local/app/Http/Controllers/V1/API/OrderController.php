<?php

namespace App\Http\Controllers\V1\API;

use App\Constants\OrderState;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use App\Traits\ApiResponseTrait;

class OrderController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::query()
            ->where("user_id", auth()->id())
            ->whereIn('state', [OrderState::PENDING->value, OrderState::ORDERED->value]);
        // todo add filters

        // todo add sorting

        return new OrderCollection($order->paginate(10));
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if (!$order || $order->user_id != auth()->id()) {
            return $this->errorResponse('Not found!', [], 404);
        }
        return new OrderResource($order);
    }

}
