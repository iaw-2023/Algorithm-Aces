@extends('home')

@section('content')
    <div class="container">
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->email }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
        </div>
    </div>
@endsection