@extends('layouts.master')

@section('title')
    Authers
@endsection

@section('navone')
    Auther
@endsection

@section('navtwo')
    update
@endsection

@section('content')
<div class="card card-primary card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">Horizontal Form</div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form method="post" action="{{route('author.update',$author->id)}}">
        @csrf
        @method('PUT')
        <!--begin::Body-->
        <div class="card-body">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{$author->name}}" />
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{$author->email}}" />
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" value="{{$author->password}}" />
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="gridCheck1"
                      name="is_admin"
                    />
                  </div>
                </div>
              </div>
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <!--end::Footer-->
    </form>
    <!--end::Form-->

</div>
@endsection