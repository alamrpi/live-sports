@extends('layouts.master')

@section('title')
    Edit Sport
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sports/index') }}">Sports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Sport Edit</span>
                <a href="{{ route('sports/index') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-table"></i> Sports</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('sports/update', ['id' => $sport->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <label for="name" class="col-md-4 text-end">Sport Name <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" required
                                           class="form-control-sm form-control" value="{{ $sport->name }}"/>
                                    @if ($errors->has('name'))
                                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="icon" class="col-md-4 text-end">Icon</label>
                                <div class="col-md-6">
                                    <input type="file" name="icon" id="icon" class="form-control-sm form-control"
                                           />
                                    @if ($errors->has('icon'))
                                        <small class="form-text text-danger">{{ $errors->first('icon') }}</small>
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
