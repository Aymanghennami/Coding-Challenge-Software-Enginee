<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category; // Import the Category model

class ManageCategories extends Command
{
    // The name and signature of the console command.
    protected $signature = 'category:manage';

    // The console command description.
    protected $description = 'Create and delete categories';

    // Execute the console command.
    public function handle()
    {
        // Ask user if they want to create or delete a category
        $action = $this->choice('What would you like to do?', ['create', 'delete'], 0);

        // Handle category creation
        if ($action === 'create') {
            $name = $this->ask('Enter the category name');
            $parentId = $this->ask('Enter parent category ID (optional, leave blank if none)', null);

            // Create the category
            Category::create([
                'name' => $name,
                'parent_id' => $parentId ? (int)$parentId : null,
            ]);

            $this->info('Category created successfully.');
        }
        // Handle category deletion
        elseif ($action === 'delete') {
            $id = $this->ask('Enter the ID of the category to delete');
            $category = Category::find($id);

            if ($category) {
                $category->delete();
                $this->info('Category deleted successfully.');
            } else {
                $this->error('Category not found.');
            }
        }
    }
}
