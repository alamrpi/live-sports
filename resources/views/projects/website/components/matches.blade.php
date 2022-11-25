@if(count($matches['rows']) == 0)
    <div class="alert alert-warning">
        <span>Matches  Not Found</span>
    </div>
@endif

@foreach($matches['dates'] as $date)
    <div class="next-matches-schedule wf100">
        <h2 class="stitle">{{ date('d M, Y', strtotime($date)) }}</h2>
        <!--Box Start-->
        @foreach($matches['rows']->where('date', $date) as $row)
         <div class="nms-box">
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-logo-left">
                        <img src="{{ asset($row->first_club_logo) }}" alt="{{ $row->first_club_name }}">
                        <strong>{{ $row->first_club_name }}</strong>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="nms-info">
                        <strong class="vs">VS</strong>
                        <p> <strong>{{ $row->league_name }}</strong></p>
                        <p>{{ date('d M, Y', strtotime($row->date)) }}   |   {{ date('H:i', strtotime($row->time)) }}</p>
                        @if($row->sport_type == 'Online')
                            <p><span>{{ $row->channel }}</span></p>
                            <a href="{{ $row->channel_url }}" target="_blank">Watch Online</a>
                        @else
                            <p><span>{{ $row->location }}</span></p>
                            <a href="{{ $row->location_url }}" target="_blank">Buy Your Ticket</a>
                        @endif
                        <a style="margin-top: 3px;background: transparent;color: #7a7a7a;" href="{{ route('website/match', ['slug' => $row->slug]) }}">VIEW DETAILS</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-logo-right">
                        <img src="{{ asset($row->second_club_logo) }}" alt="{{ $row->second_club_name }}">
                        <strong>{{ $row->second_club_name }}</strong>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endforeach

