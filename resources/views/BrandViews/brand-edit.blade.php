@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('brands.update', $brand) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $brand->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Brand</button>
    </form>
@endsection
