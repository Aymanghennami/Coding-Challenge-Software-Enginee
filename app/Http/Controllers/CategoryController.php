<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // Index page (read)
    public function index()
    {
        $categories = $this->categoryService->getPaginatedCategories();
        return view('categories.index', compact('categories'));
    }

    // Show create form (create)
    public function create()
    {
        return view('categories.create');
    }

    // Store new category (create)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $this->categoryService->createCategory($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Show edit form (update)
    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        return view('categories.edit', compact('category'));
    }

    // Update category (update)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $this->categoryService->updateCategory($id, $validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category (delete)
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
