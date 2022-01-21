<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ProteXion</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Datatable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
  <!-- Select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /></head>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" /></head>

  <style>
      .fondo0{
        background-color: #ffffff;
        color: black
      }
      .fondo1{
        background-color: #DA0037;
        color: rgb(255, 255, 255)
      }
      .fondo2{
        background-color: #222D32;
        color: rgb(255, 255, 255)
      }
      .fondo3{
        background-color: #171717;
        color: rgb(255, 255, 255)
      }
      .header-bg{
        background-color: #222D32;
        color: rgb(255, 255, 255)
      }
      .tableHeader-bg{
        background-color: #222D32;
        color: rgb(255, 255, 255)
      }
      td{
          text-align: center;
          
      }
      th{
        text-align: center;
      }
  </style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" >
        <nav class="main-header navbar navbar-expand navbar-white navbar-light fondo2">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a style="color: white" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                   <!--
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">Contacto</a>
                </li>
                 -->
                <!--li class="nav-item d-none d-sm-inline-block">
                    <a style="color: white" href="/logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </a>
                </li-->
            </ul>




            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                     <!--
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">2</span>
                    </a>
                -->
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!--
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="{{ asset('dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Pepe Argento
                                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Puedes ayudarme con...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace 4 horas</p>
                                    </div>
                            </div>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="{{ asset('dist/img/user3-128x128.jpg')}}"  alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Moni Benitez
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Las personas consulta...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace 8 horas</p>
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
                        -->
                    </div>
                </li>

                <!--
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">13</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">13 Notificaciones</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 nuevos mensajes
                            <span class="float-right text-muted text-sm">3 minutos</span>
                        </a>
                        <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 nuevos pacientes
                                <span class="float-right text-muted text-sm">5 horas</span>
                            </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 1 nuevo reporte
                            <span class="float-right text-muted text-sm">2 dias</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
                    </div>
                </li>
                -->

                <!--li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li-->
                <li class="nav-item d-none d-sm-inline-block">
                    <a style="color: white" href="/logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </a>
                </li>


            </ul>

        </nav>


        <aside class="main-sidebar sidebar-dark-primary fondo2 elevation-4">

            <a href="/home" class="brand-link">
                <!--img src="{{ asset('imagenes/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"-->
                <span class="brand-text font-weight-light"><b>ProteXion</b></span>
            </a>


            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if(Auth::user()->foto == null)
                            <img src="{{ asset('imagenes/perfil/default.png')}}" class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('imagenes/perfil/'.Auth::user()->foto)}}" class="img-circle elevation-2" alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ route('perfil.index') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- GESTION -->
                        <li class="nav-header">GESTION</li>
                        <li class="nav-item">
                            <a href="{{ route('personal.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-user-md"></i>
                                <p>Personal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('paciente.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>Pacientes</p>
                            </a>
                        </li>  
                        <li class="nav-item">
                            <a href="{{ route('voucher.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-stethoscope"></i>
                                <p>Estudios</p>
                            </a>
                        </li>
                        <!--
                            <li class="nav-header">GESTIÓN DE ACCESO</li>
                                
                            <li class="nav-header">GESTIÓN PACIENTES</li>



                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-envelope"></i>
                                    <p>Correos<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bandeja de entrada</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/mailbox/compose.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Escribir correo</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Leer correos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        -->
                        <!-- FORMULARIOS -->
                        <!--<li class="nav-header">FORMULARIOS</li>

                         
                        <li class="nav-item">
                            <a href="{{ route('audiometrias.index') }}" class="nav-link">
                                <i class="fas fa-stethoscope"></i>
                                <p>Audiometría</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('espiriometrias.index') }}" class="nav-link">
                                <i class="fas fa-stethoscope"></i>
                                <p>Espiriometría</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('iluminacion_direccionados.index') }}" class="nav-link">
                                <i class="fas fa-stethoscope"></i>
                                <p>Direccionado</p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ route('declaracion_jurada.index') }}" class="nav-link">
                                <i class="fas fa-stethoscope"></i>
                                <p>Declaracion Jurada</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('historia_clinica.index') }}" class="nav-link">
                                <i class="fas fa-stethoscope"></i>
                                <p>Historia Clínica</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posiciones_forzadas.index') }}" class="nav-link">
                                <i class="fas fa-stethoscope"></i>
                                <p>Posiciones Forzadas</p>
                            </a>
                        </li>-->

                        <li class="nav-header">SISTEMA</li>
                        <!--
                        
                        <li class="nav-item">
                            <a href="{{ route('audits.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-eye"></i>
                                <p>Auditoria</p>
                            </a>
                        </li>-->
                        
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Cuenta de Usuario</p>
                            </a>
                        </li>   
                        <!--
                        <li class="nav-item">
                            <a href="{{ route('estudios.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p>Estudios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tipo_estudios.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p>Tipos de estudios</p>
                            </a>
                        </li>-->
                        
                        <!--
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-cogs"></i>
                                    <p>Configuracion <span class="badge badge-info right"></span></p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Estadística</p>
                                </a>
                            </li>


                            <li class="nav-header">AYUDA Y SOPORTE</li>
                            <li class="nav-item">
                                <a href="https://adminlte.io/docs/3.0" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>Documentación</p>
                                </a>
                            </li>
                        -->
                        <!--li class="nav-header">EJEMPLO MULTINIVEL</li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>Nivel 1<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Nivel 1</p>
                                        </a>
                                    </li>

                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Nivel 2<i class="right fas fa-angle-left"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Nivel 1</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Nivel 2</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Nivel 3</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li
                        -->
                    </ul>
                </nav>
            </div>
        </aside>


        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @yield('titulo')
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('navegacion')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- en esta sección va el contenido -->
            <section class="content">
                <div class="container-fluid">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                             <!-- el card en cuestión dentro de cada yield estara el body y footer del card -->
                                @yield('content')

                        </div>

                </div>
            </section>
        </div>


    <footer class="main-footer">
        <strong>Copyright &copy; 2020
            <a href="http://adminlte.io">MiS Misiones Software</a>.
        </strong>
            Todos los derechos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>



    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js')}}"></script>
    <!-- Datatable & jQuery-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
    <!-- Select2-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

    <!-- mascaras -->
    <script src="js/jquery.mask.min.js"></script>

    @stack('scripts')
    @yield("scripts")
</body>
</html>
