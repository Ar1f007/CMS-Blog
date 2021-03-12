<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
        <div class="container">

            <div class="navbar-left">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('img/logo.png') }}" width="85px" height="15px" alt="logo">
                </a>
            </div>
            <a class="btn btn-xs btn-round btn-success" href="{{ route('login') }}">Login</a>

        </div>
    </nav><!-- /.navbar -->


    <!-- Header -->
    @yield('header')
    <!-- /.header -->


    <!-- Main Content -->
    @yield('content')


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row gap-y align-items-center">

                <div class="col-6 col-lg-3">
                    <a href="/"><img src="{{ asset('img/logo.png') }}" width="85px" height="15px" alt="logo"></a>
                </div>

                <div class="col-6 col-lg-3 text-right order-lg-last">
                    <div class="social">
                        <a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
                        <a class="social-twitter" href="#"><i class="fa fa-twitter"></i></a>
                        <a class="social-instagram" href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="nav nav-bold nav-uppercase nav-trim justify-content-lg-center">
                        <p class="small-3">Copyright 2021 | Blogosphere</p>
                    </div>
                </div>

            </div>
        </div>
    </footer><!-- /.footer -->


    <!-- Scripts -->
    <script src=" {{ asset('js/page.min.js')}} "></script>
    <script src=" {{ asset('js/script.js')}}"></script>

</body>

</html>