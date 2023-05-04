@extends('layouts.create-form')
@section('content')
    <div class ="container">

        <h1>Create a new category</h1>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Create Category</button>
        </form>
        @endsection
    </div>

