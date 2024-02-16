<?php

namespace App\Http\Controllers;

use App\Constants\OrderState;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = auth()->user()->order();
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
