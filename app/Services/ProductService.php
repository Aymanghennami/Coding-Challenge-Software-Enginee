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

    /**
     * Create a new product
     * @param array $data
     * @return Product
     */
    public function createProduct(array $data): Product
    {
        // Detach categories before passing to repository
        $categories = $data['category_ids'] ?? [];
        unset($data['category_ids']);

        $product = $this->productRepository->create($data);

        // Sync categories with the product
        if (!empty($categories)) {
            $this->productRepository->syncCategories($product, $categories);
        }

        return $product;
    }

    /**
     * Update a product by ID
     * @param int $id
     * @param array $data
     * @return Product|null
     */
    public function updateProduct(int $id, array $data): ?Product
    {
        $categories = $data['category_ids'] ?? [];
        unset($data['category_ids']);

        $product = $this->productRepository->update($id, $data);

        // Sync updated categories with the product
        if ($product && !empty($categories)) {
            $this->productRepository->syncCategories($product, $categories);
        }

        return $product;
    }

    /**
     * Delete a product by ID
     * @param int $id
     * @return bool
     */
    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

    /**
     * Get a product by its ID
     * @param int $id
     * @return Product|null
     */
    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    /**
     * Get all products
     * @return \Illuminate\Database\Eloquent\Collection|Product[]
     */
    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    /**
     * Get paginated products
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedProducts(int $perPage = 10)
    {
        return $this->productRepository->paginate($perPage);
    }
}
