<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | GPS QRCODE</title>

  <meta name="csrf-token" content="{{csrf_token()}}"/>

  <!-- favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('/assets/img/favicon.ico')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/dist/css/adminlte.min.css')}}">
  <!-- Select 2 -->
  <link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/css/select2.min.css')}}">
  <!-- csrf -->
  <meta name="csrf-token" content="{{csrf_token()}}"/>

  @yield('custom_link_css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="modal fade in" id="loader" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background-color: transparent; box-shadow: none; border: none;">
        <div class="modal-body" style="left: 25%">
          <img src="{{asset('/assets/img/gps-loader.gif')}}" style="width:50%; height:100%;">
        </div>
      </div>
    </div>
  </div>
<div class="wrapper" style>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4" style="background: linen;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-align: center">
      <img src="{{asset('assets/img/logogpstext.png')}}" alt="GPS Logo" class="brand-image" style="margin-left: -5px; margin-right: 0; max-height: 50px; margin-top: -0.5rem;">
      <span class="brand-text font-weight-light"><strong>QRCODE</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="height: ">
          <li class="nav-item">
            <a href="{{route('index')}}" class="nav-link">
              <p>
                <i class="nav-icon fa fa-laptop"></i>
                Dashboard
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('tenant.index')}}" class="nav-link">
              <p>
                <i class="nav-icon fas fa-image"></i>
                RS Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('inventory.index')}}" class="nav-link" style="color: #343a40;">
              <p>
                <i class="nav-icon fas fa-book-open"></i>
                IT Inventory
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <i class="nav-icon fas fa-clock"></i>
                Stock Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('stock.index')}}" class="nav-link" style="color: #343a40;">
                  <p>
                    <i class="nav-icon fas fa-clock"></i>
                    Permintaan Stock
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('stock.inputIndex')}}" class="nav-link" style="color: #343a40;">
                  <p>
                    <i class="nav-icon fas fa-clock"></i>
                    Penambahan Stock
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('stock.history')}}" class="nav-link" style="color: #343a40;">
                  <p>
                    <i class="nav-icon fas fa-clock"></i>
                    Stock History
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('qrcode.history')}}" class="nav-link" style="color: #343a40;">
                  <p>
                    <i class="nav-icon fas fa-clock"></i>
                    QRCode History
                  </p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{route('stock.history')}}" class="nav-link" style="color: #343a40;">
                  <p>
                    <i class="nav-icon fas fa-clock"></i>
                    Penambahan Stock
                  </p>
                </a>
              </li> --}}
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="wrapper" style="background: linen;">
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      &nbsp;
    </div>
    <!-- Default to the left -->
    <strong>PT Global promedika Service - All rights reserved - Copyright &copy; {{date('Y')}}</strong>
  </footer>
</div>

<!-- Modal Edit User -->


<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/assets/AdminLTE-3.2.0/dist/js/adminlte.min.js')}}"></script>
<!-- Select 2 -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js')}}"></script>

@yield('custom_script_js')
</body>
</html>
