@extends('layouts.website-master')

@section('title')
    News
@endsection

@section('content')
    <div class="inner-banner-header wf100">
        <h1 data-generated="News List">News</h1>
        <div class="gt-breadcrumbs">
            <ul>
                <li><a href="{{ route('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
                <li class="active">News</li>
            </ul>
        </div>
    </div>
    <div class="main-content innerpagebg wf100 p80" style="padding-bottom: 0;">
        <!--News Large Page Start-->
        <!--Start-->
        <div class="news-list">
            <div class="container">
                <div class="row">
                    <!--News Start-->
                    <div class="col-lg-8">
                        <div class="news-wrap">
                            @foreach($news as $row)
                            <!--Post Start-->
                            <div class="news-list-post">
                                <div class="post-thumb">
                                    <a href="{{ route('website/news/details', ['slug' => $row->slug]) }}">
                                        <i class="fas fa-link"></i>
                                    </a>
                                    <img style="width: auto;height: 51vh;" src="{{ asset($row->feature_image) }}" alt="">
                                </div>
                                <div class="post-txt">
                                    <h4><a href="{{ route('website/news/details', ['slug' => $row->slug]) }}">{{ $row->title }}</a></h4>
                                    <ul class="post-meta">
                                        <li><i class="fas fa-calendar-alt"></i> {{ date('d M, Y', strtotime($row->created_at)) }}</li>
                                        <li><i class="far fa-comment"></i> {{ $row->comments_count }} Comments</li>
                                    </ul>
                                    <p>{{ strip_tags(preg_replace('/ .*".*"/', '', $row->description)) }}</p>
                                    <a href="{{ route('website/news/details', ['slug' => $row->slug]) }}" class="rm">Read More</a>
                                </div>
                            </div>
                            <!--Post End-->
                            @endforeach

                            <div class="gt-pagination">
                               {{ $news->links() }}
{{--                                <nav aria-label="Page navigation example">--}}
{{--                                    <ul class="pagination justify-content-center">--}}
{{--                                        <li class="page-item"> <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i--}}
{{--                                                    class="fas fa-angle-left"></i></a> </li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                                        <li class="page-item active"><a class="page-link" href="#">2</a></li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                        <li class="page-item"> <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a> </li>--}}
{{--                                    </ul>--}}
{{--                                </nav>--}}
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
                            <!--widget start-->
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
                                        <img src="{{ asset('website/images/fvid2.jpg') }}" alt="">
                                    </div>
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
                                    <div class="fvideo-box mb15">
                                        <div class="fvid-cap">
                                            <a class="vicon" href="#"><img src="{{ asset('website/images/play.png') }}" alt=""></a>
                                            <div class="fvid-right">
                                                <h5><a href="#">Success is a Result of Hard Work </a></h5>
                                                <span><i class="far fa-clock"></i> 4:32</span> <span><i class="far fa-eye"></i> 174</span>
                                            </div>
                                        </div>
                                        <img src="{{ asset('website/images/fvid2.jpg') }}" alt="">
                                    </div>
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
                                </div>
                            </div>
                            <!--widget end-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End-->
        </div>
@endsection
