<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="{{asset('gentelella/production/images/favicon.ico')}}" type="image/ico" />
    <title> SOFTRES </title>

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
    <link rel="stylesheet" href="{{asset('gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!--  extension responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('gentelella/production/images/img.jpg')}}" alt="">{{Auth::user()->name}}
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out pull-right"></i> Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @if ($EmpresasComercio->count() > 0)
            <div class="login-box-body">
                <h4 class="login-box-msg">Seleccione la empresa con la que desee trabajar </h4>
                <div class="row">
                    <div class="col-sm-20">
                        <table id="listado_comercio" class="table table-bordered table-striped dataTable table-hover" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" style="width: 200pxpx;">N°</th>                                    
                                    <th class="sorting" style="width: 200px;">CÉDULA/RUC</th>
                                    <th class="sorting" style="width: 200px;">NOMBRE</th>
                                    <th class="sorting" style="width: 200px%;"><center>DÍAS RESTANTES</center></th>
                                    <th class="text-center" colspan="1" style="width: 200pxpx;">IR</th>
                                </tr>
                            </thead>
                            <tbody>       
                            </tbody>                    
                        </table>                            
                    </div>                                      
                </div>
            </div>
          @endif
          @if ($EmpresasComercio->count() < 0)
            <h4 class="login-box-msg">Usted No tiene empresas asociadas o esta inhabilitado</h4>
            <div class="col-lg-12">
                <div class="text-center">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        {{ csrf_field() }}
                        <a href="{{ route('logout') }}"class="btn btn-default btn-flat"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Salir
                        </a>
                    </form>
                </div>    
            </div>
          @endif
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
    <!-- DataTables -->
    <script src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- extension responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
            $(document).ready(function() {
                var table = $('#example').DataTable();
                
                $('#example tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    alert( 'You clicked on '+data[0]+'\'s row' );
                } );
            } );
        
        </script>
        
    
        <script>
            $(document).ready(function(){
                var table =  $('#listado_comercio').DataTable({
                    "language":{url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}, 
                    "responsive": true,
                    "paging": false,
                    "processing":true,                
                    "serverSide": true,
                    "searching": false,
                    "ajax":{
                        url:"{{ route('getPreview')}}",
                    },              
                    "columns":[
                        {data: 'id'},
                        {data: 'identificacion'},
                        {data: 'nombre'},
                        {data: 'restantes'},
                        {data: 'action', orderable:false},
                    ]
                });
    
                $('#listado_comercio tbody').on('click', 'tr', function (e) {
                e.preventDefault();
    
                    var data = table.row( this ).data();
                    envio(data);
                    // var empresaa = 'empresa'+data.id;
                    // document.getElementById(empresaa).submit();
                    // alert( 'Clic en la empresa'+data.empresa_id+'\'' );
                } );
            });
        </script>
    
        <script>
        // FUNCIÓN DE ENVIO INFO
        function envio(id){
    
            // loading();
            var empresa = 'empresa'+id.empresa_id;
            var formData = new FormData();
            var formData = new FormData(document.getElementById(empresa));
            formData.append("nit", id.empresa_id);
    
            // ENVIO AJAX
            var routeEnvio = "{{asset('preview')}}";
            var token = $("#token").val();
            $.ajax({
                url:routeEnvio,
                headers: {'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(res){
                // loading();
                if(res.respuesta == 1){
                    toastr["error"](res.mensaje, "¡Error!");
    
                }else if(res.respuesta == 2){
                
                    toastr["warning"]("Su licencia para la empresa ya se vencio <br> puede renovarla presionando en el botón <br /><a href='{{asset('pagos')}}' target='_blank' class='btn .btn-lg btn-primary'>Renovar</a>", "¡Alerta!");        
    
                }else{
                    var empresaa = 'empresa'+res.mensaje;
                    document.getElementById(empresaa).submit();  
    
                }
               
    
            }).fail(function(msg){
                // loading();
                $.each(msg.responseJSON.errors, function(key, value){
                    toastr["error"](value,"Error");                    
                });
            });
            
        }
        </script>
  </body>
</html>
