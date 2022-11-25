@extends('layouts.master')

@section('title')
    Edit Match
@endsection

@section('body')
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('matches/index') }}">Matches</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <span class="card-subtitle">Match Edit</span>
                <a href="{{ route('matches/index') }}" class="btn btn-sm btn-primary float-end"><i
                            class="fas fa-table"></i> Match List</a>
            </div>
            <div class="card-body">
                @include('templates.message')
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('matches/update', ['id' => $match->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-2">
                                <label for="sport_id" class="col-md-3 text-end">Sport <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select class="form-select form-select-sm" onchange="getLeagueAndClubs(this.value)" name="sport_id" id="sport_id" required>
                                        <option value="">--Select--</option>
                                        @foreach($sports as $row)
                                            <option value="{{ $row->id }}" {{ $match->sport_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('sport_id'))
                                        <small class="form-text text-danger">{{ $errors->first('sport_id') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="league_id" class="col-md-3 text-end">League <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select class="form-select form-select-sm" name="league_id" id="league_id" required>
                                        <option value="">--Select--</option>
                                        @foreach($leagues as $row)
                                            <option value="{{ $row->id }}" {{ $match->league_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('league_id'))
                                        <small class="form-text text-danger">{{ $errors->first('league_id') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="club_id_one" class="col-md-3 text-end">Club <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <div class="input-group input-group-sm">
                                        <select class="form-select form-select-sm" name="club_id_one" id="club_id_one"
                                                required>
                                            <option value="">--Select--</option>
                                            @foreach($clubs as $row)
                                                <option value="{{ $row->id }}" {{ $match->club_id_one == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="club_id_two" class="input-group-text">VS</label>
                                        <select class="form-select form-select-sm" name="club_id_two" id="club_id_two"
                                                required>
                                            <option value="">--Select--</option>
                                            @foreach($clubs as $row)
                                                <option value="{{ $row->id }}" {{ $match->club_id_two == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('club_id_one'))
                                        <small class="form-text text-danger">{{ $errors->first('club_id_one') }}</small>
                                    @endif
                                    @if ($errors->has('club_id_two'))
                                        <small class="form-text text-danger">{{ $errors->first('club_id_two') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="date" class="col-md-3 text-end">Date <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="date" name="date" id="date" value="{{ $match->date }}" required
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('date'))
                                        <small class="form-text text-danger">{{ $errors->first('date') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="time" class="col-md-3 text-end">Time <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="time" name="time" id="time" value="{{ $match->time }}" required
                                           class="form-control-sm form-control"/>
                                    @if ($errors->has('time'))
                                        <small class="form-text text-danger">{{ $errors->first('time') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="sport_type" class="col-md-3 text-end">Sport Type <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select class="form-select form-select-sm" onchange="changedMatchType(this.value)" name="sport_type" id="sport_type"
                                            required>
                                        <option value="">--Select--</option>
                                        <option value="Online" {{ $match->sport_type == 'Online' ? 'selected' : '' }}>
                                            Online
                                        </option>
                                        <option value="Offline" {{ $match->sport_type == 'Offline' ? 'selected' : '' }}>
                                            Offline
                                        </option>
                                    </select>
                                    @if ($errors->has('sport_type'))
                                        <small class="form-text text-danger">{{ $errors->first('sport_type') }}</small>
                                    @endif
                                </div>
                            </div>
                            @if($match->sport_type == 'Online')
                                <div class="row mt-2" id="channel_section">
                                    <label for="channel" class="col-md-3 text-end">Channel</label>
                                    <div class="col-md-7">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="channel" placeholder="Name"
                                                   id="channel" value="{{ $match->channel }}"/>
                                            <input type="text" class="form-control" placeholder="URL" name="channel_url"
                                                   id="channel_url" value="{{ $match->channel_url }}"/>
                                        </div>
                                        @if ($errors->has('channel'))
                                            <small class="form-text text-danger">{{ $errors->first('channel') }}</small>
                                        @endif
                                        @if ($errors->has('channel_url'))
                                            <small class="form-text text-danger">{{ $errors->first('channel_url') }}</small>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if($match->sport_type == 'Offline')
                                <div class="row mt-2" id="location_section">
                                    <label for="location" class="col-md-3 text-end">Location</label>
                                    <div class="col-md-7">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="location" placeholder="Stadium Name" id="location" value="{{ $match->location }}"/>
                                            <input type="text" class="form-control" placeholder="URL" name="location_url" id="location_url" value="{{ $match->location_url }}"/>
                                        </div>
                                        @if ($errors->has('location'))
                                            <small class="form-text text-danger">{{ $errors->first('location') }}</small>
                                        @endif
                                        @if ($errors->has('location_url'))
                                            <small class="form-text text-danger">{{ $errors->first('location_url') }}</small>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="row mt-2">
                                <label for="description" class="col-md-3 text-end">Description</label>
                                <div class="col-md-7">
                                   <textarea class="form-control form-control-sm summernote" name="description"
                                             id="description">
                                        {{ $match->description }}
                                   </textarea>
                                    @if ($errors->has('description'))
                                        <small class="form-text text-danger">{{ $errors->first('description') }}</small>
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


@section('script')
    <script>
        const APP_URL = {!! json_encode(url('/')) !!};
        const getLeagueAndClubs = (sport_id) => {
            if(sport_id !== ''){
                $('#league_id').html('<option value="">Loading...</option>');
                $('#club_id_one').html('<option value="">Loading...</option>');
                $('#club_id_two').html('<option value="">Loading...</option>');
                $.ajax({
                    url: APP_URL+'/admin/matches/get-leagues-clubs',
                    type: "post",
                    data: {'sport_id':sport_id,'_token':$('meta[name=csrf-token]').attr("content")},
                    dataType: "json",
                    success: function({status, data, leagues, clubs}){
                        if (status == 500){
                            console.log(data)
                            $('#league_id').html('<option value="">Please select sport</option>').attr('disabled', true);
                            $('#club_id_one').html('<option value="">Please select sport</option>').attr('disabled', true);
                            $('#club_id_two').html('<option value="">Please select sport</option>').attr('disabled', true);
                        }else{
                            $('#league_id').html(leagues).attr('disabled', false);
                            $('#club_id_one').html(clubs).attr('disabled', false);
                            $('#club_id_two').html(clubs).attr('disabled', false);
                        }
                    }
                });
            }else{
                $('#league_id').html('<option value="">Please sport customer</option>').attr('disabled', true);
                $('#club_id_one').html('<option value="">Please sport customer</option>').attr('disabled', true);
                $('#club_id_two').html('<option value="">Please sport customer</option>').attr('disabled', true);
            }
        }

        const changedMatchType = (match_type) => {
            if(match_type === 'Online'){
                $('#channel_section').show();
                $('#location_section').hide();
            }else if(match_type === 'Offline'){
                $('#channel_section').hide();
                $('#location_section').show();
            }else{
                $('#channel_section').hide();
                $('#location_section').hide();
            }
        }
    </script>
@endsection
