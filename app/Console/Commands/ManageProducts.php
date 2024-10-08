<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;
use App\Models\Category;

class ManageProducts extends Command
{
    protected $signature = 'product:manage';
    protected $description = 'Create and delete products';

    protected $productService;

    // Inject the ProductService via the constructor
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    public function handle()
    {
        // Ask user if they want to create or delete a product
        $action = $this->choice('What would you like to do?', ['create', 'delete'], 0);

        // Handle product creation
        if ($action == 'create') {
            // Get all categories
            $categories = Category::all();

            // Check if categories exist
            if ($categories->isEmpty()) {
                $this->error('No categories available. Please create categories first.');
                return; // Early return after error message
            }

            // Gather product details
            $name = $this->ask('Enter the product name');
            $description = $this->ask('Enter the product description');
            $price = $this->ask('Enter the product price');
            $image = $this->ask('Enter the product image path (optional)', null);

            // Display categories and get the user's choice
            $categoryOptions = $categories->pluck('name', 'id')->toArray();
            $categoryId = $this->choice('Select a category for the product', array_keys($categoryOptions), 0);

            // Use the service to create the product
            $this->productService->createProduct([
                'name' => $name,
                'description' => $description,
                'price' => (float) $price,
                'image' => $image,
            ], $categoryId);

            $this->info('Product created successfully.');

        } elseif ($action == 'delete') {
            // Handle product deletion
            $id = $this->ask('Enter the ID of the product to delete');

            if ($this->productService->deleteProduct($id)) {
                $this->info('Product deleted successfully.');
            } else {
                $this->error('Product not found.');
            }
        }
    }
}
