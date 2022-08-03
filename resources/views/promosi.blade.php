@extends('layouts.main')


@section('content')
    <section>
        <div data-aos="fade-up" data-aos-duration="700" class="row mb-3 aos-init aos-animate">
            <div class="col-lg-12 mb-2">
                <div class="card card-lightblue card-outline">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title"><i class="fas fa-boxes"></i> Berdasarkan kombinasi barang yang sering dibeli
                            (FP-Growth)</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-normal">Pilih Riwayat:</label>
                                    <select class="form-control" id="pilih-riwayat" autocomplete="off">
                                        @forelse ($riwayat as $item)
                                            <option value="{{ $item->id }}">
                                                Waktu Diproses:
                                                {{ Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/YYYY HH:mm') }}
                                                |
                                                Dari dan Sampai Tanggal:
                                                {{ Carbon\Carbon::parse($item->dari_tanggal)->isoFormat('DD/MM/YYYY') }} -
                                                {{ Carbon\Carbon::parse($item->sampai_tanggal)->isoFormat('DD/MM/YYYY') }} |
                                                Minimum Support Count: {{ $item->minimum_support }} | Minimum Confidence:
                                                {{ $item->minimum_confidence }}% | Jumlah Data Diproses:
                                                {{ $item->jumlah_dataset }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="promosi-itemset">
                                    @component('partials.promosiItemset',
                                        [
                                            // 'riwayatInfo' => $riwayatInfo,
                                            'rule' => $rule,
                                            'if' => $if,
                                            'then' => $then,
                                            // 'support' => $support,
                                            'confidence' => $confidence,
                                            // 'liftRatio' => $liftRatio,
                                        ])
                                    @endcomponent
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-aos="fade-up" data-aos-duration="700" class="row mb-3 aos-init aos-animate">
            <div class="col-lg-12 mb-2">
                <div class="card card-lightblue card-outline">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title"><i class="fas fa-sort-amount-up"></i> Berdasarkan barang terlaris</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-normal">Pilih Bulan:</label>
                                    <select class="form-control" id="pilih-bulan-desc" autocomplete="off">
                                        <option value="">Semua</option>
                                        @forelse ($listDate as $item)
                                            <option value="{{ $item->month_year }}">
                                                {{ Carbon\Carbon::parse($item->month_year)->translatedFormat('F Y') }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="promosi-barang-terlaris">
                                    @component('partials.promosiItemDesc',
                                        [
                                            'barangTerlaris' => $barangTerlaris,
                                            'barangTerlarisCount' => $barangTerlarisCount,
                                            'barangTerlarisTable' => $barangTerlarisTable,
                                        ])
                                    @endcomponent
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div data-aos="fade-up" data-aos-duration="700" class="row mb-3 aos-init aos-animate">
            <div class="col-lg-12 mb-2">
                <div class="card card-lightblue card-outline">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title"><i class="fas fa-sort-amount-down-alt"></i> Berdasarkan barang kurang laris
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-normal">Pilih Bulan:</label>
                                    <select class="form-control" id="pilih-bulan-asc" autocomplete="off">
                                        <option value="">Semua</option>
                                        @forelse ($listDate as $item)
                                            <option value="{{ $item->month_year }}">
                                                {{ Carbon\Carbon::parse($item->month_year)->translatedFormat('F Y') }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="promosi-barang-kurang-laris">
                                    @component('partials.promosiItemAsc',
                                        [
                                            'barangKurangLaris' => $barangKurangLaris,
                                            'barangKurangLarisCount' => $barangKurangLarisCount,
                                            'barangKurangLarisTable' => $barangKurangLarisTable,
                                        ])
                                    @endcomponent
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
        $('#pilih-riwayat').on('change', function() {
            var id = $(this).val();
            $("#overlay").fadeIn(300);
            $.ajax({
                type: 'GET',
                url: "{{ url('get-riwayat-promosi') }}" + "/" + id,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#overlay").fadeOut(300);
                    $('#promosi-itemset').html('')
                    $('#promosi-itemset').html(response);
                    chartJSItemset()
                    dataTablesItemset()
                }
            })
        });

        $('#pilih-bulan-desc').on('change', function() {
            var id = $(this).val();
            $("#overlay").fadeIn(300);
            $.ajax({
                type: 'GET',
                url: "{{ url('get-barang-laris') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    date: id
                },
                success: function(response) {
                    $("#overlay").fadeOut(300);
                    $('#promosi-barang-terlaris').html('')
                    $('#promosi-barang-terlaris').html(response);
                    chartJSItemDesc()
                    dataTablesItemDesc()
                }
            })
        });

        $('#pilih-bulan-asc').on('change', function() {
            var id = $(this).val();
            $("#overlay").fadeIn(300);
            $.ajax({
                type: 'GET',
                url: "{{ url('get-barang-kurang-laris') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    date: id
                },
                success: function(response) {
                    $("#overlay").fadeOut(300);
                    $('#promosi-barang-kurang-laris').html('')
                    $('#promosi-barang-kurang-laris').html(response);
                    chartJSItemAsc()
                    dataTablesItemAsc()

                    // console.log(response);
                }
            })
        });
    </script>
@endpush
