@extends('home')

@section('content')
    <div class="container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="ml-2">Categories</h1>
                @can('create entity')
                    <a href="{{ route('categories.create') }}" class="btn btn-primary mr-2">Create new category</a>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        @can('edit entity')
                            <th>Manage</th>
                        @endcan
                        @can('enable entity')
                            <th>Enable</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            @can('edit entity')
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            @endcan
                            @can('enable entity')
                                <td>
                                    <form method="POST" action="{{ route('categories.set-enable', $category) }}"
                                          onsubmit="return confirm('Are you sure you want to save this change?')">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="toggle-switch"
                                                   name="switch-state" {{ $category->enable ? 'checked' : '' }}>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </td>
                            @endcan

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$categories->onEachSide(1)->links()}}
            </div>
        </div>
@endsection
