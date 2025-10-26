<aside class="main-sidebar sidebar-light-purple elevation-4" style="background-color: var(--primary-color)">
    <!-- Brand Logo -->
    <a href="{{ route('home.dashboard') }}" class="brand-link border-0">
        <div class="d-flex align-items-end justify-content-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="62" height="63">
            <h6 class="text-white">Money Mate</h6>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar px-0 mt-5">
        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item text-center">
                    <a href="{{ route('home.dashboard') }}"
                        class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase{{ request()->routeIs('home.dashboard') || request()->routeIs('dashboards.*') ? ' active' : '' }}">
                        TỔNG QUAN
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{ route('home.transaction') }}"
                        class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase{{ request()->routeIs('home.transaction') || request()->routeIs('transactions.*') ? ' active' : '' }}">
                        SỐ GIAO DỊCH
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{ route('home.budget') }}"
                        class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase{{ request()->routeIs('home.budget') || request()->routeIs('budgets.*') ? ' active' : '' }}">
                        NGÂN SÁCH </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{ route('home.account') }}"
                        class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase{{ request()->routeIs('home.account') || request()->routeIs('accounts.*') ? ' active' : '' }}">
                        TÀI KHOẢN
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{ route('home.admin') }}"
                        class="nav-link rounded-0 py-3 text-white fw-bold text-uppercase{{ request()->routeIs('home.admin') ? ' active' : '' }}">
                        THỐNG KÊ
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <a href="{{ route('logout') }}"
        class="position-absolute start-0 end-0 bottom-0 py-3 text-white text-uppercase fw-bold text-center">
        <i class="position-absolute top-50 start-0 ms-3 translate-middle fa-solid fa-arrow-right-from-bracket"></i>
        <span class="mx-auto">Đăng xuất</span>
    </a>
</aside>
