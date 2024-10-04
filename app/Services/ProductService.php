<?php 

namespace App\Services;

use App\Models\Product;
use App\Models\Category;

class ProductService
{
    public function createProduct(array $data, $categoryId)
    {
        $product = Product::create($data);
        $product->categories()->sync([$categoryId]);
        return $product;
    }

    public function updateProduct(int $id, array $data, $categoryId)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
            $product->categories()->sync([$categoryId]);
        }
        return $product;
    }

    public function deleteProduct(int $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
    }

    public function getProductById(int $id)
    {
        return Product::find($id);
    }

    public function getAllProducts()
    {
        return Product::with('categories')->get();
    }

    public function getPaginatedProducts($perPage = 10, $sort = 'name', $categoryId = null)
    {
        $query = Product::with('categories');

        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        return $query->orderBy($sort)->paginate($perPage);
    }
}
