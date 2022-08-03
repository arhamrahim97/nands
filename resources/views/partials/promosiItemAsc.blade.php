<input type="hidden" data-barang-kurang-laris="{{ $barangKurangLaris }}"
    data-barang-kurang-laris-count="{{ $barangKurangLarisCount }}" id="for-itemAsc">

<ul class="nav nav-tabs" id="custom-content-above-tab3" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="custom-content-above-home-tab3" data-toggle="pill" href="#custom-content-above-home3"
            role="tab" aria-controls="custom-content-above-home3" aria-selected="true">Bentuk Tabel
            (max. 500 data)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="custom-content-above-profile-tab3" data-toggle="pill"
            href="#custom-content-above-profile3" role="tab" aria-controls="custom-content-above-profile3"
            aria-selected="false">Bentuk
            Diagram (max. 20 data)</a>
    </li>
</ul>
<div class="tab-content" id="custom-content-above-tabContent3">
    <div class="tab-pane fade py-4" id="custom-content-above-home3" role="tabpanel"
        aria-labelledby="custom-content-above-home-tab3">
        <div class="row">
            <div class="col-12">
                <table id="tb_item_asc" class="table table-sm table-bordered table-hover dataTable dtr-inline"
                    role="grid" aria-describedby="example2_info">
                    <thead>
                        <tr role="row" class="text-center">
                            <th>
                                No.
                            </th>
                            <th>
                                Nama Barang
                            </th>
                            <th>
                                Jumlah Terjual
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangKurangLarisTable as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade py-3 active show" id="custom-content-above-profile3" role="tabpanel"
        aria-labelledby="custom-content-above-profile-tab3">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <canvas id="chartBarangKurangLaris" height="100px"></canvas>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        $(function() {
            chartJSItemAsc()
            dataTablesItemAsc()
        })

        function dataTablesItemAsc() {
            var table = $('#tb_item_asc').DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                'dom': 'lBfrtip',
            })
        }

        function chartJSItemAsc() {
            const barangKurangLaris_ = $('#for-itemAsc').data('barang-kurang-laris')
            const barangKurangLarisCount_ = $('#for-itemAsc').data('barang-kurang-laris-count')

            // Barang Terlaris Chart
            const barangKurangLaris = {
                labels: barangKurangLaris_,
                datasets: [{
                    label: 'Barang Terlaris',
                    data: barangKurangLarisCount_,
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1,
                    datalabels: {
                        labels: {
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

            const configBarangKurangLaris = {
                type: 'bar',
                data: barangKurangLaris,
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
                                    return 'Jumlah Terjual : ' + context.parsed.y;
                                }
                            }
                        }
                    },
                },
            }

            const chartBarangKurangLaris = new Chart(document.getElementById('chartBarangKurangLaris'),
                configBarangKurangLaris)
        }
    </script>
@endpush
