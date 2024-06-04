@extends('layouts.master')

@section('title')
    Users
@endsection

@section('navone')
    Books
@endsection

@section('navtwo')
    show
@endsection

@section('content')
<table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 10px">#</th>
        <th style="width: 20%">Name</th>
        <th style="width: 30%">Email</th>
        <th>Role</th>
        <th style="width: 20%">Process</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr class="align-middle">
        <td>{{$loop->index + 1}}.</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td><span class="badge text-bg-primary">{{$user->roles[0]->name}}</span></td>
        <td>
            <button class="btn btn-primary">edit</button>
            <button class="btn btn-danger">delete</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection