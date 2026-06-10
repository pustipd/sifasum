<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/img.png') }}" width="27" height="27" alt="">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: uppercase; font-size: 22px">SIFASUM</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{url('/')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Persyaratan</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div>Fasilitas Umum</div>
            </a>

            <ul class="menu-sub">
                @foreach ($list_fasilitas_umum as $item)
                    <li class="menu-item">
                        <a href="{{ url('ruangan') . '/' . $item->nama_ruang }}" class="menu-link">
                            <div>{{ $item->nama_ruang }}</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        @auth
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div>Fasilitas Khusus</div>
                </a>

                <ul class="menu-sub">
                    @foreach ($list_fasilitas_khusus as $item)
                        <li class="menu-item">
                            <a href="{{ url('ruangan') . '/' . $item->nama_ruang }}" class="menu-link">
                                <div>{{ $item->nama_ruang }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div>Lainnya</div>
                </a>
                <ul class="menu-sub">
                    @foreach ($list_fasilitas_lainnya as $item)
                        <li class="menu-item">
                            <a href="{{ url('ruangan') . '/' . $item->nama_ruang }}" class="menu-link">
                                <div>{{ $item->nama_ruang }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="menu-item">
                <a href="{{url('/logout')}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-log-out-circle"></i>
                    <div>Logout</div>
                </a>
            </li>
        @endauth

        @if (! auth()->check())
            <li class="menu-item">
                <a href="{{url('/login')}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-log-in-circle"></i>
                    <div>Login</div>
                </a>
            </li>
        @endif

    </ul>
</aside>
