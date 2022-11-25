<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title') | Daily Sports Update</title>
    <meta name="csrf-token" content="{{ Session::token() }}">
    <link href="{{ asset('dashboard/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/libs/fontawesome/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/libs/summernote/summernote.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/libs/jquery-confirm/jquery-confirm.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('dashboard/js/jquery-3.6.1.min.js') }}"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">Live Sports</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('changePassword') }}">Change Password</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{ route('sports/index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-basketball"></i></div>
                        Sports
                    </a>
                    <a class="nav-link" href="{{ route('leagues/index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users-viewfinder"></i></div>
                        Leagues
                    </a>
                    <a class="nav-link" href="{{ route('clubs/index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-people-roof"></i></div>
                        Clubs
                    </a>
                    <a class="nav-link" href="{{ route('matches/index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Matches
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-square-rss"></i></div>
                        News
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('news/index') }}">
                                News
                            </a>
                            <a class="nav-link" href="{{ route('categories/index') }}">
                                Categories
                            </a>
                            <a class="nav-link" href="{{ route('comments/index') }}">
                                Comments
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
{{--            <div class="sb-sidenav-footer">--}}
{{--                <div class="small">Logged in as:</div>--}}
{{--                Start Bootstrap--}}
{{--            </div>--}}
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @yield('body')
        </main>
        <footer class="py-2 bg-white mt-auto">
            <div class="container-fluid px-4">
                <div class="align-items-center justify-content-between small text-center">
                    <div class="text-muted">Copyright &copy; Live Sports 2022</div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/jquery-confirm/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('dashboard/js/scripts.js') }}"></script>
<script src="{{ asset('dashboard/js/custom-script.js') }}"></script>
<script src="{{ asset('dashboard/libs/fontawesome/js/all.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/summernote/summernote.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150
        });
    });

    var activeurl = window.location;
    $('a[href="'+activeurl+'"]').addClass('active');

</script>
@yield('script')
</body>
</html>
