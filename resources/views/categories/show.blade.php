@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name }}</h1>

    <div class="card">
        <div class="card-header">
            Category Details
        </div>
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text">{{ $category->description ?? 'No description available.' }}</p>

            <h5 class="card-title">Products in this Category</h5>
            <ul class="list-group">
                @if($category->products->isEmpty())
                    <li class="list-group-item">No products available in this category.</li>
                @else
                    @foreach ($category->products as $product)
                        <li class="list-group-item">
                            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a> - {{ number_format($product->price, 2) }} MAD
                        </li>
                    @endforeach
                @endif
            </ul>

            <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Categories</a>
        </div>
    </div>
</div>
@endsection
