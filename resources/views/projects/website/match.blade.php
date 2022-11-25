@extends('layouts.website-master')

@section('title')
    Match
@endsection

@section('content')
    <div class="match-header upcoming-match wf100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5>{{ $match->league_name }}</h5>
                    <ul class="teamz">
                        <li class="mt-left"><img src="{{ asset($match->first_club_logo) }}" alt=""> <strong>{{ $match->first_club_name }}</strong> </li>
                        <li class="mt-center-score">
                            <span class="vs">VS</span>
                            <ul class="up-match-meta">
                                <li><i class="fas fa-calendar-alt"></i> {{ date('d M, Y', strtotime($match->date)) }}</li>
                                <li><i class="far fa-clock"></i> {{ date('H:i', strtotime($match->time)) }}</li>
                                @if($match->sport_type == 'Online')
                                <li>
                                    <i class="fas fa-map-marker-alt"></i> {{ $match->channel }}
                                    <br>
                                    <a href="{{ $match->channel_url }}" target="_blank" style="color:#ff5d76;"><i class="fas fa-ticket-alt"></i> WATCH ONLINE</a>
                                </li>
                                @else
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i> {{ $match->location }}
                                        <br>
                                        <a href="{{ $match->location_url }}" target="_blank" style="color:#ff5d76;"><i class="fas fa-ticket-alt"></i> BUY YOUR TICKET</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="mt-right"> <img src="{{ asset($match->second_club_logo) }}" alt=""> <strong>{{ $match->second_club_name }}</strong> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="match-counter">
            <div class="container">
                <div class="defaultCountdown"></div>
                <input type="hidden" id="count_down_date" name="count_down_date" value="{{ date('d-m-Y', strtotime($match->date)).'-'. date('H-i', strtotime($match->time))}}">
            </div>
        </div>
    </div>
    <div class="main-content innerpagebg wf100 p80" style="padding-bottom: 0;padding-top:30px;">
        <div class="container">
                <div class="row">
                    <!--News Start-->
                    <div class="col-lg-8">
                        <div class="player-bio">
                            <h4>Match Details</h4>
                            <div class="txt">
                               {!! $match->description !!}
                            </div>
                        </div>
                    </div>
                    <!--News End-->
                    <!--Sidebar Start-->
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="widget">
                                @if(count($upcoming_matches) > 0)
                                    <h4>Upcoming Match </h4>
                                @endif
                                @foreach($upcoming_matches as $row)
                                    <div class="last-match-widget mb-2">
                                        <p> <strong>{{ $row->league_name }}</strong> {{ date('d M, Y', strtotime($row->date)) }}  |  {{ date('H:i', strtotime($row->time)) }} </p>
                                        <ul class="match-teams-vs">
                                            <li class="team-logo"><img class="img-fluid" src="{{ asset($row->first_club_logo) }}" alt=""> <strong>{{ $row->first_club_name }}</strong> </li>
                                            <li class="mvs"> <span class="vs">VS</span> </li>
                                            <li class="team-logo"><img class="img-fluid" src="{{ asset($row->second_club_logo) }}" alt=""> <strong>{{ $row->second_club_name }}</strong> </li>
                                        </ul>
                                        @if($row->sport_type == 'Online')
                                            <p class="mloc"> <i class="fas fa-location-arrow"></i> {{ $row->channel }}</p>
                                        @else
                                            <p class="mloc"> <i class="fas fa-location-arrow"></i> {{ $row->location }}</p>
                                        @endif
                                        <div class="defaultCountdown"></div>
                                        @if($row->sport_type == 'Online')
                                            <div class="buyticket-btn"><a href="{{ $row->channel_url }}">Watch Online</a></div>
                                        @else
                                            <div class="buyticket-btn"><a href="{{ $row->location_url }}">Buy Your Ticket</a></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
