@extends('layouts.main')

@section('content')
    <section>
        <div class="row">
            <div class="col">
                <div class="card card-lightblue card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat</h3>
                    </div>
                    <form method="POST" class="form-horizontal" id="formSubmit" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Pilih Riwayat</label>
                                <select class="form-control" id="pilih-riwayat">
                                    @forelse ($riwayat as $item)
                                        <option value="{{ $item->id }}">
                                            Waktu Diproses:
                                            {{ Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/YYYY HH:mm') }} |
                                            Dari dan Sampai Tanggal:
                                            {{ Carbon\Carbon::parse($item->dari_tanggal)->isoFormat('DD/MM/YYYY') }} -
                                            {{ Carbon\Carbon::parse($item->sampai_tanggal)->isoFormat('DD/MM/YYYY') }} |
                                            Minimum Support: {{ $item->minimum_support }} | Minimum Confidence:
                                            {{ $item->minimum_confidence }}% | Jumlah Data Diproses:
                                            {{ $item->jumlah_dataset }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div id="hasil-riwayat">
        @component('partials.riwayatHasil',
            [
                'riwayatInfo' => $riwayatInfo,
                'rule' => $rule,
                'if' => $if,
                'then' => $then,
                'support' => $support,
                'confidence' => $confidence,
                'liftRatio' => $liftRatio,
            ])
        @endcomponent
    </div>
@endsection

@push('script')
    <script>
        $('#pilih-riwayat').on('change', function() {
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{ url('get-riwayat') }}" + "/" + id,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#hasil-riwayat').html('')
                    $('#hasil-riwayat').html(response);
                    dataTables()
                    chartJS()
                }
            })
        });
    </script>
@endpush
