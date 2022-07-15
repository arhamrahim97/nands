        <!-- Navbar -->
        {{-- <nav class="main-header navbar navbar-expand border-bottom-0 navbar-dark navbar-lightblue"> --}}
        <nav class="main-header navbar navbar-expand border-bottom-0 navbar-dark navbar-primary">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto px-2">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{ Auth::user()->name }} <i class="right fas fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#akunModal">
                            <i class="fas fa-user-cog"></i> Ubah Akun
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="{{ url('/logout') }}" class="dropdown-item dropdown-footer"><i
                                class="fas fa-power-off"></i>
                            LOGOUT</a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->
