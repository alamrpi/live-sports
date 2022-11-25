@extends('layouts.master')

@section('title')
    Create Category
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories/index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Category Create</span>
                <a href="{{ route('categories/index') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-table"></i> Categories</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('categories/store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <label for="category_name" class="col-md-4 text-end">Category Name <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" name="category_name" id="category_name"
                                           value="{{ old('category_name') }}" required
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('category_name'))
                                        <small class="form-text text-danger">{{ $errors->first('category_name') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-10 text-end">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
