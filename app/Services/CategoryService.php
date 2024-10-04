<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(int $id, array $data)
    {
        $category = Category::find($id);
        if ($category) {
            $category->update($data);
        }
        return $category;
    }

    public function deleteCategory(int $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
    }

    public function getCategoryById(int $id)
    {
        return Category::find($id);
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getPaginatedCategories($perPage = 10)
    {
        return Category::paginate($perPage);
    }
}
