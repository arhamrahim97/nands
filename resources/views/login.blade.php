<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="shortcut icon" href="{{ asset('dist/favicon.ico') }}" type="image/x-icon" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="text-center mt-3">
                <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3 text-center" width="75px" style="opacity: .8">
            </div>
            <div class="card-header text-center">
                <a href="" class="h1" style="font-style: italic"><span class="text-primary">Fitrah</span>
                    <span class="text-danger">Swalayan</span></a>
            </div>
            <div class="card-body mt-2">
                <form action="{{ url('/cekLogin') }}" method="post" class="mb-2" id="formLogin" autocomplete="off">
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i>
                                Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        $('#formLogin').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            // var form = new FormData(this)
            var form = $(this).serializeArray();


            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: form,
                success: function(response) {
                    if (response.res == 'inputan_tidak_lengkap') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Inputan tidak lengkap!',
                            footer: '<a href="">Coba lagi</a>'
                        })
                    }
                    if (response.res == 'gagal') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Maaf, Terjadi Kesalahan',
                            text: 'Username atau Password salah!',
                        })
                    }
                    if (response.res == 'berhasil') {
                        window.location.href = "{{ url('/dashboard') }}";
                    }
                }
            });
        });
    </script>
</body>

</html>
