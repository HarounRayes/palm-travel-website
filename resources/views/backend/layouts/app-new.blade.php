<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token-backend" content="{{ csrf_token() }}">

    <title>PalmOasis Control Panel</title>
    <!-- fontawesome font -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- themify font -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/themify-icons/themify-icons.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
          href="{{ asset('backend/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
          href="{{ asset('backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url('/')}}" class="nav-link">Home</a>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/')}}" class="brand-link">
            <img src="{{ asset('backend/img/logo.png') }}" alt="Palmoasis Logo" class="elevation-3"><br>
            <span class="brand-text font-weight-bold">Palm Oasis Holiday</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2" style="margin-bottom: 80px;">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p> Dashboard </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.enquiries.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-question"></i>
                            <p>Enquiry</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.newsletter.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Newsletter</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>
                                Palmoasis Packages
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.packages.info')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General Information</p>
                                </a>
                            </li>
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.create.ar','packages.create.en']))
                                <li class="nav-item">
                                    <a href="{{route('admin.packages.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Package</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['packages.edit.ar','packages.edit.en','countries.order','packages.order','packages.delete','packages.slider']))
                                <li class="nav-item">
                                    <a href="{{route('admin.packages.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List Of Packages</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['countries.edit.ar','countries.edit.en','countries.create.en','countries.create.ar','countries.delete','cities.edit.ar','cities.edit.en','cities.create.en','cities.create.ar','cities.delete']))
                                <li class="nav-item">
                                    <a href="{{route('admin.countries.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Counties</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['hotels.edit.ar','hotels.edit.en','hotels.create.en','hotels.create.ar','hotels.delete']))
                                <li class="nav-item">
                                    <a href="{{route('admin.hotels.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Hotels</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @if(Auth::guard('admin')->user()->hasAnyPermission(['sliders.edit.ar','sliders.edit.en','sliders.create.en','sliders.create.ar','sliders.delete']))
                        <li class="nav-item">
                            <a href="{{route('admin.sliders.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-image"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::guard('admin')->user()->hasAnyPermission(['blogs.edit.ar','blogs.edit.en','blogs.create.en','blogs.create.ar','blogs.delete','blogs.info','blogs.slider','blogs.comment']))
                        <li class="nav-item">
                            <a href="{{route('admin.blogs.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Blogs</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Homepage
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">3</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.home.info')}}" class="nav-link">
                                    <i class="fas fa-images nav-icon"></i>
                                    <p>Homepage Images</p>
                                </a>
                            </li>
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['services.edit.ar','services.edit.en','services.create.en','services.create.ar','services.delete']))
                                <li class="nav-item">
                                    <a href="{{route('admin.services.index')}}" class="nav-link">
                                        <i class="fas fa-server nav-icon"></i>
                                        <p>Services</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['partners.edit.ar','partners.edit.en','partners.create.en','partners.create.ar','partners.delete']))
                                <li class="nav-item">
                                    <a href="{{route('admin.partners.index')}}" class="nav-link">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>Partners</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @if(Auth::guard('admin')->user()->hasAnyPermission(['setting.edit.ar','setting.edit.en',]))
                        <li class="nav-item">
                            <a href="{{route('admin.settings.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Site Settings</p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::guard('admin')->user()->hasAnyPermission(['pages.edit.ar','pages.edit.en',]))
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Pages
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.edit', 1)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>About us</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.edit', 2)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contact us</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.edit', 3)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Privacy Policy</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.edit', 4)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Support</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.pages.edit', 5)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sitemap</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.edit', 6)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Term and Condition</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(Auth::guard('admin')->user()->hasRole('super-admin'))
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>
                                    User Setting
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.roles.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.users.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                UAE Visa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['visa.info']))
                                <li class="nav-item">
                                    <a href="{{route('admin.visa.uae.info')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>General Information</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uaeTypes.edit.ar','visa.uaeTypes.edit.en','visa.uaeTypes.create.en','visa.uaeTypes.create.ar','visa.uaeTypes.delete']))
                                <li class="nav-item">
                                    <a href="{{route('admin.uaeTypes.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Types</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uaeRequirements.edit.ar','visa.uaeRequirements.edit.en','visa.uaeRequirements.create.en','visa.uaeRequirements.create.ar','visa.uaeRequirements.delete']))
                                <li class="nav-item">
                                    <a href="{{route('admin.uaeRequirements.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Requirements</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.uae.nationalities.edit.ar','visa.uae.nationalities.edit.en','visa.uae.nationalities.create.en','visa.uae.nationalities.create.ar','visa.uae.nationalities.delete']))
                                <li class="nav-item">
                                    <a href="{{route('admin.uaeNationalities.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nationalities</p>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('admin.visa.uae.application.index')}}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Applications</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--                    <li class="nav-item has-treeview">--}}
                    {{--                        <a href="#" class="nav-link">--}}
                    {{--                            <i class="nav-icon fas fa-chart-pie"></i>--}}
                    {{--                            <p>--}}
                    {{--                                Visa--}}
                    {{--                                <i class="right fas fa-angle-left"></i>--}}
                    {{--                            </p>--}}
                    {{--                        </a>--}}
                    {{--                        <ul class="nav nav-treeview">--}}
                    {{--                            @if(Auth::guard('admin')->user()->hasRole('super-admin') || Auth::guard('admin')->user()->hasAllPermissions(['visa.info']))--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="{{route('admin.visa.info')}}" class="nav-link">--}}
                    {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                        <p>General Information</p>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            @endif--}}
                    {{--                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.nationalities.edit.ar','visa.nationalities.edit.en','visa.nationalities.create.en','visa.nationalities.create.ar','visa.nationalities.delete']))--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="{{route('admin.nationalities.index')}}" class="nav-link">--}}
                    {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                        <p>Nationalities</p>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            @endif--}}
                    {{--                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.types.edit.ar','visa.types.edit.en','visa.types.create.en','visa.types.create.ar','visa.types.delete']))--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="{{route('admin.types.index')}}" class="nav-link">--}}
                    {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                        <p>Types</p>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            @endif--}}
                    {{--                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.countries.edit.ar','visa.countries.edit.en','visa.countries.create.en','visa.countries.create.ar','visa.countries.delete']))--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="{{route('admin.visacountries.index')}}" class="nav-link">--}}
                    {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                        <p>Countries</p>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            @endif--}}
                    {{--                            @if(Auth::guard('admin')->user()->hasAnyPermission(['visa.outbounds.edit.ar','visa.outbounds.edit.en','visa.outbounds.create.en','visa.outbounds.create.ar','visa.outbounds.delete']))--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="{{route('admin.outbounds.index')}}" class="nav-link">--}}
                    {{--                                        <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                        <p>Outbounds</p>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            @endif--}}
                    {{--                            <li class="nav-item">--}}
                    {{--                                <a href="{{route('admin.visa.outbound.application.index')}}" class="nav-link">--}}
                    {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                    <p>Outbounds Applications</p>--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}
                    {{--                            <li class="nav-item has-treeview">--}}
                    {{--                                <a href="#" class="nav-link">--}}
                    {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                    <p>--}}
                    {{--                                        UAE--}}
                    {{--                                        <i class="right fas fa-angle-left"></i>--}}
                    {{--                                    </p>--}}
                    {{--                                </a>--}}
                    {{--                                <ul class="nav nav-treeview">--}}
                    {{--                                    <li class="nav-item">--}}
                    {{--                                        <a href="{{route('admin.uaes.config')}}" class="nav-link">--}}
                    {{--                                            <i class="far fa-dot-circle nav-icon"></i>--}}
                    {{--                                            <p>Requirements & Nationalities</p>--}}
                    {{--                                        </a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="nav-item">--}}
                    {{--                                        <a href="{{route('admin.uaes.index')}}" class="nav-link">--}}
                    {{--                                            <i class="far fa-dot-circle nav-icon"></i>--}}
                    {{--                                            <p>Visa</p>--}}
                    {{--                                        </a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="nav-item">--}}
                    {{--                                        <a href="{{route('admin.visa.uae.application.index')}}" class="nav-link">--}}
                    {{--                                            <i class="far fa-dot-circle nav-icon"></i>--}}
                    {{--                                            <p>UAE Applications</p>--}}
                    {{--                                        </a>--}}
                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Activity
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="padding-bottom: 100px">
                            <li class="nav-item">
                                <a href="{{route('admin.activity.info')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General Information</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.steps.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Steps</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.activitycategories.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.activitycountries.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Countries</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.activity.order.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Orders</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer"></footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
{{--<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>--}}
<!-- Sparkline -->
<script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>

<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>--}}


<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script
    src="{{ asset('backend/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<!-- bootstrap color picker -->
<script src="{{ asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<script src="{{ asset('backend/dist/js/scripts.js') }}"></script>
<script>
    $(function () {
        bsCustomFileInput.init();
        $('.textarea').summernote()
        // $("#example1").DataTable({
        //     "responsive": true,
        //     "autoWidth": false,
        // });
        // $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker

        $('.datepicker').each(function () {
            var id = $(this).attr('id');
            $('#' + id).bootstrapMaterialDatePicker({

                weekStart: 0,
                time: false,
                minDate: new Date(),
                clearButton: true,
                format: 'DD-MM-YYYY'
            });
        });

        $('.timepicker').each(function () {
            var id = $(this).attr('id');
            $('#' + id).bootstrapMaterialDatePicker({
                format: 'HH:mm',
                time: true,
                date: false,
                clearButton: true
            });
        });
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function (event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        // $( "button[data-card-widget]" ).on('click',function () {
        //     alert('gggg');
        // } );
    });
    $(document).on('click', "[data-card-widget-custom]", function () {
        $(this).parent().parent().parent().fadeOut("slow", function () {
            if (confirm('Delete this Bolck ?!')) {
                // After animation completed:
                $(this).remove();
            }
        });
    });
</script>
</body>
</html>

