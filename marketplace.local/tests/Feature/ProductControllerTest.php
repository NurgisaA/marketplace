<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Http\Response;
use Tests\TestCase;


class ProductControllerTest extends TestCase
{
    public function test_returns_a_index_successful_response(): void
    {
        $this->get('/api/products')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'categoryId',
                            'title',
                            'description',
                            'price',
                            'image'
                        ]
                    ]
                ]
            );

    }

    public function test_returns_a_show_successful_response(): void
    {
        $this->json('get', '/api/products/1')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'id',
                    'categoryId',
                    'title',
                    'description',
                    'price',
                    'image'
                ]
            );
    }

    public function test_returns_a_index_filter_title_successful_response(): void
    {
        $product = Product::factory()->create();


        $this->json('get', "/api/products?title[eq]=$product->title")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonPath('data.*.title', $product->title);

    }
    public function test_returns_a_index_filter_price_successful_response(): void
    {
        $product = Product::factory()->create();



        $price_gte = $product->price + 1;
        $price_lte = $product->price - 1;

        $this->json('get', "/api/products?title[eq]=$product->title&price[gte]=$price_gte&price[lte]=$price_lte")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'price'
                ],

            );
    }
}
