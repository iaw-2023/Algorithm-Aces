@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Brands</div>
                    <div class="card-body">
                        <ul>
                            @foreach($brands as $brand)
                                <li>
                                    {{ $brand->name }}
                                    <form action="{{ route('brands.destroy', $brand) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                    <a href="{{ route('brands.edit', $brand) }}" class="btn btn-primary btn-sm">Editar</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
