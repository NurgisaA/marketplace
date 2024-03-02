<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
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
        $product = Product::factory()->create();

        $this->json('get', '/api/products/1')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "data" => [
                        'id',
                        'categoryId',
                        'title',
                        'description',
                        'price',
                        'image'
                    ]
                ]
            );
    }

    public function test_returns_a_index_filter_title_successful_response(): void
    {
        $product = Product::factory()->create();

        $productName = $product->title;
       // Make a GET request to the products endpoint with the filter
        $response = $this->get('/api/products?title[eq]=' . urlencode($productName));

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the response data contains the filtered product
        $response->assertJsonFragment([
            'title' => $productName
        ]);
    }

}
