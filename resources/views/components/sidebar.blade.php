<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a>
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="" height="32">
                <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="menu">
                    </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('dashboard.index') }}"><img
                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt="" height="32"></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img height="32"
                                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav active" href="{{ route('dashboard.index') }}">
                            <i data-feather="clock"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav active" href="{{ route('arsip.index') }}">
                            <i data-feather="book"></i>
                            <span>Arsip</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i data-feather="folder"></i>
                            <span>Arsip Penugasan</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('bidang.index') }}">Arsip SPT</a></li>
                            <li><a href="{{ route('pangkat.index') }}">Arsip Data Penugasan</a></li>
                            <li><a href="{{ route('pangkat.index') }}">Jadwal PKPT</a></li>
                        </ul>
                    </li> --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('profil_pegawai.index') }}">
                            <i data-feather="users"></i>
                            <span>Profil Pegawai</span>
                        </a>
                    </li>
                    @if(Auth::user()->role == 'admin')
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i data-feather="database"></i>
                            <span>Master</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('bidang.index') }}">Daftar Bidang</a></li>
                            <li><a href="{{ route('pangkat.index') }}">Pangkat Pegawai</a></li>
                            <li><a href="{{ route('kategori_arsip.index') }}">Kategori Arsip</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('user.index') }}">
                            <i data-feather="users"></i>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
