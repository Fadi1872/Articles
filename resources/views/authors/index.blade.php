@extends('layouts.master')

@section('title')
    Authers
@endsection

@section('navone')
    Auther
@endsection

@section('navtwo')
    show
@endsection

@section('content')
    <a href={{ route('author.create') }} class="btn btn-success mb-4">Add Auther</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 10%">Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 10%">Country</th>
                <th style="width: 20%">Address</th>
                <th style="width: 30%">Process</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $item)
                <tr class="align-middle">
                    <td>{{ $loop->index + 1 }}.</td>
                    <td>{{ $item->userData->name }}</td>
                    <td>{{ $item->userData->email }}</td>
                    <td>{{ $item->requestData->country }}</td>
                    <td>{{ $item->requestData->address }}</td>
                    
                    <td>
                        <form action="{{ route('author.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href ="{{ route('author.edit', $item->id) }}"class="btn btn-primary">edit</a>
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
