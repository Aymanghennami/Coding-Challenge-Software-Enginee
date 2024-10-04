<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the products with sorting and filtering
    public function index(Request $request)
    {
        // Get all categories for the filter dropdown
        $categories = Category::all();

        // Get the query parameters for filtering and sorting
        $categoryId = $request->query('category');
        $sortBy = $request->query('sort', 'name'); // default sort by name
        $sortOrder = $request->query('order', 'asc'); // default order ascending

        // Build the query for products
        $query = Product::with('categories');

        // Apply filtering by category if a category ID is provided
        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        // Apply sorting
        if ($sortBy && in_array($sortBy, ['name', 'price'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Fetch the products with pagination
        $products = $query->paginate(10);

        return view('products.index', compact('products', 'categories', 'categoryId', 'sortBy', 'sortOrder'));
    }

    // Show the form for creating a new product
    public function create()
    {
        // Fetch all categories for the select dropdown
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Create a new product instance and save it
        $product = Product::create($request->only('name', 'description', 'price', 'image'));

        // Sync the product with categories
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show the form for editing the specified product
    public function edit(Product $product)
    {
        $categories = Category::all();
        $selectedCategories = $product->categories->pluck('id')->toArray();

        return view('products.edit', compact('product', 'categories', 'selectedCategories'));
    }

    // Update the specified product in storage
    public function update(Request $request, Product $product)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Update product details
        $product->update($request->only('name', 'description', 'price', 'image'));

        // Sync the product with categories
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from storage
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
