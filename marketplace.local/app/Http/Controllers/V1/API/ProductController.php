<?php

namespace App\Http\Controllers\V1\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\V1\ProductsCollection;
use App\Http\Resources\V1\ProductsResource;
use App\Models\Product;
use App\Services\V1\ProductQuery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProductQuery();
        $queryItem = $filter->transform($request); // [[column,operator,value]]
        $orderItem = $filter->transformOrder($request); // [column,type]

        $product = Product::query();

        if (count($queryItem) == 0 || count($orderItem) == 0) {
            return new ProductsCollection($product->paginate());
        }

        return new ProductsCollection($product->where($queryItem)->orderBy(...$orderItem)->paginate());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductsResource($product);
    }

}
