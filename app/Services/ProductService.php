<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;

class ProductService
{
    protected $productRepository;

    // Inject ProductRepository via constructor
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // Return type added: Product
    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct(int $id, array $data): ?Product
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getPaginatedProducts($perPage = 10)
    {
        return $this->productRepository->paginate($perPage);
    }

    public function filterProductsByCategory(int $categoryId)
    {
        return $this->productRepository->filterByCategory($categoryId);
    }

    public function sortProducts($field, $order = 'asc')
    {
        return $this->productRepository->sortBy($field, $order);
    }
}
