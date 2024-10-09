<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Models\Category;

class CategoryService
{
    protected $categoryRepository;

    // Inject CategoryRepository via constructor
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create a new category
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data): Category
    {
        return $this->categoryRepository->create($data);
    }

    /**
     * Update a category by ID
     * @param int $id
     * @param array $data
     * @return Category|null
     */
    public function updateCategory(int $id, array $data): ?Category
    {
        return $this->categoryRepository->update($id, $data);
    }

    /**
     * Delete a category by ID
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }

    /**
     * Get a category by its ID
     * @param int $id
     * @return Category|null
     */
    public function getCategoryById(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    /**
     * Get all categories
     * @return \Illuminate\Database\Eloquent\Collection|Category[]
     */
    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get paginated categories
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedCategories(int $perPage = 10)
    {
        return $this->categoryRepository->paginate($perPage);
    }
}
