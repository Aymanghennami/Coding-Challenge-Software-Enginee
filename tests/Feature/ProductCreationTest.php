<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_can_be_created()
    {
        $category = Category::factory()->create();

        $productData = [
            'name' => 'Smartphone',
            'description' => 'A high-end smartphone',
            'price' => 999.99,
            'image' => 'path/to/image.jpg',
            'category_id' => $category->id,
        ];

        $response = $this->post('http://localhost/products', $productData);

        $response->assertRedirect('http://localhost/products'); // Adjust if your redirect is different
        $this->assertDatabaseHas('products', $productData);
    }
}
