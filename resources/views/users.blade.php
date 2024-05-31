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
        <th>Task</th>
        <th>Progress</th>
        <th style="width: 40px">Label</th>
      </tr>
    </thead>
    <tbody>
      <tr class="align-middle">
        <td>1.</td>
        <td>Update software</td>
        <td>
          <div class="progress progress-xs">
            <div
              class="progress-bar progress-bar-danger"
              style="width: 55%"
            >
            </div>
          </div>
        </td>
        <td><span class="badge text-bg-danger">55%</span></td>
      </tr>
    </tbody>
  </table>
@endsection