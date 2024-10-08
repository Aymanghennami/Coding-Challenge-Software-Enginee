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

    // Return type added: Category
    public function createCategory(array $data): Category
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(int $id, array $data): ?Category
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }

    public function getCategoryById(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    public function getPaginatedCategories($perPage = 10)
    {
        return $this->categoryRepository->paginate($perPage);
    }
}
