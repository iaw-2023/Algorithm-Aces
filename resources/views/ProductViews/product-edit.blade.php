@extends('layouts.edit-form')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/scrollableDescription.css') }}">
@endpush

@section('content')
    <div class="container">
<h1>Edit Product</h1>   

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" required>
    </div>
    <div class="form-group">
        <label for="image">Image URL</label>
        <div class="input-group align-items-start">
            <textarea name="image" class="form-control" id="image" required>{{ $product->image }}</textarea>
            <input type="file" id="image-file" accept="image/*" style="display: none;">
            <button type="button" id="select-file-button" class="btn btn-outline-primary ml-2" onclick="document.getElementById('image-file').click()">Select File</button>
            <button type="button" id="upload-button" class="btn btn-success ml-2" onclick="uploadImage()">Upload</button>
    
            <img id="image-preview" src="{{ $product->image }}" alt="Preview"
                 style="max-height: 100px; margin-top: 10px; margin-left: 10px; display: none;"
                 onerror="this.onerror=null; this.style.display='none'; this.src='{{ asset('images/notfound.png') }}';">
        </div>        
    </div>    
    <div class="form-group">
        <label for="description">Description</label>
        <div class="input-group">
            <textarea name="desc" class="form-control" id="desc" value="{{ $product->desc }}" required>{{ old('desc') }}</textarea>
            <button type="button" class="btn btn-primary ml-2" id="enhance-button" onclick="enhanceDescription()">Enhance Description</button>
        </div>
    </div>
    <div class="form-group">
        <label for="size">Size</label>
        <input type="text" name="size" class="form-control" id="size" value="{{ $product->size }}" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}" required min="0">
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" name="stock" class="form-control" id="stock" value="{{ $product->stock }}" required min="0">
    </div>
    <div class="form-group">
        <label for="brand_id">Brand</label>
        <select name="brand_id" id="brand_id" class="form-control" required>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('Are you sure you want to save the changes?')">Update Product</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2" onclick="return confirm('Are you sure you want to leave this page? Any changes you made will be lost.');">Go back</a>

</form>
</div>
@endsection
