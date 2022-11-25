@extends('layouts.master')

@section('title')
    Sports
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sports</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Sports</span>
                <a href="{{ route('sports/create') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-plus-circle"></i> Add Sports</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#SL</th>
                                <th class="text-center">Icon</th>
                                <th class="w-50">Sport Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sports as $sport)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-center"><img src="{{ asset($sport->icon) }}" alt="" height="30"></td>
                                    <td>{{ $sport->name }}</td>
                                    <td class="text-center">
                                        <form class="btn-group-sm" id="delete-form" method="POST"
                                              action="{{ route('sports/destroy', ['id' => $sport->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('sports/edit', ['id' => $sport->id]) }}" type="button"
                                               class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                            <button type="button" onclick="ConfirmForm('delete-form')"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-end">
                        {{ $sports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
