@extends('home')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="ml-2">Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary mr-2">Create new product</a>
        </div>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Image</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Manage</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->size }}</td>
                    <td>{{ $product->image }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->brand->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                        @if ($product->enable)
                            <form action="{{ route('products.disable', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to disable this product?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Enabled</button>
                            </form>
                        @else
                            <form action="{{ route('products.enable', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to enable this product?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Disabled</button>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endsection
