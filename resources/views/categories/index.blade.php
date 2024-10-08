{{-- resources/views/categories/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td><a href="{{ route('categories.show', $category->getId()) }}">{{ $category->getName() }}</a></td>
                    <td>{{ $category->getDescription() }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->getId()) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('categories.destroy', $category->getId()) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection
