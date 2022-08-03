<input type="hidden" data-if="{{ $if }}" data-then="{{ $then }}" data-confidence="{{ $confidence }}"
    id="for-itemset">

<ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home"
            role="tab" aria-controls="custom-content-above-home" aria-selected="true">Bentuk Tabel</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="custom-content-above-profile-tab" data-toggle="pill"
            href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile"
            aria-selected="false">Bentuk Diagram</a>
    </li>
</ul>
<div class="tab-content" id="custom-content-above-tabContent">
    <div class="tab-pane fade py-4" id="custom-content-above-home" role="tabpanel"
        aria-labelledby="custom-content-above-home-tab">
        <div class="row">
            <div class="col-12">
                <table id="tb_itemset" class="table table-sm table-bordered table-hover dataTable dtr-inline"
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
        </div>
    </div>
    <div class="tab-pane fade py-3 active show" id="custom-content-above-profile" role="tabpanel"
        aria-labelledby="custom-content-above-profile-tab">
        <div class="row">
            <div class="col-12">
                <canvas id="chartConfidence" height="100px"></canvas>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        $(function() {
            chartJSItemset()
            dataTablesItemset()
        })

        function dataTablesItemset() {
            var table = $('#tb_itemset').DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                'dom': 'lBfrtip',
            })
        }

        function chartJSItemset() {
            const if_ = $('#for-itemset').data('if')
            const then_ = $('#for-itemset').data('then')
            const countIf_ = if_.length;
            // const support_ = $('#for-itemset').data('support')
            const confidence_ = $('#for-itemset').data('confidence')
            // const liftRatio_ = $('#for-itemset').data('liftratio')

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
        }
    </script>
@endpush
