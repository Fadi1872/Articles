@extends('layouts.master')

@section('title')
    Users
@endsection

@section('navone')
    users
@endsection

@section('navtwo')
    list
@endsection

@section('content')
<a href="{{route('user.create')}}" class="btn btn-success mb-4">Add User</a>
<table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 10px">#</th>
        <th style="width: 20%">Name</th>
        <th style="width: 30%">Email</th>
        <th style="width: 30%">Passowrd</th>
        
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr class="align-middle">
        <td>{{$loop->index + 1}}.</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->password}}</td>
        <td>
          <a href ="{{route('user.edit',$user->id)}}"class="btn btn-primary">edit</button>
        </td>
        <td>
          <form action="{{route('user.destroy',$user->id)}}" method="POST">
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
