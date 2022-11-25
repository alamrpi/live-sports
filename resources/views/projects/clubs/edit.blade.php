@extends('layouts.master')

@section('title')
    Edit Club
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('leagues/index') }}">Clubs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Club Edit</span>
                <a href="{{ route('clubs/index') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-table"></i> Clubs</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('clubs/update', ['id' => $club->id]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <label for="name" class="col-md-3 text-end">Name <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" name="name" id="name" value="{{ $club->name }}" required
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('name'))
                                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="sport_id" class="col-md-3 text-end">Sport <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select class="form-select form-select-sm" name="sport_id" id="sport_id" required>
                                        <option value="">--Select--</option>
                                        @foreach($sports as $row)
                                            <option value="{{ $row->id }}" {{ $club->sport_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
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
                                        {{ $club->description }}
                                   </textarea>
                                    @if ($errors->has('description'))
                                        <small class="form-text text-danger">{{ $errors->first('description') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label for="logo" class="col-md-3 text-end">Logo</label>
                                <div class="col-md-7">
                                    <input type="file" name="logo" id="logo" value="{{ old('logo') }}"
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('logo'))
                                        <small class="form-text text-danger">{{ $errors->first('logo') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label for="banner" class="col-md-3 text-end">Banner</label>
                                <div class="col-md-7">
                                    <input type="file" name="banner" id="banner" value="{{ old('banner') }}"
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('banner'))
                                        <small class="form-text text-danger">{{ $errors->first('banner') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-10 text-end">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
