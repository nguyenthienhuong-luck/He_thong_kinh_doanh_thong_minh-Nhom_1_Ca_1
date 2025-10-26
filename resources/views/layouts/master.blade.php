<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <title>@yield('title', 'Default Title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Notyf -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('css')
</head>

<body class="wrapper">
    <div id="loader"></div>
    <!-- Main Sidebar Container -->
    @include('layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <main class="content-wrapper bg-white">
        @if (request()->routeIs('home.account') ||
                request()->routeIs('accounts.*') ||
                request()->routeIs('bank-branches.*') ||
                request()->routeIs('admin.*'))
        @else
            <header>
                @include('layouts.header')
            </header>
        @endif

        <article class="content p-3">
            @yield('content')
        </article>
    </main>
    <!-- /.content-wrapper -->


    <!-- Bootstrap Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- Notyf -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="{{ asset('js/adminlte.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/toast.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        $(document).ready(function() {
            let message = localStorage.getItem('message');
            let type = localStorage.getItem('type');

            if (!message || !type) {
                message = '{{ session('message') }}';
                type = '{{ session('type') }}';
            }

            if (message && type) {
                showToast(message, type);
                localStorage.removeItem('message');
                localStorage.removeItem('type');
            }

            $('.btnBack').click(function() {
                window.history.back();
            });
        })
    </script>
    @stack('js')
</body>
