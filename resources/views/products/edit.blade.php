@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required>{{ $product->description }}</textarea>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="{{ $product->price }}" required>

        <label for="image">Image URL (optional):</label>
        <input type="text" name="image" id="image" value="{{ $product->image }}">

        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->categories->first()->id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Update</button>
    </form>
@endsection
