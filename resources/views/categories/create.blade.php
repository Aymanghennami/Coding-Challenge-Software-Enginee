@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <h1>Create Category</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="parent_id">Parent Category (optional):</label>
        <select name="parent_id" id="parent_id">
            <option value="">None</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">Create</button>
    </form>
@endsection
