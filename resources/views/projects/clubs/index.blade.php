@extends('layouts.master')

@section('title')
    Clubs
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clubs</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Clubs</span>
                <a href="{{ route('clubs/create') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-plus-circle"></i> Add Club</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#SL</th>
                                <th class="text-center">Logo</th>
                                <th>Club Name</th>
                                <th>Sport</th>
                                <th class="text-center">Banner</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clubs as $row)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-center"><img src="{{ asset($row->logo) }}" alt="logo"
                                                                 style="height: 50px" class="img-thumbnail"></td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->sport_name }}</td>
                                    <td class="text-center"><img src="{{ asset($row->banner) }}" alt="logo"
                                                                 style="height: 50px" class="img-thumbnail"></td>
                                    <td class="text-center">
                                        <form class="btn-group-sm" id="delete-form" method="POST"
                                              action="{{ route('clubs/destroy', ['id' => $row->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('clubs/edit', ['id' => $row->id]) }}" type="button"
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
                        {{ $clubs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
