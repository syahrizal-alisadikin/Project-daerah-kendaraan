<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash; SILACAK</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/silacak.jpeg') }}" type="image/x-icon">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap4.css') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

</head>

<body style="background: #e2e8f0">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">SILACAK</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">SILACAK</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">MAIN MENU</li>
                        <li class="{{ setActive('admin/dashboard') }}">
                            <a class="nav-link"
                                href="{{ route('admin.dashboard.index') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
       
                        <li
                            class="dropdown {{ setActive('admin/tanah'). setActive('admin/kendaraan') }}">
                                <a href="#" class="nav-link has-dropdown"> <i class="fas fa-book"></i><span>
                                Pendataan Asset</span></a>
                            
                            <ul class="dropdown-menu">
                                    <li class="{{ setActive('admin/tanah') }}"><a class="nav-link"
                                        href="{{ route('admin.tanah.index') }}">Tanah</a>
                                </li>
                                    <li class="{{ setActive('admin/kendaraan') }}"><a class="nav-link"
                                        href="{{ route('admin.kendaraan.index') }}">Kendaraan</a>
                                </li>

                              
                            </ul>
                        </li>

                         <li
                            class="dropdown {{ setActive('admin/pinjam-tanah'). setActive('admin/pinjam-kendaraan') }}">
                                <a href="#" class="nav-link has-dropdown"> <i class="fas fa-folder"></i><span>Pinjam Pakai</span></a>
                            
                            <ul class="dropdown-menu">
                                    <li class="{{ setActive('admin/pinjam-tanah') }}"><a class="nav-link"
                                        href="{{ route('admin.pinjam-tanah.index') }}">Tanah</a>
                                </li>
                                    <li class="{{ setActive('admin/pinjam-kendaraan') }}"><a class="nav-link"
                                        href="{{ route('admin.pinjam-kendaraan.index') }}">Kendaraan</a>
                                </li>

                              
                            </ul>
                        </li>
                        
                        {{-- @can('mutasi_aset') --}}

                         {{-- <li class="{{ setActive('admin/mutasi-asset') }}">
                            <a class="nav-link"
                                href="{{ route('admin.dashboard.index') }}">
                                <i class="fas fa-book-open"></i>
                                <span>Mutasi Asset</span>
                            </a>
                        </li> --}}
                        <li
                            class="dropdown {{ setActive('admin/mutasi-tanah'). setActive('admin/mutasi-kendaraan') }}">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-book-open"></i>
                                <span>Mutasi Asset</span></a>
                            
                            <ul class="dropdown-menu">
                                    <li class="{{ setActive('admin/mutasi-tanah') }}"><a class="nav-link"
                                        href="{{ route('admin.mutasi-tanah.index') }}">Tanah</a>
                                </li>
                                    <li class="{{ setActive('admin/mutasi-kendaraan') }}"><a class="nav-link"
                                        href="{{ route('admin.pinjam-kendaraan.index') }}">Kendaraan</a>
                                </li>

                              
                            </ul>
                        </li>
                        
                        {{-- @endcan --}}
                        
                        {{-- @can('gallery_aset')

                         <li class="{{ setActive('admin/gallery-asset') }}">
                            <a class="nav-link"
                                href="{{ route('admin.dashboard.index') }}">
                                <i class="fas fa-image"></i>
                                <span>Gallery Asset</span>
                            </a>
                        </li>
                        @endcan --}}


                        <li class="{{ setActive('admin/setting-akun') }}">
                            <a class="nav-link"
                                href="{{ route('setting-akun') }}">
                               <i class="fas fa-user-cog"></i>
                                <span>Setting Akun</span>
                            </a>
                        </li>
                       
                       



                        
                    
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('pimpinan'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Users
                                Management</span></a>
                            @endif
                            
                            <ul class="dropdown-menu">
                                @can('roles')
                                    <li class="{{ setActive('admin/role') }}"><a class="nav-link"
                                        href="{{ route('admin.role.index') }}"><i class="fas fa-unlock"></i> Roles</a>
                                </li>
                                @endcan

                                @can('permissions')
                                    <li class="{{ setActive('admin/permission') }}"><a class="nav-link"
                                    href="{{ route('admin.permission.index') }}"><i class="fas fa-key"></i>
                                    Permissions</a></li>
                                @endcan

                                @can('admin')
                                    <li class="{{ setActive('admin/user') }}"><a class="nav-link"
                                        href="{{ route('admin.user.index') }}"><i class="fas fa-users"></i> Users</a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @if(auth()->user()->can('pimpinan'))
                             <li class="dropdown {{ setActive('admin/bidang'). setActive('admin/units'). setActive('admin/subunit') . setActive('admin/upb')}}">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Bidang</span></a>
                            
                            
                            <ul class="dropdown-menu">
                                    <li class="{{ setActive('admin/bidang') }}"><a class="nav-link"
                                        href="{{ route('admin.bidang.index') }}"><i class="fas fa-unlock"></i> Bidang</a>
                                </li>

                                    <li class="{{ setActive('admin/units') }}"><a class="nav-link"
                                    href="{{ route('admin.units.index') }}"><i class="fas fa-key"></i>
                                    Unit</a></li>

                                    <li class="{{ setActive('admin/subunit') }}"><a class="nav-link"
                                        href="{{ route('admin.subunit.index') }}"><i class="fas fa-users"></i> Sub Unit</a>
                                </li>
                                <li class="{{ setActive('admin/upb') }}"><a class="nav-link"
                                        href="{{ route('admin.upb.index') }}"><i class="fas fa-users"></i> UPB</a>
                                </li>
                            </ul>
                            </li>
                        @endif
                            @if(auth()->user()->can('pimpinan'))

                        <li class="{{ setActive('admin/history') }}">
                            <a class="nav-link"
                                href="{{ route('admin.history.index') }}">
                               <i class="fas fa-chart-line"></i>
                                <span>Log Activity</span>
                            </a>
                        </li>
                            @endif

                            

                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            @yield('content')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> SILACAK <div class="bullet"></div> All Rights
                    Reserved.
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
  @stack('prepend-script')
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        //active select2
        // $(document).ready(function () {
        //     $('select').select2({
        //         theme: 'bootstrap4',
        //         width: 'style',
        //     });
        // });

        //flash message
        @if(session()->has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 5000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 5000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
    </script>
  @stack('addon-script')
</body>
</html>