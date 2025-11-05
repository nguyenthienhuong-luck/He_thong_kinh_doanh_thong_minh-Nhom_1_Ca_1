<nav class="navbar navbar-expand-lg top-navbar shadow-sm">
    <div class="container-fluid px-4">

        <!-- Logo + Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-white" href="{{ route('home.dashboard') }}">
            <img src="{{ asset('images/pigmoney.png') }}" width="38" height="38" alt="logo" class="rounded-circle">
             SmartBudget
        </a>

        <!-- Toggle button (mobile) -->
        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Menu items -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav text-center align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('home.dashboard') ? 'active' : '' }}"
                        href="{{ route('home.dashboard') }}">
                        Trang chủ
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('home.transaction') ? 'active' : '' }}"
                        href="{{ route('home.transaction') }}">
                        Ví của tôi
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('home.budget') ? 'active' : '' }}"
                        href="{{ route('home.budget') }}">
                        Ngân sách
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('home.account') ? 'active' : '' }}"
                        href="{{ route('home.account') }}">
                        Tài khoản
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('home.admin') ? 'active' : '' }}"
                        href="{{ route('home.admin') }}">
                        Thống kê
                    </a>
                </li>
            </ul>
        </div>

        <!-- Logout + Avatar -->
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('logout') }}" class="btn btn-light text-primary fw-semibold px-3 py-2">Đăng xuất</a>
            <a href="{{ route('home.account') }}">
                <img src="{{ Auth::user()->gender == 0 
                    ? asset('images/default-avatar-male.jpg') 
                    : asset('images/default-avatar-female.jpg') }}"
                    class="rounded-circle shadow-sm border border-white" width="42" height="42" alt="User Image">
            </a>
        </div>
    </div>
</nav>

<style>
    .top-navbar {
        background: linear-gradient(90deg, #6C63FF, #9A8BFF);
        color: #fff;
        padding: 10px 0;
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .top-navbar .container-fluid {
    padding: 0 24px !important;   /* chỉ chừa padding trái-phải */
    align-items: center;          /* căn giữa logo và nút đăng xuất theo chiều dọc */
    height: 75px;                 /* chiều cao chuẩn, mảnh hơn */
}
    .navbar-brand img {
        filter: drop-shadow(0 2px 3px rgba(255, 255, 255, 0.4));
    }

    .navbar-nav .nav-link {
        color: #f1f0ff;
        font-weight: 500;
        transition: 0.3s ease;
        border-radius: 10px;
        padding: 8px 16px;
    }

    .navbar-nav .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    .navbar-nav .nav-link.active {
        background: #fff;
        color: #6C63FF !important;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(255, 255, 255, 0.25);
    }

    .btn-light {
        border-radius: 10px;
        background: #fff;
        transition: 0.3s;
    }

    .btn-light:hover {
        background: #f0f0ff;
        transform: scale(1.05);
    }

    .navbar-toggler {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 6px 10px;
    }

    .navbar-toggler:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    @media (max-width: 992px) {
        .navbar-nav {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 10px;
        }
    }
</style>
