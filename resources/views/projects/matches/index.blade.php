@extends('layouts.master')

@section('title')
    Matches
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Matches</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Matches</span>
                <a href="{{ route('matches/create') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-plus-circle"></i> Add Match</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#SL</th>
                                <th>Sport</th>
                                <th>League</th>
                                <th>Club</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Sport Type</th>
                                <th class="text-center">Highlight</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($matches as $row)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $row->sport_name }}</td>
                                    <td>{{ $row->league_name }}</td>
                                    <td>{{ $row->first_club_name }} <strong>VS</strong> {{ $row->second_club_name }}
                                    </td>
                                    <td class="text-center">{{ date('d/m/Y', strtotime($row->date)) }}</td>
                                    <td class="text-center">{{ date('h:m A', strtotime($row->time)) }}</td>
                                    <td class="text-center">{{ $row->sport_type }}</td>
                                    <td class="text-center">
                                        @if($row->highlight == 0)
                                            <a href="{{ route('matches/highlight', ['id' => $row->id]) }}" class="badge bg-info confirm-alert" title="Highlight Now">
                                                <i class="fas fa-check-square"></i>
                                            </a>
                                        @else
                                            <span class="badge bg-success" title="Highlighted"><i class="fas fa-check-circle"></i></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form class="btn-group-sm" id="delete-form" method="POST"
                                              action="{{ route('matches/destroy', ['id' => $row->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('matches/edit', ['id' => $row->id]) }}" type="button"
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
                        {{ $matches->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
