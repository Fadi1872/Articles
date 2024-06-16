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
<a href={{route('author.create')}} class="btn btn-success mb-4">Add Auther</a>
<table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 10px">#</th>
        <th style="width: 20%">Name</th>
        <th style="width: 30%">Email</th>
        <th style="width: 30%">Passowrd</th>
        <th style="width: 30%">Country</th>
        <th style="width: 30%">Address</th>
        <th style="width: 30%">Path_file</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($authors as $author)

      <tr class="align-middle">
        <td>{{$loop->index + 1}}.</td>
        <td>{{$author->name}}</td>
        <td>{{$author->email}}</td>
        <td>{{$author->password}}</td>
        <td>
          <a href ="{{route('author.edit',$author->id)}}"class="btn btn-primary">edit</button>
        </td>
        <td>
          <form action="{{route('author.destroy',$author->id)}}" method="POST">
            @csrf
            @method('DELETE')
          <button type="submit" class="btn btn-danger">delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection