@extends('layouts.master')

@section('title')
    Comments
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Comments</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Comment List</span>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#SL</th>
                                <th>News Title</th>
                                <th>Commenter</th>
                                <th>Commenter Email</th>
                                <th>Comments</th>
                                <th class="text-center">Approval Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $row)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->comments }}</td>
                                    <td class="text-center ">
                                        @if($row->approve === 1)
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-times text-danger"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('comments/toggleApprove', ['id' => $row->id]) }}" type="button" class="dropdown-item">
                                                       @if($row->approve == 1)
                                                            <i class="fas fa-times-circle"></i> Not Approve
                                                        @else
                                                            <i class="fas fa-check-circle"></i> Approve
                                                        @endif
                                                    </a>
                                                </li>
                                                <li>
                                                    <form class="btn-group-sm" id="delete-form-{{ $row->id }}" method="POST" action="{{ route('comments/destroy', ['id' => $row->id]) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" onclick="ConfirmForm('delete-form-{{ $row->id }}')" class="dropdown-item"><i class="fas fa-trash-alt"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-end">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
