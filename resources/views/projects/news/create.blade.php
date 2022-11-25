@extends('layouts.master')

@section('title')
    Create News
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news/index') }}">News List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">News Create</span>
                <a href="{{ route('news/index') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-table"></i> News List</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('news/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <label for="title" class="col-md-3 text-end">Title <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('title'))
                                        <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="category_id" class="col-md-3 text-end">Category <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select class="form-select form-select-sm" name="category_id" id="category_id"
                                            required>
                                        <option value="">--Select--</option>
                                        @foreach($categories as $row)
                                            <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected' : '' }}>{{ $row->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('sport_id'))
                                        <small class="form-text text-danger">{{ $errors->first('sport_id') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="description" class="col-md-3 text-end">Description</label>
                                <div class="col-md-7">
                                   <textarea class="form-control form-control-sm summernote" name="description"
                                             id="description">
                                        {{ old('description') }}
                                   </textarea>
                                    @if ($errors->has('description'))
                                        <small class="form-text text-danger">{{ $errors->first('description') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label for="logo" class="col-md-3 text-end">Feature Image</label>
                                <div class="col-md-7">
                                    <input type="file" name="feature_image" id="feature_image"
                                           value="{{ old('feature_image') }}" class="form-control-sm form-control"/>
                                    @if ($errors->has('feature_image'))
                                        <small class="form-text text-danger">{{ $errors->first('feature_image') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-10 text-end">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
