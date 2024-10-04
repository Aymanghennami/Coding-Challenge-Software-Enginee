@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>

    <div class="card">
        <div class="card-header">
            Product Details
        </div>
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text">{{ $product->description }}</p>

            <h5 class="card-title">Price</h5>
            <p class="card-text">{{ number_format($product->price, 2) }} MAD</p>

            <h5 class="card-title">Categories</h5>
            <p class="card-text">
                @if($product->categories->isEmpty())
                    No categories assigned.
                @else
                    @foreach ($product->categories as $category)
                        <a href="{{ route('categories.show', $category->id) }}" class="badge badge-info">{{ $category->name }}</a>
                    @endforeach
                @endif
            </p>

            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Product</button>
            </form>
        </div>
    </div>
</div>
@endsection
