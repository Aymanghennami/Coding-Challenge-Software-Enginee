<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
            $name = $this->ask('Enter the product name');
            $description = $this->ask('Enter the product description');
            $price = $this->ask('Enter the product price');
            $image = $this->ask('Enter the product image path (optional)', null);
            $categories = $this->ask('Enter category IDs (comma-separated)');

            // Create product and associate it with categories
            $product = Product::create([
                'name' => $name,
                'description' => $description,
                'price' => (float)$price,
                'image' => $image,
            ]);

            $product->categories()->sync(explode(',', $categories));

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
