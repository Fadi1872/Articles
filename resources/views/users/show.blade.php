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
        <th style="width: 50%">Email</th>        
        <th style="width: 10%">Role</th>        
        <th style="width: 20%">Process</th>        
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr class="align-middle">
        <td>{{$loop->index + 1}}.</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td><p class="badge text-bg-primary mb-0">{{$user->roles[0]->name}}</p></td>
        <td class="d-flex gap-2">
          <a href ="{{route('user.edit',$user->id)}}"class="btn btn-primary">edit</a>
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
