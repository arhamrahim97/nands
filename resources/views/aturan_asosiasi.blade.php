@extends('layouts.main')

@section('content')
    <section>
        <div class="row">
            <div class="col">
                <div class="card card-lightblue card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Input Minimum Support Count dan Minimum Confidence</h3>
                    </div>
                    <form method="POST" action="{{ url('proses-aturan-asosiasi') }}" class="form-horizontal" id="formSubmit"
                        autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="form-label pt-0">Dari Tanggal :</label>
                                    <div class="custom-file">
                                        <input type="text" class="form-control tanggal" name="dari_tanggal"
                                            value="{{ $dariTanggal ? $dariTanggal : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="form-label pt-0">Sampai Tanggal :</label>
                                    <div class="custom-file">
                                        <input type="text" class="form-control tanggal" name="sampai_tanggal"
                                            value="{{ $sampaiTanggal ? $sampaiTanggal : '' }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="form-label pt-0">Minimum Support Count :</label>
                                    <span class="float-right" id="info-min-support" style="cursor: pointer"><i
                                            class="fas fa-question-circle text-info"></i></span>
                                    <div class="custom-file">
                                        <input type="text" class="form-control" name="minimum_support"
                                            placeholder="Input Nilai Minimum Support Count" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="form-label pt-0">Minimum Confidence (%) : </label>
                                    <span class="float-right" id="info-min-confidence" style="cursor: pointer"><i
                                            class="fas fa-question-circle text-info"></i></span>
                                    <div class="custom-file">
                                        <input type="text" class="form-control number" name="minimum_confidence"
                                            placeholder="Input Nilai Minimum Confidence" required>
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

    <section class="mt-3">
        <div class="row">
            <div class="col">
                <div class="card card-lightblue card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Hasil Aturan Asosiasi</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-info elevation-1 text-white"><i
                                            class="fas fa-calendar-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <h6 style="font-weight: bold">Dari dan Sampai Tanggal:</h6>
                                        </span>
                                        <span class="info-box-number mt-0">
                                            <h5 style="display: inline">
                                                {{ isset($riwayatTerakhir) ? Carbon\Carbon::parse($riwayatTerakhir->dari_tanggal)->isoFormat('DD/MM/YYYY') : '' }}
                                                -
                                                {{ isset($riwayatTerakhir) ? Carbon\Carbon::parse($riwayatTerakhir->sampai_tanggal)->isoFormat('DD/MM/YYYY') : '' }}
                                            </h5>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary elevation-1"><i
                                            class="fas fa-arrow-down"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <h6 style="font-weight: bold">Minimum Support Count : </h6>
                                        </span>
                                        <span class="info-box-number mt-0">
                                            <h4 style="display: inline">
                                                {{ $riwayatTerakhir->minimum_support ?? 'Belum ada data' }}
                                            </h4>
                                            @if (isset($riwayatTerakhir))
                                                {{-- <h5 style="display: inline">%</h5> --}}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1"><i
                                            class="fas fa-arrow-down"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <h6 style="font-weight: bold">Minimum Confidence :</h6>
                                        </span>
                                        <span class="info-box-number mt-0">
                                            <h4 style="display: inline">
                                                {{ $riwayatTerakhir->minimum_confidence ?? 'Belum ada data' }}
                                            </h4>
                                            @if (isset($riwayatTerakhir))
                                                <h5 style="display: inline">%</h5>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-warning elevation-1 text-white"><i
                                            class="fas fa-shopping-cart text-white"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <h6 style="font-weight: bold">Jumlah Data Diproses :</h6>
                                        </span>
                                        <span class="info-box-number mt-0">
                                            <h4 style="display: inline">
                                                {{ $riwayatTerakhir->jumlah_dataset ?? 'Belum ada data' }}</h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clock"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <h6 style="font-weight: bold">Lama Proses :</h6>
                                        </span>
                                        <span class="info-box-number mt-0">
                                            <h4 style="display: inline">
                                                {{ $riwayatTerakhir->lama_proses ?? 'Belum ada data' }}</h4>
                                            @if (isset($riwayatTerakhir))
                                                <h5 style="display: inline">Menit</h5>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-secondary elevation-1"><i
                                            class="fas fa-calendar-day"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <h6 style="font-weight: bold">Waktu Diproses :</h6>
                                        </span>
                                        <span class="info-box-number mt-0">
                                            <h5 style="display: inline">
                                                {{ isset($riwayatTerakhir) ? Carbon\Carbon::parse($riwayatTerakhir->created_at)->isoFormat('DD/MM/YYYY HH:mm') : '-' }}
                                            </h5>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card card-primary card-outline card-outline-tabs mb-0">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-bs-four-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-four-home-tab" data-toggle="pill"
                                                    href="#custom-tabs-four-home" role="tab"
                                                    aria-controls="custom-tabs-four-home" aria-selected="true">Bentuk
                                                    Tabel</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-four-profile-tab"
                                                    data-toggle="pill" href="#custom-tabs-four-profile" role="tab"
                                                    aria-controls="custom-tabs-four-profile" aria-selected="false">Bentuk
                                                    Diagram</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            <div class="tab-pane fade" id="custom-tabs-four-home" role="tabpanel"
                                                aria-labelledby="custom-tabs-four-home-tab">
                                                <table id="tb_hasil"
                                                    class="table table-sm table-bordered table-hover dataTable dtr-inline"
                                                    role="grid" aria-describedby="example2_info">
                                                    <thead>
                                                        <tr role="row" class="text-center">
                                                            <th>
                                                                No.
                                                            </th>
                                                            <th>
                                                                Rule (Aturan)
                                                            </th>
                                                            <th>
                                                                Support Count
                                                            </th>
                                                            <th>
                                                                Confidence (%)
                                                            </th>
                                                            <th>
                                                                Lift Ratio
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade show active" id="custom-tabs-four-profile"
                                                role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                                <div class="row">
                                                    {{-- <div class="col-md-12 col-sm-12 mb-5">
                                                        <canvas id="chartSupport" height="100px"></canvas>
                                                    </div> --}}
                                                    <div class="col-md-12 col-sm-12 mb-5">
                                                        <canvas id="chartConfidence" height="100px"></canvas>
                                                    </div>
                                                    {{-- <div class="col-md-12 col-sm-12 mb-5">
                                                        <canvas id="chartLiftRatio" height="100px"></canvas>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Support -->
    <div class="modal fade" id="supportModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Apa itu nilai support count ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Nilai support count</b> merupakan nilai jumlah frekuensi/kemunculan dari setiap kombinasi item
                        atau
                        barang yang sering dibeli oleh konsumen secara bersamaan dari seluruh transaksi yang ada. Jadi dari
                        data latih yang telah di impor sebelumnya akan dilakukan proses perhitungan jumlah frekuensi untuk
                        setiap kombinasi item dari seluruh transaksi yang ada. Dengan ditentukannya nilai minimum support
                        count,
                        maka sistem hanya akan mengambil kombinasi item dengan jumlah frekuensi/kemunculan yang memenuhi
                        nilai minimum support count yang telah ditentukan. </p>
                </div>
                <div class="modal-footer float-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal Confidence -->
    <div class="modal fade" id="confidenceModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Apa itu nilai confidence ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Nilai confidence</b> merupakan nilai persentase dari kombinasi item yang memenuhi nilai minimum
                        support count. Misalnya terdapat kombinasi item yaitu item A dan item B, dari kombinasi tersebut
                        dapat
                        diketahui seberapa kuat hubungan antara item A dan dan item B, atau seberapa kuat konsumen akan
                        membeli item B apabila ia membeli item A dilihat berdasarkan hasil perhitungan nilai confidence-nya.
                    </p>
                    Dengan ditentukannya nilai minimum confidence, maka sistem hanya akan menampilkan kombinasi item yang
                    memenuhi nilai minimum confidence yang ditentukan.
                </div>
                <div class="modal-footer float-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@push('script')
    <script>
        $('#info-min-support').click(function() {
            $('#supportModal').modal('show');
        });
        $('#info-min-confidence').click(function() {
            $('#confidenceModal').modal('show');
        });

        $('#formSubmit').submit(function(e) {
            $("#overlay").fadeIn(300);
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('proses-aturan-asosiasi') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $("#overlay").fadeOut(300);
                    if (response.message == 'success') {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil di proses',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else if (response.message == 'supportTinggi') {
                        Swal.fire({
                            title: 'Nilai minimum support count terlalu tinggi.',
                            text: 'Silahkan coba dengan nilai minimum support count yang lebih rendah.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else if (response.message == 'confidenceTinggi') {
                        Swal.fire({
                            title: 'Nilai minimum confidence terlalu tinggi.',
                            text: 'Silahkan coba dengan nilai minimum confidence yang lebih rendah.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            })
        })

        $(function() {
            chartJS()
            var table = $('#tb_hasil').DataTable({
                "responsive": true,
                "autoWidth": false,
                "serverSide": true,
                "processing": true,
                "ajax": "{{ url('/tabel-aturan-asosiasi') }}",
                'lengthMenu': [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                'dom': 'lBfrtip',

                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'rule',
                        name: 'rule'
                    },
                    {
                        data: 'support_count',
                        name: 'support_count',
                        className: 'text-center'
                    },
                    {
                        data: 'confidence_persen',
                        name: 'confidence_persen',
                        className: 'text-center'
                    },
                    {
                        data: 'lift_ratio',
                        name: 'lift_ratio',
                        className: 'text-center'
                    },
                ],

            })
        });


        function chartJS() {
            const if_ = {!! $if !!};
            const then_ = {!! $then !!};
            const countIf_ = {!! $if !!}.length;
            const support_ = {!! $support !!};
            const confidence_ = {!! $confidence !!};
            const liftRatio_ = {!! $liftRatio !!};

            // Support Chart
            const dataSupport = {
                labels: if_,
                then: then_,
                datasets: [{
                    label: 'Support Count',
                    data: support_,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1,
                    datalabels: {
                        labels: {
                            name: {
                                color: 'black',
                                anchor: 'end',
                                align: 'top',
                                offset: 4,
                                font: {
                                    size: countIf_ < 5 ? 11 : countIf_ > 10 ? 6 : 8
                                },
                                formatter: function(value, ctx) {
                                    return ctx.chart.data.then[ctx.dataIndex];
                                }
                            },
                            value: {
                                align: 'center',
                                borderWidth: 2,
                                borderRadius: 4,
                                font: {
                                    size: 15,
                                    weight: 'bold'
                                },
                                formatter: function(value, ctx) {
                                    // return value + '%';
                                    return value;
                                },
                                padding: 4
                            }
                        }

                    }
                }]
            }

            const configSupport = {
                type: 'bar',
                data: dataSupport,
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            grace: 5
                        }
                    },
                    plugins: {
                        tooltip: {
                            yAlign: 'bottom',
                            displayColors: false,
                            callbacks: {
                                label: (context) => {
                                    return then_[context.dataIndex] + ' : ' + context.parsed.y + '%';
                                }
                            }
                        }
                    },
                },
            }

            // const chartSupport = new Chart(document.getElementById('chartSupport'), configSupport);

            // Confidence Chart
            const dataConfidence = {
                labels: if_,
                then: then_,
                datasets: [{
                    label: 'Confidence (%)',
                    data: confidence_,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1,
                    datalabels: {
                        labels: {
                            name: {
                                color: 'black',
                                anchor: 'end',
                                align: 'top',
                                offset: 4,
                                font: {
                                    size: countIf_ < 5 ? 11 : countIf_ > 10 ? 6 : 8
                                },
                                formatter: function(value, ctx) {
                                    return ctx.chart.data.then[ctx.dataIndex];
                                }
                            },
                            value: {
                                align: 'center',
                                borderWidth: 2,
                                borderRadius: 4,
                                font: {
                                    size: 15,
                                    weight: 'bold'
                                },
                                formatter: function(value, ctx) {
                                    return value + '%';

                                },
                                padding: 4
                            }
                        }

                    }
                }]
            }

            const configConfidence = {
                type: 'bar',
                data: dataConfidence,
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            grace: 5
                        }
                    },
                    plugins: {
                        tooltip: {
                            yAlign: 'bottom',
                            displayColors: false,
                            callbacks: {
                                label: (context) => {
                                    return then_[context.dataIndex] + ' : ' + context.parsed.y + '%';
                                }
                            }
                        }
                    },
                },
            }

            const chartConfidence = new Chart(document.getElementById('chartConfidence'), configConfidence)

            // Lift Ratio Chart
            const dataLiftRatio = {
                labels: if_,
                then: then_,
                datasets: [{
                    label: 'Lift Ratio',
                    data: liftRatio_,
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1,
                    datalabels: {
                        labels: {
                            name: {
                                color: 'black',
                                anchor: 'end',
                                align: 'top',
                                offset: 4,
                                font: {
                                    size: countIf_ < 5 ? 11 : countIf_ > 10 ? 6 : 8
                                },
                                formatter: function(value, ctx) {
                                    return ctx.chart.data.then[ctx.dataIndex];
                                }
                            },
                            value: {
                                align: 'center',
                                borderWidth: 2,
                                borderRadius: 4,
                                font: {
                                    size: 15,
                                    weight: 'bold'
                                },
                                formatter: function(value, ctx) {
                                    return value;

                                },
                                padding: 4
                            }
                        }

                    }
                }]
            }

            const configLiftRatio = {
                type: 'bar',
                data: dataLiftRatio,
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            grace: 5
                        }
                    },
                    plugins: {
                        tooltip: {
                            yAlign: 'bottom',
                            displayColors: false,
                            callbacks: {
                                label: (context) => {
                                    return then_[context.dataIndex] + ' : ' + context.parsed.y + '%';
                                }
                            }
                        }
                    },
                },
            }

            // const chartLiftRatio = new Chart(document.getElementById('chartLiftRatio'), configLiftRatio)

        }
    </script>
@endpush
