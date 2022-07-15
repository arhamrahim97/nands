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
                                        <h6 style="font-weight: bold">Minimum Support :</h6>
                                    </span>
                                    <span class="info-box-number mt-0">
                                        <h4 style="display: inline">
                                            {{ $riwayatTerakhir->minimum_support ?? 'Belum ada data' }}
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
                                                            Support (%)
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
