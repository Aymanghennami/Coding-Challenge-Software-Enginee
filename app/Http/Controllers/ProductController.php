<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    // Inject the ProductService via constructor
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    // Display the list of products (index)
    public function index(Request $request)
    {
        // Fetch categories
        $categories = $this->categoryService->getAllCategories();
        
        // Fetch products, optionally filtering by category
        $selectedCategory = $request->get('category');
        $products = $this->productService->getPaginatedProducts();

        // If a category is selected, filter products by that category
        if ($selectedCategory) {
            $products = $products->where('category_id', $selectedCategory);
        }

        return view('products.index', compact('products', 'categories'));
    }

    // Show the form for creating a new product (create)
    public function create()
    {
        return view('products.create');
    }

    // Store a new product in the database (store)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $this->productService->createProduct($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show the form for editing a product (edit)
    public function edit($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        return view('products.edit', compact('product'));
    }

    // Update a product in the database (update)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $this->productService->updateProduct($id, $validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product from the database (destroy)
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
