@extends('home')

@section('content')
    <div class="container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="ml-2">Categories</h1>
                <a href="{{ route('categories.create') }}" class="btn btn-primary mr-2">Create new category</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    @if ($category->enable)
                                        <form action="{{ route('categories.disable', $category) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to disable this category?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Enabled</button>
                                        </form>
                                    @else
                                        <form action="{{ route('categories.enable', $category) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to enable this category?')">
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
                {{$categories->onEachSide(1)->links()}}
            </div>
        </div>
    @endsection
