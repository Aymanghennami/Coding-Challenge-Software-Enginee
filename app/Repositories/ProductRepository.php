<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * Create a new product
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update a product by ID
     * @param int $id
     * @param array $data
     * @return Product|null
     */
    public function update(int $id, array $data): ?Product
    {
        $product = $this->findById($id);
        
        if ($product) {
            $product->update($data);
        }

        return $product;
    }

    /**
     * Delete a product by ID
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product = $this->findById($id);

        if ($product) {
            return $product->delete();
        }

        return false;
    }

    /**
     * Find a product by its ID
     * @param int $id
     * @return Product|null
     */
    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     * Get all products
     * @return \Illuminate\Database\Eloquent\Collection|Product[]
     */
    public function getAll()
    {
        return Product::all();
    }

    /**
     * Get paginated products
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return Product::paginate($perPage);
    }

    /**
     * Sync categories for a product
     * @param Product $product
     * @param array $categoryIds
     */
    public function syncCategories(Product $product, array $categoryIds): void
    {
        $product->categories()->sync($categoryIds);
    }
}
