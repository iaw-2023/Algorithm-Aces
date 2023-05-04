@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
