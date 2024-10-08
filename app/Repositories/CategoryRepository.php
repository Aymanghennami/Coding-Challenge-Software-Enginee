<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): ?Category
    {
        $category = Category::find($id);
        if ($category) {
            $category->update($data);
        }
        return $category;
    }

    public function delete(int $id): bool
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return true;
        }
        return false;
    }

    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
    }

    public function paginate(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Category::paginate($perPage);
    }
}
