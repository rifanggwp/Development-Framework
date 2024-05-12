<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Yola Digital - Pekerja</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('img/logoyolakotak.png') }}">

 <!-- General CSS Files -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/excel/xlsx.bundle.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/excel/xlsx.extendscript.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/excel/xlsx.download.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/excel/main.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/pdf/main.js') }}"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @guest
            @else
            <img alt="Foto Profil" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-2">
            <div class="d-sm-none d-lg-inline-block">Halo, {{ Auth::user()->nama_pekerja }}</div></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Anda masuk sebagai<br>Pekerja</div>
                  <a href="{{ route('pekerja.profil.index') }}" class="dropdown-item has-icon {{ (Request::route()->getName() == 'pekerja.profil.index') ? 'active' : '' }}">
                    <i class="far fa-user"></i> Profil
                  </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                onClick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </div>
            @endguest
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <img style="width: 45%;" src="{{ asset('img/logoyolalandscape.png') }}">
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <img style="width: 75%;" src="{{ asset('img/logoyolakotak.png') }}">
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                    <li class="{{ (Request::route()->getName() == 'pekerja.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pekerja.index') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li class="menu-header">Menu</li>
                  <li class="{{ (Request::route()->getName() == 'pekerja.data.proyek') ? 'active' : '' }} {{ (Request::route()->getName() == 'pekerja.data.detail.proyek') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pekerja.data.proyek') }}"><i class="fa fa-book"></i> <span>Data proyek</span></a></li>       
                  <li class="{{ (Request::route()->getName() == 'pekerja.data.proyekupdate') ? 'active' : '' }} {{ (Request::route()->getName() == 'pekerja.data.detail.proyekupdate') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pekerja.data.proyekupdate') }}"><i class="fa fa-chart-line"></i> <span>Data Update Proyek</span></a></li>       
                <li class="menu-header">Keuangan</li>        
                  <li class="{{ (Request::route()->getName() == 'pekerja.data.gaji') ? 'active' : '' }} {{ (Request::route()->getName() == 'pekerja.data.detail.gaji') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pekerja.data.gaji') }}"><i class="fa fa-list"></i> <span>Data gaji</span></a></li>       
            </ul>
        </aside>
      </div>

      @include('sweetalert::alert')
      @yield('content')

      <footer class="main-footer">
        <div class="footer-left">
        
        </div>
        <div class="footer-right">
            Universitas Amikom Yogyakarta
        </div>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdn.tiny.cloud/1/jtna6wqgssh88n40erhsyp70l38h8mjytpqqs0z79fj0t6y9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>  
  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
  <script src="{{ asset('js/stisla.js') }}"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="{{ asset('js/addons/admin/dropdownid.js') }}"></script>
  <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
  @yield('scripts')
</body>
</html>
