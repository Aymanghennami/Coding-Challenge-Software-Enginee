<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between">
            <a href="{{ route('products.index') }}" class="text-lg font-bold">Product Manager</a>
            <div>
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">Products</a>
                <a href="{{ route('categories.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Categories</a>
            </div>
        </div>
    </div>
</nav>
