<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text"><span class="text-primary fw-bold" style="font-style: italic">Fitrah</span> <span
                class="text-danger fw-light" style="font-style: italic">Swalayan</span></span>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-host os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-theme-dark os-host-overflow-x">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 73px; height: 440px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link @if ($title == 'Dashboard') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">
                                <h6 class="font-weight-bold pt-2 mb-0">FP-Growth</h6>
                            </li>
                            <li class="nav-item">
                                <a href="/data-transaksi"
                                    class="nav-link @if ($title == 'Data Transaksi') active @endif">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Data Transaksi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/aturan-asosiasi"
                                    class="nav-link @if ($title == 'Aturan Asosiasi') active @endif">
                                    <i class="nav-icon fas fa-cubes"></i>
                                    <p>
                                        Aturan Asosiasi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/riwayat" class="nav-link @if ($title == 'Riwayat') active @endif">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>
                                        Riwayat
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">
                                <h6 class="font-weight-bold pt-2 mb-0">Strategi Promosi</h6>
                            </li>
                            <li class="nav-item">
                                <a href="/promosi" class="nav-link @if ($title == 'Promosi') active @endif">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <p>
                                        Promosi
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 38.5417%; transform: translate(0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 37.6601%; transform: translate(0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>
