namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCreationTest extends TestCase
{
    use RefreshDatabase; // Use this trait to reset the database for each test

    /** @test */
    public function a_product_can_be_created()
    {
        // Create a category to associate with the product
        $category = Category::factory()->create();

        // Define product data
        $productData = [
            'name' => 'Smartphone',
            'description' => 'A high-end smartphone',
            'price' => 999.99,
            'image' => 'path/to/image.jpg',
            'category_id' => $category->id,
        ];

        // Perform a POST request to the product creation endpoint
        $response = $this->post('/products', $productData);

        // Assert that the response is a redirect (or whatever your expected response is)
        $response->assertRedirect('/products'); // Adjust this if you redirect elsewhere

        // Assert that the product was created in the database
        $this->assertDatabaseHas('products', [
            'name' => 'Smartphone',
            'description' => 'A high-end smartphone',
            'price' => 999.99,
            'image' => 'path/to/image.jpg',
            'category_id' => $category->id,
        ]);
    }
}
