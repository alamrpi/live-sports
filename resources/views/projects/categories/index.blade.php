@extends('layouts.master')

@section('title')
    Categories
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Sports</span>
                <a href="{{ route('categories/create') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-plus-circle"></i> Add Category</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#SL</th>
                                <th>Category Name</th>
                                <th>Slug</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $row)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>{{ $row->slug }}</td>
                                    <td class="text-center">
                                        <form class="btn-group-sm" id="delete-form_{{ $row->id }}" method="POST"
                                              action="{{ route('categories/destroy', ['id' => $row->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('categories/edit', ['id' => $row->id]) }}" type="button"
                                               class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                            <button type="button" onclick="ConfirmForm('delete-form_{{ $row->id }}')"
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
