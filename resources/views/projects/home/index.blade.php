@extends('layouts.website-master')

@section('title')
    Live Sports
@endsection

@if(!empty($highlight_match))
    @section('match-counter')
        <div class="h3-match-counter">
            <button class="hide"><i class="fas fa-times"></i></button>
            <div class="container">
                <div class="row">
                    <ul>
                        <li class="col-md-1">
                            <div class="team-left">
                                <img src="{{ asset($highlight_match->first_club_logo) }}" height="50" alt="{{  $highlight_match->first_club_name }}">
                                <strong>{{ $highlight_match->first_club_name }}</strong>
                            </div>
                        </li>
                        <li class="col-md-3">
                            <input type="hidden" id="count_down_date" name="count_down_date" value="{{ date('d-m-Y', strtotime($highlight_match->date)).'-'. date('H-i', strtotime($highlight_match->time))}}">
                            <p class="mdate-time">
                                {{ date('d M, Y', strtotime($highlight_match->date)) }}
                                <strong> {{ date('H:i', strtotime($highlight_match->time)) }}</strong>
                            </p>
                        </li>
                        <li class="col-md-4">
                            <div class="defaultCountdown"></div>
                        </li>
                        <li class="col-md-3">
                            <p class="match-loc">
                            @if($highlight_match->sport_type == 'Online')
                                <i class="fas fa-location-arrow"></i>
                                {{ $highlight_match->channel }}
                            @else
                                <i class="fas fa-location-arrow"></i>
                                {{ $highlight_match->location }}
                            @endif
                            </p>
                        </li>
                        <li class="col-md-1">
                            <div class="team-right">
                                <img src="{{ asset($highlight_match->second_club_logo) }}" height="50" alt="{{ $highlight_match->second_club_name }}">
                                <strong>{{  $highlight_match->second_club_name }}</strong>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <!-- Match Counter Start -->
    @endsection
@endif

@section('content')
    <div class="main-content wf100">
        <section class="innerpagebg p80" style="padding-top:0;">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="sports-menu">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sports-menu-holder">
                                        <div class="row">
                                            @foreach($sports as $sport)
                                                <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6">
                                                    <a href="javascript:void(0)" onclick="changeSport({{ $sport->id }}, this)" class="sports-menu-link">
                                                        <img src="{{ asset($sport->icon) }}" alt="Football" width="30">
                                                        <p class="m-0">{{ $sport->name }}</p>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <input type="text" class="form-control sports-datepicker" name="date" id="datepicker" onchange="changeDateHandler(this.value)" placeholder="Select Date">
                                    <button type="button" class="btn btn-link p-0" onclick="reset()">Reset</button>
                                </div>
                                <div class="col-md-10" id="date-list">
                                    @include('.projects.website.components.date-list')
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-12" id="matches_list">
                                @include('.projects.website.components.matches')
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-success" id="btn_load_more" onclick="clickedLoadMore()" style="display: none;">LOAD MORE..</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <!--widget start-->
                            <div class="widget sidebar-ad">
                                <h4>Upcoming Matches</h4>
                                <!--Next Match Fixtures Width Start  -->
                                @foreach($upcoming_matches as $row)
                                    <div class="next-match-fixtures">
                                        <ul class="match-teams-vs">
                                            <li class="team-logo">
                                                <img src="{{ asset($row->first_club_logo) }}" alt="{{ $row->first_club_name }}">
                                                <strong>{{ $row->first_club_name }}</strong>
                                            </li>
                                            <li class="mvs">
                                                <p>
                                                    <strong>{{ $row->league_name }}</strong>
                                                    {{ date('d M, Y', strtotime($row->date)) }}   |   {{ date('H:i', strtotime($row->time)) }}
                                                </p>
                                                <strong class="vs">VS</strong>
                                            </li>
                                            <li class="team-logo">
                                                <img src="{{ asset($row->second_club_logo) }}" alt="">
                                                <strong>{{ $row->second_club_name }}</strong>
                                            </li>
                                        </ul>
                                        <ul class="nmf-loc">
                                            @if($row->sport_type == 'Online')
                                                <li><i class="fas fa-location-arrow"></i>{{ $row->channel }}</li>
                                                <li><a href="{{ $row->channel_url }}" target="_blank"><i class="fas fa-ticket-alt"></i>Watch Online</a></li>
                                            @else
                                                <li><i class="fas fa-location-arrow"></i>{{ $row->location }}</li>
                                                <li><a href="{{ $row->location_url }}" target="_blank"><i class="fas fa-ticket-alt"></i>Buy Your Ticket</a></li>
                                            @endif

                                        </ul>
                                    </div>
                                <!--Next SportMatch Fixtures Width End  -->
                                @endforeach
                            </div>
                            <!--widget end-->
                            <!--widget start-->
                            <div class="widget">
                                <h4>Featured Videos</h4>
                                <div class="featured-video-widget">
                                    <div class="fvideo-box mb15">
                                        <div class="fvid-cap">
                                            <a class="vicon" href="#"><img src="{{ asset('website/images/play.png') }}" alt=""></a>
                                            <div class="fvid-right">
                                                <h5><a href="#">Success is a Result of Hard Work </a></h5>
                                                <span><i class="far fa-clock"></i> 4:32</span> <span><i class="far fa-eye"></i> 174</span>
                                            </div>
                                        </div>
                                        <img src="{{ asset('website/images/fvid1.jpg') }}" alt="">
                                    </div>
                                    <div class="fvideo-box">
                                        <div class="fvid-cap">
                                            <a class="vicon" href="#"><img src="{{ asset('website/images/play.png') }}" alt=""></a>
                                            <div class="fvid-right">
                                                <h5><a href="#">Success is a Result of Hard Work </a></h5>
                                                <span><i class="far fa-clock"></i> 4:32</span> <span><i class="far fa-eye"></i> 174</span>
                                            </div>
                                        </div>
                                        <img src="{{ asset('website/images/fvid2.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <!--widget end-->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--News & Updates Start-->
        <section class="news-updates wf100 p90">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>News Updates</h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="newsupdate-slider" class="owl-carousel owl-theme">
                            @foreach($news as $row)
                            <!--Item Start-->
                            <div class="item">
                                <div class="hnews-box">
                                    <div class="thumb">
                                        <a href="{{ route('website/news/details', ['slug' => $row->slug]) }}">
                                            <i class="fas fa-link"></i>
                                        </a>
                                        <img src="{{ asset($row->feature_image) }}" alt="">
                                    </div>
                                    <div class="hnews-txt">
                                        <ul class="news-meta">
                                            <li><i class="fas fa-calendar-alt"></i> {{ date('d M, Y', strtotime($row->created_at)) }}</li>
                                        </ul>
                                        <h4>
                                            <a href="{{ route('website/news/details', ['slug' => $row->slug]) }}">{{ $row->title }}</a>
                                        </h4>
                                        <a class="rm" href="{{ route('website/news/details', ['slug' => $row->slug]) }}">News Detail <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!--Item End-->
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--News & Updates End-->
    </div>
@endsection

@section('script')
    <script>
        const APP_URL = {!! json_encode(url('/')) !!};
        let totalPage = {{ $matches['pages'] }};
        let currentPage = 1;
        let sportId = null;
        let date = null;
        $(document).ready(() => {
            //if next page available then show load more button
            showOrHide();
        });

        const showOrHide = () =>{
            if(totalPage > currentPage){
                $('#btn_load_more').show();
            }else{
                $('#btn_load_more').hide();
            }
        }
        //Load matches re-us able methods
        const loadData = (is_date_list_change = false) => {
            $.ajax({
                url: APP_URL + '/get-matches',
                type: 'post',
                dataType: 'json',
                data: {
                    'current_page':currentPage,
                    'sport_id': sportId,
                    'date': date,
                    '_token':$('meta[name=csrf-token]').attr("content")
                },
                success: function ({status, view, pages, error, dates}) {
                    console.log(view)
                    if(status === 200){
                        //Load more button un-disabled and loading text change
                        $('#btn_load_more').text('LOAD MORE...').attr('disabled', false);

                        //Render SportMatch list
                        $('#matches_list').html(view);
                        totalPage = pages;
                        if(is_date_list_change){
                            $('#date-list').html(dates);
                        }

                        //is next page not available then load more btn hide
                        showOrHide();
                    }else{
                        $('#matches_list').html('<p class="text-danger">'+error+'</p>');
                        // showErrorMessage(res.error);
                    }
                }
            });
        }

        const changeDateHandler = (date_value) => {;
            currentPage = 1;
            $('#matches_list').html('<span class="text-danger">Loading...<span>');
            date = date_value;
            loadData();
        }

        //change sport handler functions
        const changeSport = (sport_id, current_el) => {
            $('.sports-menu-link').removeClass('active');
            $(current_el).addClass('active')
            currentPage = 1;
            $('#matches_list').html('<span class="text-danger">Loading...<span>');
            sportId = sport_id;
            loadData(true);
        }

        //Clicked load more button handler
        const clickedLoadMore = () => {
            $('#btn_load_more').text('Loading...').attr('disabled', true);
            currentPage++;
            loadData();
        }

        const reset = () => {
            $('.sports-menu-link').removeClass('active');
            $('#datepicker').val('');
             currentPage = 1;
             sportId = null;
             date = null;
            loadData(true);
        }
        //Initialize date picker
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            clearBtn: true,
            todayBtn: true,
            todayHighlight: true,
        });
    </script>
@endsection
