@extends('layouts.main')


@section('content')
    <section>
        <div data-aos="fade-up" data-aos-duration="700" class="row mb-3 aos-init aos-animate">
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">Info Data Transaksi Saat Ini</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
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
                                                    {{ $totalTransaksi }}
                                                </h4>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1 text-white"><i
                                                class="fas fa-boxes"></i></span>
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
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">Info Hasil Aturan Asosiasi Terbaru</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
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
                                                <h6 style="font-weight: bold">Minimum Support : </h6>
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
                                        <span class="info-box-icon bg-danger elevation-1"><i
                                                class="fas fa-clock"></i></span>
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
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 mb-5">
                                                    <canvas id="chartSupport" height="100px"></canvas>
                                                </div>
                                                <div class="col-md-12 col-sm-12 mb-5">
                                                    <canvas id="chartConfidence" height="100px"></canvas>
                                                </div>
                                                <div class="col-md-12 col-sm-12 mb-5">
                                                    <canvas id="chartLiftRatio" height="100px"></canvas>
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
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(function() {
            chartJS()
        })

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
                    label: 'Support',
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

            const chartSupport = new Chart(document.getElementById('chartSupport'), configSupport);

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

            const chartLiftRatio = new Chart(document.getElementById('chartLiftRatio'), configLiftRatio)

        }
    </script>
@endpush
