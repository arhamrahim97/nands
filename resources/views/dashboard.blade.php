@extends('layouts.main')


@section('content')
    <section>
        <div data-aos="fade-up" data-aos-duration="700" class="row mb-3 aos-init aos-animate">
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">Info Data Transaksi Saat Ini</h3>
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
