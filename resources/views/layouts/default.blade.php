<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <link rel="icon" href="{{ asset('assets/img/images.png') }}" type="image/ico">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <title>{{ config('app.name', 'Pinjam Ruang') }}</title>
    <style>
        li.line-garis {
            border-top: 1px solid #0af;
        }
    </style>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
</head>
<body>
<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand">
            <img src="{{ asset('assets/img/logo_pln.png') }}" width="100px">
        </div>
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
            </div>
            <form class="navbar-form navbar-left">
                <div class="input-group">
                </div>
            </form>
            <div id="navbar-menu">
           
                <ul class="nav navbar-nav navbar-right">
                
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span>{{ Auth::user()->name }} </span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            @if(\App\Http\Controllers\BaseController::is_pegawai(\Illuminate\Support\Facades\Auth::id()))
                                <li><a href="{{ route('user.show',\Illuminate\Support\Facades\Auth::id()) }}"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                @else
                                <li><a href="{{ route('mahasiswa.show',\Illuminate\Support\Facades\Auth::id()) }}"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                            @endif
                            <li><a href="{{ url('change-password') }}"><i class="lnr lnr-cog"></i> <span>Change Password</span></a></li>
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </nav>
    <!-- END NAVBAR -->

    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">     
        <div class="sidebar-scroll">  
                <ul class="nav">
                    <li><span>_</span></li>

                    <li style="text-align:center" class="nav header"><span>Peminjaman</span></li> 
                    <li><a href="{{ url('pinjam-ruangan')}}" class="{{ request()->is('pinjam-ruangan*') ? 'active' : '' }}"><i class="lnr lnr-enter"></i> <span>Ruangan</span></a></li>
                    <li><a href="{{ url('pinjam-aset')}}" class="{{ request()->is('pinjam-aset*') ? 'active' : '' }}"><i class="lnr lnr-layers"></i> <span>Aset</span></a></li>
                    <li><a href="#"><i class="lnr lnr-car"></i> <span>Kendaraan</span></a></li>
                    <li><a href="#"><i class="lnr lnr-camera-video"></i> <span>Akun Zoom</span></a></li>
                    
                    <li style="text-align:center" class="nav header"><span>Transaksi</span></li>
                    <li><a href="#" data-toggle="collapse" data-target="#submenu-1" class="{{ request()->is('transaksi-ruangan*') ? 'active' : '' }}"><i class="lnr lnr-enter"></i> <span>Ruangan</span></a>
                        <ul id="submenu-1" class="{{ request()->is('transaksi-ruangan*') ? 'nav' : 'nav collapse' }}">
                            <li><a href="{{ url('transaksi-ruangan/daftar-transaksi')}}" class="{{ Request::path() === 'transaksi-ruangan/daftar-transaksi' ? 'nav-link active' : '' }}"><i class="fa fa-angle-double-right"></i> History</a></li>
                            <li><a href="{{ url('transaksi-ruangan/laporan')}}" class="{{ Request::path() === 'transaksi-ruangan/laporan' ? 'nav-link active' : '' }}"><i class="fa fa-angle-double-right"></i> Laporan</a></li>
                            <li><a href="{{ route('transaksi-ruangan-app.index')}}" class="{{ request()->is('transaksi-ruangan-app*') ? 'nav-link active' : '' }}"><i class="fa fa-angle-double-right"></i> List Ruangan</a></li>
                        </ul>
                    </li>
                    <li><a href="#" data-toggle="collapse" data-target="#submenu-2" class="{{ request()->is('transaksi-aset*') ? 'active' : '' }}"><i class="lnr lnr-layers"></i> <span>Aset</span></a>
                        <ul id="submenu-2" class="{{ request()->is('transaksi-aset*') ? 'nav' : 'nav collapse' }}">
                            <li><a href="{{ url('transaksi-aset/daftar-transaksiaset')}}" class="{{ Request::path() === 'transaksi-aset/daftar-transaksiaset' ? 'nav-link active' : '' }}"><i class="fa fa-angle-double-right"></i> History</a></li>
                            <li><a href="{{ url('transaksi-aset/laporanaset')}}" class="{{ Request::path() === 'transaksi-aset/laporanaset' ? 'nav-link active' : '' }}"><i class="fa fa-angle-double-right"></i> Laporan</a></li>
                            <li><a href="{{ route('transaksi-aset-app.index')}}" class="{{ request()->is('transaksi-aset-app*') ? 'nav-link active' : '' }}"><i class="fa fa-angle-double-right"></i> List Aset</a></li>
                        </ul>
                    </li>
                    <li><a href="#" data-toggle="collapse" data-target="#submenu-3"><i class="lnr lnr-car"></i> <span>Kendaraan</span></a>
                        <ul id="submenu-3" class="nav collapse">
                            <li><a href="#" class="nav-link"><i class="fa fa-angle-double-right"></i> History</a></li>
                            <li><a href="#" class="nav-link"><i class="fa fa-angle-double-right"></i> Laporan</a></li>
                            <li><a href="#" class="nav-link"><i class="fa fa-angle-double-right"></i> List Kendaraan</a></li>
                        </ul>
                    </li>
                    <li><a href="#" data-toggle="collapse" data-target="#submenu-4"><i class="lnr lnr-camera-video"></i> <span>Akun Zoom</span></a>
                        <ul id="submenu-4" class="nav collapse">
                            <li><a href="#" class="nav-link"><i class="fa fa-angle-double-right"></i> History</a></li>
                            <li><a href="#" class="nav-link"><i class="fa fa-angle-double-right"></i> Laporan</a></li>
                            <li><a href="#" class="nav-link"><i class="fa fa-angle-double-right"></i> List Akun Zoom</a></li>
                        </ul>
                    </li>
                    
                    @if(\App\Http\Controllers\BaseController::is_pegawai(\Illuminate\Support\Facades\Auth::id()))
                    <li style="text-align:center" class="nav header"><span>User</span></li>
                    <li><a href="{{ route('user.index')  }}" ><i class="lnr lnr-users"></i> <span>Manajemen User</span></a></li>

                        <!-- <li><a href="{{ route('user.index')  }}" ><i class="lnr lnr-user"></i> <span>Admin</span></a></li>
                        <li><a href="{{ route('mahasiswa.index')  }}" ><i class="lnr lnr-users"></i> <span></span> Pegawai</a></li>
                        <li><a href="{{ route('manajer.index')  }}" ><i class="lnr lnr-user"></i> <span></span> Manajer</a></li> -->
                        @endif
                     @if(\App\Http\Controllers\BaseController::is_manajer(\Illuminate\Support\Facades\Auth::id()))
                        <li><a href="{{ route('ruangan.index')  }}" ><i class="lnr lnr-list"></i> <span>Ruangan</span></a></li>
                         <li><a href="{{ url('/laporan')  }}" ><i class="lnr lnr-list"></i> <span>Laporan</span></a></li>                        
                        @endif
                </ul>
        </div>
    </div>
    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    @yield('content')
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">
            <p class="copyright">&copy; {{ date('Y') }} <a href="#" target="_blank"></a>. PLN UIW Kaltimra.</p>
        </div>
    </footer>
</div>
<!-- END WRAPPER -->

<!-- END WRAPPER -->
<!-- Javascript -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script>
</body>
</html>