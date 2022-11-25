@extends('layouts.website-master')

@section('title')
    {{ $news->title }}
@endsection

@section('content')
    <div class="inner-banner-header wf100">
        <h1 data-generated="News List">News Details</h1>
        <div class="gt-breadcrumbs">
            <ul>
                <li> <a href="{{ route('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
                <li> <a href="{{ route('website/news/index') }}"> News </a> </li>
                <li class="active">Details</li>
            </ul>
        </div>
    </div>
    <div class="main-content innerpagebg wf100 p80">
        <!--News Large Page Start-->
        <!--Start-->
        <div class="news-details">
            <div class="container">
                <div class="row">
                    <!--News Start-->
                    <div class="col-lg-8">
                        <div class="news-details-wrap">
                            <div class="news-large-post">
                                <div class="post-thumb"> <img src="{{ asset($news->feature_image) }}" alt=""></div>
                                <div class="post-txt">
                                    <h3>{{ $news->title }}</h3>
                                    <ul class="post-meta">
                                        <li><i class="fas fa-calendar-alt"></i> {{ date('d M, Y', strtotime($news->created_at)) }}</li>
                                        <li><i class="far fa-comment"></i> {{ count($comments) }} Comments</li>
                                    </ul>

                                    {!! $news->description !!}
                                </div>
                                <div class="post-bottom">
                                    <!--Post Comments Start-->
                                    <div class="post-comments">
                                        <h3 class="stitle">Comments on Post ({{ count($comments) }})</h3>
                                        <ul class="comments">
                                            @foreach($comments as $comment)
                                                <li class="comment">
                                                    <div class="user-thumb custom-alpha-thumb">
                                                       {{ $comment->avatar }}
                                                    </div>
                                                    <div class="user-comments">
                                                        <h6 class="aname">{{ $comment->name }}</h6>
                                                        <ul class="post-time">
                                                            <li>Posted: {{ date("d M, Y", strtotime($comment->created_at)) }} at {{ date("h:i A", strtotime($comment->created_at)) }}</li>
                                                        </ul>
                                                        <p>{{ $comment->comments }}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!--Post Comments End-->
                                    <!--comments form Start-->
                                    <div class="post-comments-form">
                                        <h3 class="stitle">Leave a Comment</h3>
                                        <div id="msg" style="padding-right: 20px;">

                                        </div>
                                        <form action="" method="post" id="comment-form">
                                            <ul>
                                                <li class="half-col">
                                                    <input type="text" name="name" required id="name" placeholder="Full Name">
                                                </li>
                                                <li class="half-col">
                                                    <input type="text" name="email" required id="email" placeholder="Email">
                                                </li>
                                                <li class="full-col">
                                                    <textarea placeholder="Write Comments" name="comments" id="comments" required></textarea>
                                                </li>
                                                <li class="full-col">
                                                    <input id="btn_submit" type="submit" value="Post Your Comment">
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                    <!--comments form End-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--News End-->
                    <!--Sidebar Start-->
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="widget">
                                <form action="{{ route('website/news/index') }}">
                                    <div class="input-group">
                                        <input type="hidden" name="cat" value="{{ request()->input('cat') }}">
                                        <input type="text" name="title" id="title" class="form-control" value="{{ request()->input('title') }}" />
                                        <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="widget">
                                <h4>Categories</h4>
                                <div class="list-group">
                                    @foreach($categories as $cat)
                                        <a href="{{ route('website/news/index', ['cat' => $cat->slug]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            {{ $cat->category_name }}
                                            <span class="badge badge-primary badge-pill">{{ $cat->total }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="widget">
                                <h4>Recent News</h4>
                                <div class="top-stories-widget">
                                    <div id="top-stories" class="owl-carousel owl-theme">
                                        <!--Slide 1 Start-->
                                        <div class="item">
                                            <ul class="top-stories">
                                                <!--Story Start-->
                                                @foreach($recent_news as $r_news)
                                                    <li class="story-row">
                                                        <div class="ts-thumb"><img style="width: auto;height: 15vh;" src="{{ asset($r_news->feature_image) }}" alt=""> </div>
                                                        <div class="ts-txt">
                                                            <h5> <a href="{{ route('website/news/details', ['slug' => $r_news->slug]) }}">{{ $r_news->title }}</a>
                                                            </h5>
                                                            <ul class="tsw-meta">
                                                                <li>{{ date('d M, Y', strtotime($r_news->created_at)) }}</li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!--Slide 1 End-->
                                        @if(count($recent_news2) > 0)
                                            <!--Slide 2 Start-->
                                            <div class="item">
                                                <ul class="top-stories">
                                                    @foreach($recent_news2 as $r_news)
                                                        <li class="story-row">
                                                            <div class="ts-thumb"><img style="width: auto;height: 15vh;" src="{{ asset($r_news->feature_image) }}" alt=""> </div>
                                                            <div class="ts-txt">
                                                                <h5> <a href="{{ route('website/news/details', ['slug' => $r_news->slug]) }}">{{ $r_news->title }}</a>
                                                                </h5>
                                                                <ul class="tsw-meta">
                                                                    <li>{{ date('d M, Y', strtotime($r_news->created_at)) }}</li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <!--Slide 2 End-->
                                        @if(count($recent_news3) > 0)
                                            <!--Slide 3 Start-->
                                            <div class="item">
                                                <ul class="top-stories">
                                                    @foreach($recent_news3 as $r_news)
                                                        <li class="story-row">
                                                            <div class="ts-thumb"><img style="width: auto;height: 15vh;" src="{{ asset($r_news->feature_image) }}" alt=""> </div>
                                                            <div class="ts-txt">
                                                                <h5> <a href="{{ route('website/news/details', ['slug' => $r_news->slug]) }}">{{ $r_news->title }}</a>
                                                                </h5>
                                                                <ul class="tsw-meta">
                                                                    <li>{{ date('d M, Y', strtotime($r_news->created_at)) }}</li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <!--Slide 3 End-->
                                    </div>
                                </div>
                            </div>
                            <!--widget end-->

                            <!--widget start-->
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
                            <!--widget start-->
                        </div>
                    </div>
                    <!--Sidebar End-->
                </div>
            </div>
        </div>
        <!--End-->
    </div>
@endsection

@section('script')
    <script>
        const APP_URL = {!! json_encode(url('/')) !!};

        $("#comment-form").submit(function(e){
            e.preventDefault();
            $('#btn_submit').attr('disabled', true);
            $.ajax({
                url: APP_URL + '/news/comments',
                type: 'post',
                dataType: 'json',
                data: {
                    'news_id': '{{ $news->id }}',
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'comments': $('#comments').val(),
                    '_token':$('meta[name=csrf-token]').attr("content")
                },
                success: function ({status, data}) {
                    if(status === 200){
                        $('#btn_submit').removeAttr('disabled');
                        $('#msg').html(`
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Success!</strong> Your comment has been posted.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                             </div>
                        `)
                    }else{
                        $('#btn_submit').removeAttr('disabled');
                        $('#msg').html(`
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Error!</strong> ${data}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                `);

                    }
                }
            });
        });

    </script>
@endsection
