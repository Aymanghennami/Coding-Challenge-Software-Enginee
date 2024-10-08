<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): ?Product
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
        }
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }

    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::all();
    }

    public function paginate(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Product::paginate($perPage);
    }

    public function filterByCategory(int $categoryId)
    {
        return Product::whereHas('categories', function($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->get();
    }

    public function sortBy($field, $order = 'asc')
    {
        return Product::orderBy($field, $order)->get();
    }
}
