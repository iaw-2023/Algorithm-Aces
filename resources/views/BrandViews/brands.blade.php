@extends('home')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="ml-2">Brands</h1>
            <a href="{{ route('brands.create') }}" class="btn btn-primary mr-2">Create new brand</a>
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
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand) }}" class="btn btn-primary btn-sm">Edit</a>
                        @if ($brand->enable)
                            <form action="{{ route('brands.disable', $brand) }}" method="POST" onsubmit="return confirm('Are you sure you want to disable this brand?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Enabled</button>
                            </form>
                        @else
                            <form action="{{ route('brands.enable', $brand) }}" method="POST" onsubmit="return confirm('Are you sure you want to enable this brand?')">
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
        {{$brands->onEachSide(1)->links()}}
        </div>
    </div>
@endsection