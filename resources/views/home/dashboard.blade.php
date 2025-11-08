@extends('layouts.master')

@section('title', 'SmartBudget - Tổng quan')

@section('content')
<style>
    :root {
        --primary: #6C63FF;
        --secondary: #9A8BFF;
        --gradient: linear-gradient(135deg, #6C63FF, #9A8BFF);
        --light-bg: #F5F6FF;
        --card-bg: #ffffff;
    }

    body {
        background: linear-gradient(180deg, #ECEBFF 0%, #F8F9FF 100%);
        font-family: 'Poppins', sans-serif;
    }

    .main-content-wrapper {
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 40px 0;
        margin: 0 auto;
    }

    .content-inner {
        max-width: 1100px;
        width: 100%;
        padding: 0 30px 60px;
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 8px 25px rgba(108, 99, 255, 0.1);
        transition: all 0.3s ease;
    }

    .balance-header {
        max-width: 95%;
        margin: 35px auto 0;
        padding: 20px 30px;
        border: 1px solid rgba(108, 99, 255, 0.12);
        border-radius: 16px;
        background: #FFFFFF;
        box-shadow: 0 5px 18px rgba(108, 99, 255, 0.06);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: 0.25s ease;
    }

    .balance-header:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(108, 99, 255, 0.12);
    }

    .balance-info h4 {
        margin: 0;
        font-weight: 700;
        color: #1F2D3D;
        font-size: 1.3rem;
    }

    .balance-info span {
        font-size: 0.9rem;
        color: #777;
    }

    .currency-btn {
        background: var(--gradient);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(108, 99, 255, 0.25);
        transition: 0.3s;
    }

    .currency-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--gradient);
        color: #fff;
        border-radius: 18px;
        padding: 20px 30px;
        box-shadow: 0 5px 20px rgba(108, 99, 255, 0.3);
        margin-bottom: 25px;
    }

    .page-header h2 {
        font-weight: 700;
        margin: 0;
    }

    .card {
        border: none !important;
        border-radius: 18px !important;
        background: var(--card-bg);
        box-shadow: 0 5px 20px rgba(108, 99, 255, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 25px;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(108, 99, 255, 0.15);
    }

    h5.section-title {
        border-left: 5px solid var(--primary);
        padding-left: 10px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    .list-group-item {
        background: #F5F4FF !important;
        border-radius: 12px !important;
        transition: 0.2s ease;
        margin-bottom: 10px;
    }

    .list-group-item:hover {
        background: #ECEAFF !important;
    }

    .text-primary-color {
        color: var(--primary) !important;
    }

    .btn-outline-primary-color {
        border: 2px solid var(--primary);
        color: var(--primary);
        border-radius: 10px;
        transition: 0.3s;
    }

    .btn-outline-primary-color:hover {
        background: var(--gradient);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(108,99,255,0.3);
    }

    .btn-gradient {
        background: var(--gradient);
        color: #fff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(108,99,255,0.25);
        transition: 0.3s;
    }

    .btn-gradient:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(108,99,255,0.35);
    }

    article.content {
        max-width: 1100px;
        margin: 0 auto;
    }
</style>

<div class="main-content-wrapper">
    <div class="content-inner py-4">

        <!-- HEADER -->
        <div class="page-header">
            <h2>SmartBudget</h2>
        </div>

        <!-- THANH TỔNG SỐ DƯ -->
        <div class="balance-header">
            <div class="balance-info">
                <h4>{{ Auth::user()->total_balance ?? '0.00' }} </h4>
                <span>Tổng số dư</span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button class="currency-btn" data-bs-toggle="modal" data-bs-target="#currencyModal">
                    <i class="fa-solid fa-dollar-sign"></i>
                </button>

                <a href="{{ route('accounts.edit') }}">
                    <img src="{{ Auth::user()->gender == 0 
                        ? asset('images/default-avatar-male.jpg') 
                        : asset('images/default-avatar-female.jpg') }}"
                        class="rounded-circle border" width="50" alt="User Image">
                </a>
            </div>
        </div>

        <!-- VÍ CỦA TÔI -->
        <div class="card p-4 mt-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="section-title">Ví của tôi</h5>
                <a href="#" class="text-primary-color fw-bold" data-bs-toggle="modal" data-bs-target="#walletsModal">Xem tất cả</a>
            </div>
            <div class="d-flex flex-column gap-2">
                @foreach ($user->topWallets() as $wallet)
                <div class="d-flex justify-content-between align-items-center list-group-item border-0">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('images/icon.jpg') }}" class="rounded-circle" width="35" height="35" alt="wallet">
                        <strong>{{ $wallet->name }}</strong>
                    </div>
                    <span class="text-primary fw-semibold">{{ $wallet->formatted_balance }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- MODAL đổi đơn vị tiền -->
        <div class="modal fade" id="currencyModal" tabindex="-1" aria-labelledby="currencyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header text-white" style="background: var(--gradient);">
                        <h5 class="modal-title fw-bold">Chọn đơn vị tiền tệ</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('home.currency.update') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <select class="form-select" name="currency" required>
                                    <option value="VND" {{ Auth::user()->currency == 'VND' ? 'selected' : '' }}>🇻🇳 Việt Nam Đồng (VND)</option>
                                    <option value="USD" {{ Auth::user()->currency == 'USD' ? 'selected' : '' }}>🇺🇸 Đô la Mỹ (USD)</option>
                                    <option value="EUR" {{ Auth::user()->currency == 'EUR' ? 'selected' : '' }}>🇪🇺 Euro (EUR)</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" style="background: var(--gradient); border: none;">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- BÁO CÁO CHI TIÊU -->
        <div class="card p-4 mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="section-title">Báo cáo chi tiêu</h5>
                <a href="#" class="text-primary-color fw-bold">Xem báo cáo</a>
            </div>
            <ul class="nav nav-pills nav-fill mb-3 bg-body-secondary rounded-3 p-2 w-25 mx-auto" id="report-pills-tab">
                <li class="nav-item">
                    <button class="nav-link active" id="report-pills-week-tab" data-bs-toggle="pill" data-bs-target="#report-pills-week">Tuần</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="report-pills-week">
                    <div id="weekly-expense-chart"></div>
                </div>
            </div>
        </div>

        <!-- GIAO DỊCH HÔM NAY -->
        <div class="card p-4 mb-4">
            <h5 class="section-title">Giao dịch hôm nay</h5>
            @if ($user->getTodayTransactions()->isEmpty())
                <p class="text-center text-muted my-4">Hôm nay chưa có giao dịch nào</p>
            @else
                <div class="list-group mt-3">
                    @foreach ($user->getTodayTransactions() as $transaction)
                    <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('images/icon.jpg') }}" class="rounded-circle" width="40">
                            <div>
                                <h6 class="m-0">{{ $transaction->category->name }}</h6>
                                <small class="text-muted">{{ $transaction->formatted_amount }}</small>
                            </div>
                        </div>
                        <button class="btn btn-outline-primary-color" data-bs-toggle="modal" data-bs-target="#showTransaction-{{ $transaction->id }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- NÚT GỬI BÁO CÁO EMAIL -->
        <div class="text-center mt-4 mb-5">
            <form action="{{ route('send.daily.report') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-gradient px-4 py-2 fw-bold">
                    <i class="fa-solid fa-envelope"></i> Gửi báo cáo qua Email
                </button>
            </form>
        </div>
        
        <!-- MODAL THÊM GIAO DỊCH MỚI -->
        <x-transaction-modal :user="$user" :group-types="$groupTypes" :categories="$categories" />
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const weekData = Object.values(@json($user->getWeeklyExpenses()));
    window.weekChart = new ApexCharts(document.querySelector("#weekly-expense-chart"), {
        chart: { type: 'bar', height: 320 },
        series: [{ name: 'Chi tiêu', data: weekData }],
        xaxis: { categories: ['T2','T3','T4','T5','T6','T7','CN'] },
        colors: ['#6C63FF'],
        dataLabels: {
            enabled: true,
            formatter: val => val ? val.toLocaleString('vi-VN') + ' ₫' : '',
            style: { colors: ['#fff'], fontWeight: '600' }
        }
    });
    weekChart.render();
});
</script>

@endsection
