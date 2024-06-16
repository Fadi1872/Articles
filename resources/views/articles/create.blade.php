@extends('layouts.master')

@section('title')
    Articles
@endsection

@section('navone')
    Articles
@endsection

@section('navtwo')
    create
@endsection

@section('content')
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Create New Article</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form method="post" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Titele</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}" />
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="body" class="col-sm-2 col-form-label">Body</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body"
                            value="{{ old('body') }}">{{old('body')}}</textarea>
                        @error('body')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="title"
                            name="image" value="{{ old('image') }}" />
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="validationCustom04" name="category_id" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
@endsection
