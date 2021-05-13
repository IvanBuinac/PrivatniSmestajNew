<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{asset("storage/images/logos/PrivatniSmestaj-mini.ico")}}?v=1.1">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- jQuery -->
    <script src="{!! asset("vendors/jquery/dist/jquery.min.js")!!}"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <!-- Bootstrap -->
    <link href="{!! asset("vendors/bootstrap/dist/css/bootstrap.min.css")!!}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{!! asset("vendors/font-awesome/css/font-awesome.min.css")!!}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{!! asset("vendors/nprogress/nprogress.css")!!}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{!! asset("vendors/iCheck/skins/flat/green.css")!!}" rel="stylesheet">

    <link href="{!! asset("css/flag-icon.min.css")!!}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{!! asset("vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css")!!}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{!! asset("vendors/jqvmap/dist/jqvmap.min.css")!!}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{!! asset("vendors/bootstrap-daterangepicker/daterangepicker.css")!!}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{!! asset("build/css/custom.min.css")!!}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{route("index")}}" class="site_title"><span>{{ Config::get('app.name') }}</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <?php use Illuminate\Foundation\Auth\User;
                        use Illuminate\Support\Facades\Auth;
                        $id = Auth::user()->id;
                        $user = User::find($id);
                        if($user->photo!=null){?>
                        <img src="{{ asset("storage/images/users/$user->name/$user->photo") }}" alt="{{$user->photo}}" class="img-circle profile_img">
                        <?php }else{?>
                         <img src="{{ asset("storage/images/NoProfilePicture.png") }}" alt="No profile picture" class="img-circle profile_img">
                        <?php }?>
                    </div>
                    <div class="profile_info">
                        <span>{{trans("site.welcome")}},</span>
                        <h2>{{Auth::user()->name}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                @include('backend.layouts.partials._sidebar')
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>

                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>

                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>
        <!-- top navigation -->
            @include('backend.layouts.partials._navigation')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>

<!-- Bootstrap -->
<script src="{!! asset("vendors/bootstrap/dist/js/bootstrap.min.js")!!}"></script>
<!-- FastClick -->
<script src="{!! asset("vendors/fastclick/lib/fastclick.js")!!}"></script>
<!-- NProgress -->
<script src="{!! asset("vendors/nprogress/nprogress.js")!!}"></script>
<!-- jQuery Smart Wizard -->
<script src="{!! asset("vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js")!!}"></script>
<!-- Chart.js -->
<script src="{!! asset("vendors/Chart.js/dist/Chart.min.js")!!}"></script>
<!-- gauge.js -->
<script src="{!! asset("vendors/gauge.js/dist/gauge.min.js")!!}"></script>
<!-- bootstrap-progressbar -->
<script src="{!! asset("vendors/bootstrap-progressbar/bootstrap-progressbar.min.js")!!}"></script>
<!-- iCheck -->
<script src="{!! asset("vendors/iCheck/icheck.min.js")!!}"></script>
<!-- Skycons -->
<script src="{!! asset("vendors/skycons/skycons.js")!!}"></script>
<!-- Flot -->
<script src="{!! asset("vendors/Flot/jquery.flot.js")!!}"></script>
<script src="{!! asset("vendors/Flot/jquery.flot.pie.js")!!}"></script>
<script src="{!! asset("vendors/Flot/jquery.flot.time.js")!!}"></script>
<script src="{!! asset("vendors/Flot/jquery.flot.stack.js")!!}"></script>
<script src="{!! asset("vendors/Flot/jquery.flot.resize.js")!!}"></script>
<!-- Flot plugins -->
<script src="{!! asset("vendors/flot.orderbars/js/jquery.flot.orderBars.js")!!}"></script>
<script src="{!! asset("vendors/flot-spline/js/jquery.flot.spline.min.js")!!}"></script>
<script src="{!! asset("vendors/flot.curvedlines/curvedLines.js")!!}"></script>
<!-- DateJS -->
<script src="{!! asset("vendors/DateJS/build/date.js")!!}"></script>
<!-- JQVMap -->
<script src="{!! asset("vendors/jqvmap/dist/jquery.vmap.js")!!}"></script>
<script src="{!! asset("vendors/jqvmap/dist/maps/jquery.vmap.world.js")!!}"></script>
<script src="{!! asset("vendors/jqvmap/examples/js/jquery.vmap.sampledata.js")!!}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{!! asset("vendors/moment/min/moment.min.js")!!}"></script>
<script src="{!! asset("vendors/bootstrap-daterangepicker/daterangepicker.js")!!}"></script>

<!-- Custom Theme Scripts -->
<script src="{!! asset("build/js/custom.min.js")!!}"></script>

<script src="{!! asset("js/custom.js")!!}"></script>

</body>
</html>
