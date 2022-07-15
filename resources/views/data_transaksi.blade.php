@extends('layouts.main')


@section('content')
    <section>
        <div class="row">
            <div class="col">
                <div class="card card-lightblue card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Impor Data Transaksi Penjualan</h3>
                    </div>
                    <form class="form-horizontal" id="form" autocomplete="off">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label pt-0">Upload File:</label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file_import" id="customFile"
                                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                            required>
                                        <label class="custom-file-label" for="customFile">Cari File</label>
                                        <span class="text-danger error-text file_import-error"></span>
                                    </div>
                                </div>
                                {{-- checkbox --}}
                                <div class="col-sm-12 mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-import"
                                            name="checkbox_import" value="1" checked>
                                        <label class="custom-control-label" for="checkbox-import">
                                            <span class="text-muted font-weight-normal" style="font-style: italic">
                                                Bersihkan data transaksi yang sudah ada sebelumnya
                                            </span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn btn-primary float-right"><i class="fas fa-spinner"></i>
                                Proses</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div data-aos="fade-up" data-aos-duration="700" class="row mb-3 aos-init aos-animate">
            <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1 text-white"><i
                            class="fas fa-shopping-cart"></i></span></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h6 style="font-weight: bold">Total Transaksi :</h6>
                        </span>
                        <span class="info-box-number mt-0">
                            <h4 style="display: inline">
                                {{ $totalTransaksi ?? 0 }}
                            </h4>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1 text-white"><i class="fas fa-boxes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h6 style="font-weight: bold">Total Jenis Barang :</h6>
                        </span>
                        <span class="info-box-number mt-0">
                            <h4 style="display: inline">
                                {{ $totalJenisBarang }}
                            </h4>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1 text-white"><i
                            class="fas fa-sort-amount-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h6 style="font-weight: bold">Barang Terlaris :</h6>
                        </span>
                        <span class="info-box-number mt-0">
                            <h5 style="display: inline">
                                {{ $jumlahJenisBarangTertinggi->nama_barang }}
                                <b>({{ $jumlahJenisBarangTertinggi->jumlah }})</b>
                            </h5>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1 text-white"><i
                            class="fas fa-sort-amount-down text-white"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <h6 style="font-weight: bold">Barang Jarang Dibeli :</h6>
                        </span>
                        <span class="info-box-number mt-0">
                            <h5 style="display: inline">
                                {{ $jumlahJenisBarangTerendah->nama_barang }}
                                <b>({{ $jumlahJenisBarangTerendah->jumlah }})</b>
                            </h5>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-3">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <div class="card card-lightblue card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Data Transaksi</h5>
                    </div>
                    <div class="card-body pt-3">
                        <table id="tb_transaksi" class="table table-sm table-bordered table-hover dataTable dtr-inline"
                            role="grid" aria-describedby="tb_transaksi_info">
                            <thead>
                                <tr role="row" class="text-center">
                                    <th width="45px">
                                        No.
                                    </th>
                                    <th width="160px">
                                        ID Transaksi
                                    </th>
                                    <th width="90px">
                                        Tanggal
                                    </th>
                                    <th>
                                        Nama barang
                                    </th>
                                </tr>
                            </thead>

                        </table>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="card card-lightblue card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Data Barang</h5>
                    </div>
                    <div class="card-body pt-3">
                        <table id="tb_barang" class="table table-sm table-bordered table-hover dataTable dtr-inline"
                            role="grid" aria-describedby="tb_barang_info">
                            <thead>
                                <tr role="row" class="text-center">
                                    <th width="45px">
                                        No.
                                    </th>
                                    <th>
                                        Nama Barang
                                    </th>
                                    <th width="70px">
                                        Jumlah
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $('#checkbox-import').change(function() {
            if ($(this).is(':checked')) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Data yang akan diimport akan menghapus seluruh data yang sudah ada sebelumnya!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                })
            } else {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Data akan terduplikasi apabila data yang akan diimport sudah ada sebelumnya!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                })
            }
        });

        $(function() {
            $('#tb_transaksi').DataTable({
                "responsive": true,
                "processing": true,
                "ajax": "{{ url('/tabel-data-transaksi') }}",
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'id_transaksi',
                        name: 'id_transaksi'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                ],
                'dom': 'lBfrtip',
                "buttons": [{
                    extend: 'excel',
                    className: 'btn btn-sm btn-light-success px-2 btn-export-table d-inline ml-3 font-weight',
                    text: '<i class="far fa-file-excel mr-1"></i> Ekspor Data',
                    exportOptions: {
                        modifier: {
                            order: 'index', // 'current', 'applied', 'index',  'original'
                            page: 'all', // 'all',     'current'
                            search: 'applied' // 'none',    'applied', 'removed'
                        },
                        columns: ':visible'
                    }
                }, ],
            }).buttons().container().appendTo('#tb_transaksi_wrapper .col-md-6:eq(0)');

            $('#tb_barang').DataTable({
                "responsive": true,
                "processing": true,
                "ajax": "{{ url('/tabel-data-barang') }}",
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                ],
                'dom': 'lBfrtip',
                "buttons": [{
                        extend: 'excel',
                        className: 'btn btn-sm btn-light-success px-2 btn-export-table d-inline ml-3 font-weight',
                        text: '<i class="far fa-file-excel mr-1"></i> Ekspor Data',
                        exportOptions: {
                            modifier: {
                                order: 'index', // 'current', 'applied', 'index',  'original'
                                page: 'all', // 'all',     'current'
                                search: 'applied' // 'none',    'applied', 'removed'
                            },
                            columns: ':visible'
                        }
                    },

                ],
            }).buttons().container().appendTo('#tb_barang_wrapper .col-md-6:eq(0)');
        });

        $('#form').submit(function(e) {
            $("#overlay").fadeIn(100);
            e.preventDefault();
            $('.error-text').text('');
            var formData = new FormData(this)
            $.ajax({
                type: "POST",
                url: "{{ route('data-transaksi.store') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#overlay").fadeOut(100);
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Proses Impor Data Berhasil',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        })
                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil diimpor!",
                            icon: "success",
                            button: false
                        })
                        setTimeout(
                            function() {
                                window.location.href = "";
                            }, 2000);
                    } else {
                        Swal.fire(
                            'Terjadi Kesalahan!',
                            'Silahkan cek kembali inputan anda.',
                            'error'
                        )
                        printErrorMsg(data.error);
                    }
                }
            })
        })

        const printErrorMsg = (msg) => {
            $.each(msg, function(key, value) {
                $('.' + key + '-error').text(value);
            });
        }
    </script>
@endpush
