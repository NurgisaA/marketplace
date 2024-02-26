<?php

namespace App\Http\Controllers\V1\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Http\Resources\V1\ColorCollection;
use App\Http\Resources\V1\ColorResource;
use App\Models\Color;
use App\Traits\ApiResponseTrait;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ColorCollection(Color::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {

        return new ColorResource($color);
    }


}
