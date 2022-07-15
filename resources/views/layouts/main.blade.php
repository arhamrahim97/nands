<!DOCTYPE html>
<html style="height: auto;" class="" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="shortcut icon" href="{{ asset('dist/favicon.ico') }}" type="image/x-icon" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <style type="text/css">
        /* Chart.js */
        .main-sidebar {
            width: 220px !important;
        }

        .sidebar-mini .main-sidebar .nav-link,
        .sidebar-mini-md .main-sidebar .nav-link,
        .sidebar-mini-xs .main-sidebar .nav-link {
            width: calc(220px - .5rem * 2) !important;
            transition: width ease-in-out .3s;
        }

        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper,
        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer,
        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
            transition: margin-left .3s ease-in-out;
            margin-left: 220px !important;
        }

        @keyframes chartjs-render-animation {
            from {
                opacity: .99
            }

            to {
                opacity: 1
            }
        }

        .chartjs-render-monitor {
            animation: chartjs-render-animation 1ms
        }

        .chartjs-size-monitor,
        .chartjs-size-monitor-expand,
        .chartjs-size-monitor-shrink {
            position: absolute;
            direction: ltr;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
            visibility: hidden;
            z-index: -1
        }

        .chartjs-size-monitor-expand>div {
            position: absolute;
            width: 1000000px;
            height: 1000000px;
            left: 0;
            top: 0
        }

        .chartjs-size-monitor-shrink>div {
            position: absolute;
            width: 200%;
            height: 200%;
            left: 0;
            top: 0
        }

        .sidebar-dark-lightblue .nav-sidebar>.nav-item>.nav-link.active,
        .sidebar-light-lightblue .nav-sidebar>.nav-item>.nav-link.active {
            background-color: #28a745;
            color: #fff;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #3c8dbc;
        }

        .nav-pills .nav-link:not(.active):hover {
            color: #3c8dbc;
        }

        a {
            color: #3c8dbc;
            text-decoration: none;
            background-color: transparent;
        }

        .buttons-html5 {
            background-color: #28a745;
            border-color: #28a745;
        }

        .buttons-html5:hover {
            background-color: #1d8334;
            border-color: #1d8334;
        }

        .buttons-print {
            background-color: #28a745;
            border-color: #28a745;
        }

        .buttons-print:hover {
            background-color: #1d8334;
            border-color: #1d8334;
        }



        .dataTables_filter {
            display: inline !important;
            float: right;
        }

        .dt-buttons {
            display: inline !important;
        }


        .dataTables_length {
            display: inline !important;

        }


        /* .paginate_button {
            font-size: 12px !important;
        } */

        /* .dataTables_paginate {
            margin-top: 10px !important;
        } */

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100000;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @yield('css')
</head>

{{-- <body class="sidebar-mini layout-fixed sidebar-collapse" style="height: auto;"> --}}

<body class="sidebar-mini layout-fixed" style="height: auto;">
    <div class="wrapper">
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="height: 0px;">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" style="display: none;"
                width="60" height="60">
        </div>


        @include('partials.navbar')
        @include('partials.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 385.2px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid px-3">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title }}</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="container-fluid px-3">
                    @yield('content')
                    <!-- Modal -->
                    <div class="modal fade" id="akunModal" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Akun</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formAkun" method="post" autocomplete="off">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-12 px-2">
                                            <div class="form-group">
                                                <label for="TextInput" class="form-label">Nama :</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    value="{{ Auth::user()->name }}" placeholder="Masukkan Nama"
                                                    required>
                                                <span class="text-danger error-text username-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <div class="form-group">
                                                <label for="TextInput" class="form-label">Username :</label>
                                                <input type="text" id="username" name="username"
                                                    class="form-control" value="{{ Auth::user()->username }}"
                                                    placeholder="Masukkan Username" required>
                                                <span class="text-danger error-text username-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <div class="form-group">
                                                <label for="TextInput" class="form-label">Password :</label>
                                                <input type="text" id="password" name="password"
                                                    class="form-control" value=""
                                                    placeholder="Masukkan Password">
                                                <span class="text-muted error-text password-error"
                                                    style="font-style: italic">Kosongkan apabila
                                                    tidak ingin merubah password sebelumnya</span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn btn-primary float-right"><i
                                                class="fas fa-spinner"></i>
                                            Proses</button>
                                    </form>
                                </div>
                                <div class="modal-footer float-right">
                                    <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- jQuery Mask -->
    <script src="{{ asset('plugins/jquery.mask/jquery.mask.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('plugins/chartJS/chart.js') }}"></script>
    <script src="{{ asset('plugins/chartJS/chartjs-plugin-datalabels.min.js') }}"
        integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>


    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    {{-- <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $('.tanggal').mask('00/00/0000');
        $('.number').mask('00');

        $('#formAkun').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = $(this).serializeArray();
            $.ajax({
                type: 'POST',
                url: '{{ url('/akun') }}' + '/' + '{{ Auth::user()->id }}',
                data: formData,
                success: function(data) {
                    if (data.success == true) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            }
                        })
                    }
                },
                error: function(data) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Data gagal disimpan',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>

    @stack('script')

</body>

</html>
