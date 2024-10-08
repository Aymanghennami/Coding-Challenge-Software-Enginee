<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;

class ManageCategories extends Command
{
    protected $signature = 'category:manage';
    protected $description = 'Create and delete categories';
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
    }

    public function handle()
    {
        $action = $this->choice('What would you like to do?', ['create', 'delete'], 0);

        if ($action == 'create') {
            $name = $this->ask('Enter the category name');
            $parentId = $this->ask('Enter parent category ID (optional, leave blank if none)', null);

            // Here, we pass an associative array with 'name' and 'parent_id' keys to the service
            $this->categoryService->createCategory([
                'name' => $name,
                'parent_id' => $parentId ? (int)$parentId : null
            ]);

            $this->info('Category created successfully.');
        } elseif ($action == 'delete') {
            $id = $this->ask('Enter the ID of the category to delete');
            $this->categoryService->deleteCategory($id);

            $this->info('Category deleted successfully.');
        }
    }
}
