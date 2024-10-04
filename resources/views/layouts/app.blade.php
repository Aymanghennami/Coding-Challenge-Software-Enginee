<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav>
        <a href="{{ route('categories.index') }}">Categories</a> |
        <a href="{{ route('products.index') }}">Products</a>
    </nav>

    <div class="container">
        @include('partials._messages') <!-- Include success/error messages -->
        @include('partials._errors') <!-- Include error display -->
        
        @yield('content') <!-- Dynamic content goes here -->
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} My Application</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
