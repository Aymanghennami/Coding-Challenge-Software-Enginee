<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Create a new category
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update a category by ID
     * @param int $id
     * @param array $data
     * @return Category|null
     */
    public function update(int $id, array $data): ?Category
    {
        $category = $this->findById($id);
        
        if ($category) {
            $category->update($data);
        }

        return $category;
    }

    /**
     * Delete a category by ID
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $category = $this->findById($id);

        if ($category) {
            return $category->delete();
        }

        return false;
    }

    /**
     * Find a category by its ID
     * @param int $id
     * @return Category|null
     */
    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Get all categories
     * @return \Illuminate\Database\Eloquent\Collection|Category[]
     */
    public function getAll()
    {
        return Category::all();
    }

    /**
     * Get paginated categories
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return Category::paginate($perPage);
    }
}
