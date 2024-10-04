{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>

    <div class="mb-3">
        <form method="GET" action="{{ route('products.index') }}">
            <select name="category" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="sort" onchange="this.form.submit()">
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Sort by Price</option>
            </select>

            <select name="order" onchange="this.form.submit()">
                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
                    <td>{{ $product->description }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->categories->pluck('name')->implode(', ') }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
