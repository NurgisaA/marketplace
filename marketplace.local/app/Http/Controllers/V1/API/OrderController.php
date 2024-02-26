<?php

namespace App\Http\Controllers\V1\API;

use App\Constants\OrderState;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = auth()->user()->order()->whereIn('state', [OrderState::PENDING, OrderState::ORDERED]);
        // todo add filters

        // todo add sorting

        // todo create a resource collection
        return new OrderCollection($order);
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // todo check if the order belongs to the user
        // todo create a resource
        return new OrderResource($order);
    }

}
