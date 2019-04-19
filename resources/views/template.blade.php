<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b>Payrool</b>PRO</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/karyawan"><i class="fa fa-slideshare" aria-hidden="true"></i> Data Karyawan <span class="sr-only">(current)</span></a></li>

              <li><a href="/pengaturan"><i class="fa fa-cogs" aria-hidden="true"></i> Pengaturan</a></li>
              
              {{-- <li><a href="/kehadiran"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Kehadiran</a></li> --}}
            

              <li class="dropdown">
                  <a href="/kehadiran" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
     Modul Kehadiran & Lembur <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="/kehadiran"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Riwayat Kehadiran</a></li>
                      <li><a href="/lembur"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Riwayat Lembur</a></li>
                      <li><a href="/polakerja"><i class="fa fa-cogs" aria-hidden="true"></i> Pola Kerja Karyawan</a></li>
                      <li><a href="/kelompokkerja"><i class="fa fa-cogs" aria-hidden="true"></i> Kelompok Kerja Karyawan</a></li>
                    <li><a href="/kalenderkerja"><i class="fa fa-calendar" aria-hidden="true"></i>
                      Kalender Kerja</a></li>
                  </ul>
                </li>


            
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-area-chart" aria-hidden="true"></i>
 Modul Data Master <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/departemen"><i class="fa fa-ravelry" aria-hidden="true"></i> Departemen</a></li>
                <li><a href="/jabatan"><i class="fa fa-clone" aria-hidden="true"></i> Jabatan</a></li>
              </ul>
            </li>




            <li class="dropdown">
              <a href="/kehadiran" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
 Gaji Karyawan <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
              <li><a href="/gaji"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Laporan Gaji</a></li>
              <li><a href="/komponengaji"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Komponen Gaji</a></li>
              <li><a href="/kelompokgaji"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Kelompok Gaji</a></li>
              </ul>
            </li>



          </ul>
        
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
           

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Hai User : {{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                  <p>
                      {{ Auth::user()->name }}
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                   
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Top Navigation
          <small>Example 2.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">@yield('title')</h3>
          </div>
          <div class="box-body">
            @yield('content')
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
@stack('scipts')
</body>
</html>
