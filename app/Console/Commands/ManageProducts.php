<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;

class ManageProducts extends Command
{
    // The name and signature of the console command.
    protected $signature = 'product:manage';

    // The console command description.
    protected $description = 'Create and delete products';

    // Execute the console command.
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
                return;
            }

            // Create the product
            $name = $this->ask('Enter the product name');
            $description = $this->ask('Enter the product description');
            $price = $this->ask('Enter the product price');
            $image = $this->ask('Enter the product image path (optional)', null);

            // Display categories and get the user's choice
            $categoryOptions = $categories->pluck('name', 'id')->toArray();
            $categoryId = $this->choice('Select a category for the product', array_keys($categoryOptions), 0);

            // Create product and associate it with the selected category
            $product = Product::create([
                'name' => $name,
                'description' => $description,
                'price' => (float)$price,
                'image' => $image,
            ]);

            // Sync the product with the selected category
            $product->categories()->sync([$categoryId]);

            $this->info('Product created successfully.');
        }
        // Handle product deletion
        elseif ($action == 'delete') {
            $id = $this->ask('Enter the ID of the product to delete');
            $product = Product::find($id);

            if ($product) {
                $product->delete();
                $this->info('Product deleted successfully.');
            } else {
                $this->error('Product not found.');
            }
        }
    }
}