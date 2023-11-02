<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="{{asset('gentelella/production/images/favicon.ico')}}" type="image/ico" />

    <title>@yield('titulo') | SOFTRES </title>

    <!-- Bootstrap -->
    <link href="{{asset('gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}"  rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('gentelella/vendors/font-awesome/css/font-awesome.min.css')}}"  rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('gentelella/vendors/nprogress/nprogress.css')}}"  rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('gentelella/vendors/iCheck/skins/flat/green.css')}}"  rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{asset('gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"  rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('gentelella/vendors/jqvmap/dist/jqvmap.min.css')}}"  rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css')}}"  rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('gentelella/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('toastr/toastr.min.css')}}" rel="stylesheet"/>
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('gentelella/vendors/select2/dist/css/select2.min.css')}}">
    @yield('headers')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        {{-- Panel Izquierdo --}}
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{asset('dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>SOFTRES</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('gentelella/production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ route('empresas') }}"><i class="fa fa fa-desktop"></i> Empresas </a></li>
                  <li class=""><a><i class="fa fa-cogs -fa"></i> Administración General <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="current-page"><a href="{{ route('GetServidorMail') }}">Tipos servidor de correo</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Salir" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        {{-- Fin Panel Izquierdo --}}

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('gentelella/production/images/img.jpg')}}" alt="">{{Auth::user()->name}}
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Profile</a>
                    <a class="dropdown-item"  href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                    <a class="dropdown-item"  href="javascript:;">Help</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out pull-right"></i> Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="{{asset('gentelella/production/images/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="{{asset('gentelella/production/images/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="{{asset('gentelella/production/images/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="{{asset('gentelella/production/images/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- Encabezado de contenido -->
          @section('ubicacion')
            <div class="shiftnav-content-wrap">
              <section class="content-header">
                <ol class="breadcrumb">
                  <li><a href="{{ url('panel') }}"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a></li>
                </ol>
              </section>
            </div>
          @show
          <!-- Fin Encabezado de contenido -->
          @section('content')
            <!-- top tiles -->
            <div class="row" style="display: inline-block;" >
              <div class="tile_count">
                <div class="col-md-12 col-sm-4  tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Total Empresas</span>
                  <div class="count">{{$empresas}}</div>
                  <span class="count_bottom"><i class="green">4% </i> From last Week</span>
                </div>
              </div>
            </div>
            <!-- /top tiles -->

            {{-- <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="dashboard_graph">

                  <div class="row x_title">
                    <div class="col-md-6">
                      <h3>Network Activities <small>Graph title sub-title</small></h3>
                    </div>
                    <div class="col-md-6">
                      <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-9 col-sm-9 ">
                    <div id="chart_plot_01" class="demo-placeholder"></div>
                  </div>
                  <div class="col-md-3 col-sm-3  bg-white">
                    <div class="x_title">
                      <h2>Top Campaign Performance</h2>
                      <div class="clearfix"></div>
                    </div>

                    <div class="col-md-12 col-sm-12 ">
                      <div>
                        <p>Facebook Campaign</p>
                        <div class="">
                          <div class="progress progress_sm" style="width: 76%;">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                          </div>
                        </div>
                      </div>
                      <div>
                        <p>Twitter Campaign</p>
                        <div class="">
                          <div class="progress progress_sm" style="width: 76%;">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                      <div>
                        <p>Conventional Media</p>
                        <div class="">
                          <div class="progress progress_sm" style="width: 76%;">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                          </div>
                        </div>
                      </div>
                      <div>
                        <p>Bill boards</p>
                        <div class="">
                          <div class="progress progress_sm" style="width: 76%;">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="clearfix"></div>
                </div>
              </div>

            </div> --}}      
          @show
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer class="main-footer">
          {{-- <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div> --}}
          {{-- <div class="clearfix"></div> --}}
          <div class="pull-right hidden-xs">
            <b>Version</b> 3.0
          </div>
          <strong>Copyright &copy; 2011-{{ date('Y') }} <a href="https://www.abingenieros.com" target="_blank">AB Ingenieros</a>.</strong> Todos los derechos reservados.
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('gentelella/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('gentelella/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('gentelella/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('gentelella/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('gentelella/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('gentelella/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('gentelella/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('gentelella/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('gentelella/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('gentelella/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('gentelella/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('gentelella/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('gentelella/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('gentelella/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('gentelella/build/js/custom.min.js')}}"></script>
    <script src="{{asset('toastr/toastr.min.js')}}"></script>
    {{-- Select2 --}}
    <script src="{{ asset('gentelella/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    @section('imports')
    @show


  </body>
</html>
