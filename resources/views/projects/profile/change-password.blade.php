@extends('layouts.master')

@section('title')
    Change Password
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                 @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('changePassword/Store') }}" method="POST">
                            @csrf
                            <div class="row mb-2">
                                <label for="current-password" class="col-md-4 text-end">Current Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="password" name="current-password" id="current-password"
                                           value="{{ old('current-password') }}" required
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('current-password'))
                                        <small class="form-text text-danger">{{ $errors->first('current-password') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="new-password" class="col-md-4 text-end">New Password <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="password" name="new-password" id="new-password"
                                           value="{{ old('new-password') }}" required
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('new-password'))
                                        <small class="form-text text-danger">{{ $errors->first('new-password') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="new-password_confirmation" class="col-md-4 text-end">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="password" name="new-password_confirmation" id="new-password_confirmation"
                                           value="{{ old('new-password_confirmation') }}" required
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('new-password_confirmation'))
                                        <small class="form-text text-danger">{{ $errors->first('new-password_confirmation') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-10 text-end">
                                    <button class="btn btn-sm btn-primary"> Change Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
