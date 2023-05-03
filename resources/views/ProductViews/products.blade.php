@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Size</th>
                <th>Image</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Category</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->size }}</td>
                    <td>{{ $product->image }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->brand->name }}</td>
                    <td>{{ $product->category->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
