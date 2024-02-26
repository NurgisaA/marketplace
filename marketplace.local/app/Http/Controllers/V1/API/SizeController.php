<?php

namespace App\Http\Controllers\V1\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Http\Resources\V1\SizeCollection;
use App\Http\Resources\V1\SizeResource;
use App\Models\Size;
use App\Traits\ApiResponseTrait;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new SizeCollection(Size::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {

        return new SizeResource($size);
    }

}
