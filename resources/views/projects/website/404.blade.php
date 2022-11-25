@extends('layouts.website-master')

@section('title')
    404 Page Not Found
@endsection

@section('content')
    <div class="main-content innerpagebg wf100 p80" style="padding-top:0;">
        <div class="error-page-404">
            <div class="container">
                <div class="p404-wrap">
                    <h1>404</h1>
                    <h2> <em>Ooops!</em> Page Not Found</h2>
                    <p>The Requested page can not be Found</p>
                    <a href="{{ route('/') }}" class="b2home"><i class="fas fa-home"></i> Go Back to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
