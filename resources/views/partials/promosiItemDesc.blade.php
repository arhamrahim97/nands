<input type="hidden" data-barang-terlaris="{{ $barangTerlaris }}" data-barang-terlaris-count="{{ $barangTerlarisCount }}"
    id="for-itemDesc">

<ul class="nav nav-tabs" id="custom-content-above-tab2" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="custom-content-above-home-tab2" data-toggle="pill" href="#custom-content-above-home2"
            role="tab" aria-controls="custom-content-above-home2" aria-selected="true">Bentuk Tabel
            (max. 500 data)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="custom-content-above-profile-tab2" data-toggle="pill"
            href="#custom-content-above-profile2" role="tab" aria-controls="custom-content-above-profile2"
            aria-selected="false">Bentuk
            Diagram (max. 20 data)</a>
    </li>
</ul>
<div class="tab-content" id="custom-content-above-tabContent2">
    <div class="tab-pane fade py-4" id="custom-content-above-home2" role="tabpanel"
        aria-labelledby="custom-content-above-home-tab2">
        <div class="row">
            <div class="col-12">
                <table id="tb_item_desc" class="table table-sm table-bordered table-hover dataTable dtr-inline"
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
                        @foreach ($barangTerlarisTable as $item)
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
    <div class="tab-pane fade py-3 active show" id="custom-content-above-profile2" role="tabpanel"
        aria-labelledby="custom-content-above-profile-tab2">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <canvas id="chartBarangTerlaris" height="100px"></canvas>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        $(function() {
            chartJSItemDesc()
            dataTablesItemDesc()
        })

        function dataTablesItemDesc() {
            var table = $('#tb_item_desc').DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                'dom': 'lBfrtip',
            })
        }

        function chartJSItemDesc() {
            const barangTerlaris_ = $('#for-itemDesc').data('barang-terlaris')
            const barangTerlarisCount_ = $('#for-itemDesc').data('barang-terlaris-count')

            // Barang Terlaris Chart
            const barangTerlaris = {
                labels: barangTerlaris_,
                datasets: [{
                    label: 'Barang Terlaris',
                    data: barangTerlarisCount_,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
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

            const configBarangTerlaris = {
                type: 'bar',
                data: barangTerlaris,
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

            const chartBarangTerlaris = new Chart(document.getElementById('chartBarangTerlaris'), configBarangTerlaris)
        }
    </script>
@endpush
