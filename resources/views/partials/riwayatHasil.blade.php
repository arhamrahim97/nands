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
                                            {{ isset($riwayatInfo) ? Carbon\Carbon::parse($riwayatInfo->dari_tanggal)->isoFormat('DD/MM/YYYY') : '' }}
                                            -
                                            {{ isset($riwayatInfo) ? Carbon\Carbon::parse($riwayatInfo->sampai_tanggal)->isoFormat('DD/MM/YYYY') : '' }}
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
                                        <h6 style="font-weight: bold">Minimum Support Count:</h6>
                                    </span>
                                    <span class="info-box-number mt-0">
                                        <h4 style="display: inline">
                                            {{ $riwayatInfo->minimum_support ?? 'Belum ada data' }}
                                        </h4>
                                        @if (isset($riwayatInfo))
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
                                            {{ $riwayatInfo->minimum_confidence ?? 'Belum ada data' }}
                                        </h4>
                                        @if (isset($riwayatInfo))
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
                                            {{ $riwayatInfo->jumlah_dataset ?? 'Belum ada data' }}</h4>
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
                                            {{ $riwayatInfo->lama_proses ?? 'Belum ada data' }}</h4>
                                        @if (isset($riwayatInfo))
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
                                        <h6 style="font-weight: bold">Tanggal Diproses :</h6>
                                    </span>
                                    <span class="info-box-number mt-0">
                                        <h5 style="display: inline">
                                            {{ isset($riwayatInfo) ? Carbon\Carbon::parse($riwayatInfo->created_at)->isoFormat('DD/MM/YYYY HH:mm') : '-' }}
                                        </h5>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="card card-primary card-outline card-outline-tabs">
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
                                                    @foreach ($rule as $item)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>Jika membeli {{ $item->if }}
                                                                maka akan membeli
                                                                {{ $item->then }}</td>
                                                            <td class="text-center">{{ $item->support_count }}</td>
                                                            <td class="text-center">{{ $item->confidence_persen }}
                                                            </td>
                                                            <td class="text-center">{{ $item->lift_ratio }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane show active" id="custom-tabs-four-profile"
                                            role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                            <div class="row">
                                                <input type="hidden" data-if="{{ $if }}"
                                                    data-then="{{ $then }}"
                                                    data-support="{{ $support }}"
                                                    data-confidence="{{ $confidence }}"
                                                    data-liftratio="{{ $liftRatio }}" id="for-if">
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


@push('script')
    <script>
        $(function() {
            dataTables()
            chartJS()
        });

        function dataTables() {
            var table = $('#tb_hasil').DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                'dom': 'lBfrtip',
            })
        }

        function chartJS() {
            const if_ = $('#for-if').data('if')
            const then_ = $('#for-if').data('then')
            const countIf_ = if_.length;
            const support_ = $('#for-if').data('support')
            const confidence_ = $('#for-if').data('confidence')
            const liftRatio_ = $('#for-if').data('liftratio')

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
