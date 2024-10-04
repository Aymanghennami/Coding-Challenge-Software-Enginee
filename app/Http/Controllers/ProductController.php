<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    // Index page (read)
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'name');
        $categoryId = $request->get('category_id');

        $products = $this->productService->getPaginatedProducts(10, $sort, $categoryId);
        $categories = $this->categoryService->getAllCategories();

        return view('products.index', compact('products', 'categories', 'sort'));
    }

    // Show create form (create)
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('products.create', compact('categories'));
    }

    // Store new product (create)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->productService->createProduct($validated, $request->category_id);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show edit form (update)
    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $categories = $this->categoryService->getAllCategories();

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        return view('products.edit', compact('product', 'categories'));
    }

    // Update product (update)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->productService->updateProduct($id, $validated, $request->category_id);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete product (delete)
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

