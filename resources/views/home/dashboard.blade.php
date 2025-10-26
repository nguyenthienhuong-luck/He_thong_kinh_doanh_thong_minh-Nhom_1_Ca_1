@extends('layouts.master')

@section('title', 'Tổng quan')

@section('content')
    <section class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tổng quan</h1>
                </div>
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Widgets</li>
                    </ol>
                </div> --}}
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex gap-2 align-items-between justify-content-center flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-md fw-bold m-0">Ví của tôi</h5>
                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#walletsModal"
                            class="text-primary-color text-sm fw-bold">Xem tất cả</a>
                    </div>
                    <!-- List wallets -->
                    @include('components.list-wallet')
                    {{-- /. list wallets --}}
                    <div class="line"></div>
                    <div class="d-flex justify-content-between align-items-start flex-column gap-3">
                        @foreach ($user->topWallets() as $wallet)
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex gap-3 align-items-center justify-content-center">
                                    <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2" width="30"
                                        alt="Wallet icon">
                                    <span class="text-lg fw-semibold">{{ $wallet->name }}</span>
                                </div>
                                <h5 class="text-lg fw-semibold m-0">{{ $wallet->formatted_balance }}</h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Report -->
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 id="tab-content-title">Báo cáo tuần này</h5>
                    <a href="#" class="text-primary-color text-sm fw-bold">Xem báo cáo</a>
                </div>
                <div class="d-flex align-items-center justify-content-center tab-navigation-wrapper">
                    <ul class="nav nav-pills nav-fill mb-3 w-25 bg-body-secondary rounded-3 p-2" id="report-pills-tab"
                        role="tablist">
                        <li class="nav-item text-lg" role="presentation">
                            <button class="nav-link text-dark rounded-3 active" id="report-pills-week-tab"
                                data-bs-toggle="pill" data-bs-target="#report-pills-week" type="button" role="tab"
                                aria-controls="report-pills-week" aria-selected="true">Tuần</button>
                        </li>
                        <li class="nav-item text-lg" role="presentation">
                            <button class="nav-link text-dark rounded-3" id="report-pills-month-tab" data-bs-toggle="pill"
                                data-bs-target="#report-pills-month" type="button" role="tab"
                                aria-controls="report-pills-month" aria-selected="false">Tháng</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="report-pills-tabContent">
                    <div class="tab-pane fade show active" id="report-pills-week" role="tabpanel"
                        aria-labelledby="report-pills-week-tab" tabindex="0">
                        <div id="weekly-expense-chart" style="height: 300px;"></div>
                    </div>
                    <div class="tab-pane fade" id="report-pills-month" role="tabpanel"
                        aria-labelledby="report-pills-month-tab" tabindex="0">
                        <div id="monthly-expense-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.report -->

        <!-- Most spend -->
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Chi tiêu nhiều nhất</h5>
                    <a href="#" class="text-primary-color text-sm fw-bold">Xem chi tiết</a>
                </div>
                <div class="d-flex align-items-center justify-content-center tab-navigation-wrapper">
                    <ul class="nav nav-pills nav-fill mb-3 w-25 bg-body-secondary rounded-3 p-2" id="category-pills-tab"
                        role="tablist">
                        <li class="nav-item text-lg" role="presentation">
                            <button class="nav-link text-dark rounded-3 active" id="category-pills-week-tab"
                                data-bs-toggle="pill" data-bs-target="#category-pills-week" type="button" role="tab"
                                aria-controls="category-pills-week" aria-selected="true">Tuần</button>
                        </li>
                        <li class="nav-item text-lg" role="presentation">
                            <button class="nav-link text-dark rounded-3" id="category-pills-month-tab" data-bs-toggle="pill"
                                data-bs-target="#category-pills-month" type="button" role="tab"
                                aria-controls="category-pills-month" aria-selected="false">Tháng</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content list-transaction" id="category-pills-tabContent">
                    <div class="tab-pane fade show active" id="category-pills-week" role="tabpanel"
                        aria-labelledby="category-pills-week-tab" tabindex="0">
                        <div class="list-group">
                            @foreach ($user->getWeeklyCategoryExpenses() as $expense)
                                <div class="list-group-item border-0 bg-body-secondary rounded-4">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2"
                                            width="80" alt="Category Image">
                                        <div class="d-flex align-items-between justify-content-center flex-column">
                                            <h6>{{ $expense['name'] }}</h6>
                                            <strong class="text-muted">{{ $expense['total'] }}</strong>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold text-danger">{{ $expense['percentage'] }}</h5>
                                </div>
                                @if (!$loop->last)
                                    <div class="my-2"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="category-pills-month" role="tabpanel"
                        aria-labelledby="category-pills-month-tab" tabindex="0">
                        <div class="list-group">
                            @foreach ($user->getMonthlyCategoryExpenses() as $expense)
                                <div class="list-group-item border-0 bg-body-secondary rounded-4 mb-3">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2"
                                            width="80" alt="Category Image">
                                        <div class="d-flex align-items-between justify-content-center flex-column">
                                            <h6>{{ $expense['name'] }}</h6>
                                            <strong class="text-muted">{{ $expense['total'] }}</strong>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold text-danger">{{ $expense['percentage'] }}</h5>
                                </div>
                                @if (!$loop->last)
                                    <div class="my-2"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.most spend -->

        <!-- Recent transaction -->
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Giao dịch hôm nay</h5>
                </div>

                @if ($user->getTodayTransactions()->isEmpty())
                    <h5 class="text-center">Hôm nay chưa có giao dịch nào</h5>
                @else
                    <div class="list-transaction mt-3">
                        <div class="list-group">
                            @foreach ($user->getTodayTransactions() as $transaction)
                                <div class="list-group-item border-0 bg-body-secondary rounded-4">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2"
                                            width="80" alt="User Image">
                                        <div class="d-flex align-items-between justify-content-center flex-column">
                                            <h6>{{ $transaction->category->name }}</h6>
                                            <strong class="text-muted">{{ $transaction->formatted_amount }}</strong>
                                        </div>
                                    </div>
                                    <div class="btn btn-lg btn-outline-primary-color" data-bs-toggle="modal"
                                        data-bs-target="#showTransaction-{{ $transaction->id }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </div>

                                    <!-- Detail transaction modal -->
                                    <div class="modal fade" id="showTransaction-{{ $transaction->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="showTransaction-{{ $transaction->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button"
                                                        class="btn btn-link text-primary-color p-0 text-decoration-none"
                                                        data-bs-="modal" data-bs-toggle="modal">
                                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                                        <span class="fw-bold">Thông tin giao dịch</span>
                                                    </button>
                                                    <button type="button" class="btn btn-link text-primary-color p-0"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editTransaction-{{ $transaction->id }}">
                                                        <i class="fa-solid fa-pen-to-square fs-5"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Transaction form content -->
                                                    <div class="card rounded-3 border-primary-color shadow-none">
                                                        <div class="card-body">
                                                            <div class="transaction-details">
                                                                <div class="d-flex justify-content-start gap-3 pb-3 border-bottom"
                                                                    style="border-bottom-color: var(--primary-color) !important">
                                                                    <img src="{{ asset('images/icon.jpg') }}"
                                                                        class="img-circle elevation-2" width="60"
                                                                        alt="User Image" style="min-width: 80px;">
                                                                    <div>
                                                                        <h4 class="m-0">
                                                                            {{ $transaction->category->name }}
                                                                        </h4>
                                                                        <h6
                                                                            class="m-0 {{ $transaction->groupType->name === 'Khoản chi' ? 'text-danger' : 'text-success' }}">
                                                                            {{ $transaction->formatted_amount }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center gap-3">
                                                                    <div class="p-1" style="min-width: 80px;">
                                                                        <div class="h4 text-center m-0"><i
                                                                                class="fa-solid fa-note-sticky"></i></div>
                                                                    </div>
                                                                    <p class="m-0 text-lg">{{ $transaction->note }}
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center gap-3">
                                                                    <div class="p-1" style="min-width: 80px;">
                                                                        <div class="h4 text-center m-0"><i
                                                                                class="fa-solid fa-calendar"></i></div>
                                                                    </div>
                                                                    <p class="m-0 text-lg">
                                                                        {{ $transaction->formatted_date }}
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center gap-3">
                                                                    <div class="p-1" style="min-width: 80px;">
                                                                        <div class="h4 text-center m-0"><i
                                                                                class="fa-solid fa-wallet"></i></div>
                                                                    </div>
                                                                    <p class="m-0 text-lg">
                                                                        {{ $transaction->wallet->name }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Original Delete Button -->
                                                <div class="modal-footer d-flex align-items-center justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-lg btn-outline-primary-color w-75"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteConfirm-{{ $transaction->id }}">
                                                        Xóa giao dịch
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /. detail transaction modal --}}

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteConfirm-{{ $transaction->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-primary-color fw-bold">Xác nhận
                                                        xóa</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-target="#showTransaction-{{ $transaction->id }}"
                                                        data-bs-toggle="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p class="mb-0">Bạn có chắc chắn muốn xóa giao dịch này?
                                                    </p>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center gap-3">
                                                    <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-lg btn-primary-color text-white">
                                                            Xác nhận
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-lg btn-outline-secondary"
                                                        data-bs-target="#showTransaction-{{ $transaction->id }}"
                                                        data-bs-toggle="modal">Hủy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /. delete confirmation modal --}}

                                    <!-- Edit transaction modal -->
                                    <div class="modal fade" id="editTransaction-{{ $transaction->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="editTransaction-{{ $transaction->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="text-primary-color fw-bold m-0"
                                                        id="editTransaction-{{ $transaction->id }}Label">
                                                        Sửa giao dịch
                                                    </h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-target="#showTransaction-{{ $transaction->id }}"
                                                        data-bs-toggle="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card rounded-3 border-primary-color shadow-none">
                                                        <div class="card-body">
                                                            <form id="formTransaction-update-{{ $transaction->id }}"
                                                                method="POST"
                                                                action="{{ route('transactions.update', $transaction->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                                    <div class="p-1 rounded-2 border border-secondary"
                                                                        style="min-width: 80px;">
                                                                        <h5 class="h5 text-center m-0">
                                                                            {{ Auth::user()->currency }}</h5>
                                                                    </div>
                                                                    <input type="number" name="amount" id="amount"
                                                                        class="form-control form-control-lg shadow-none"
                                                                        value="{{ $transaction->amount_value }}"
                                                                        min="0">
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                                    <img src="{{ asset('images/icon.jpg') }}"
                                                                        class="img-circle elevation-2" width="60"
                                                                        alt="User Image" style="min-width: 80px;">
                                                                    <input type="hidden" name="category_id"
                                                                        id="category_id-{{ $transaction->id }}"
                                                                        value="{{ $transaction->category->id }}">
                                                                    <button type="button"
                                                                        id="categorySelector-{{ $transaction->id }}"
                                                                        class="form-control form-control-lg text-start shadow-none"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#selectCategory-{{ $transaction->id }}">
                                                                        <span
                                                                            id="selectedCategoryText-{{ $transaction->id }}">{{ $transaction->category->name }}</span>
                                                                    </button>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                                    <div class="p-1" style="min-width: 80px;">
                                                                        <div class="h4 text-center m-0"><i
                                                                                class="fa-solid fa-note-sticky"></i></div>
                                                                    </div>
                                                                    <textarea name="note" id="note" class="form-control form-control-lg shadow-none" rows="2"
                                                                        placeholder="Ghi chú">{{ $transaction->note }}</textarea>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                                    <div class="p-1" style="min-width: 80px;">
                                                                        <div class="h4 text-center m-0"><i
                                                                                class="fa-solid fa-calendar"></i></div>
                                                                    </div>
                                                                    <input type="date" name="date" id="date"
                                                                        class="form-select form-select-lg shadow-none"
                                                                        value="{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}">
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                                                    <div class="p-1" style="min-width: 80px;">
                                                                        <div class="h4 text-center m-0"><i
                                                                                class="fa-solid fa-wallet"></i></div>
                                                                    </div>
                                                                    <select name="wallet_id" id="wallet_id"
                                                                        class="form-select form-select-lg shadow-none">
                                                                        @foreach ($user->wallets as $wallet)
                                                                            @if ($wallet->id == $transaction->wallet_id)
                                                                                <option value="{{ $wallet->id }}"
                                                                                    selected>
                                                                                    {{ $wallet->name }}</option>
                                                                            @else
                                                                                <option value="{{ $wallet->id }}">
                                                                                    {{ $wallet->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-lg btn-outline-secondary"
                                                        data-bs-target="#showTransaction-{{ $transaction->id }}"
                                                        data-bs-toggle="modal">Hủy</button>
                                                    <button type="button" class="btn btn-lg btn-primary-color"
                                                        id="updateBtn-{{ $transaction->id }}">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /. edit transaction modal --}}

                                    <!-- Category selection modal -->
                                    <div class="modal fade" id="selectCategory-{{ $transaction->id }}"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="selectCategory-{{ $transaction->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="text-primary-color fw-bold fs-5 m-0"
                                                        id="editTransaction-{{ $transaction->id }}Label">Chọn nhóm</h1>
                                                    <button type="button" class="btn-close"
                                                        data-bs-target="#editTransaction-{{ $transaction->id }}"
                                                        data-bs-toggle="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Tabs -->
                                                    <div class="tab-navigation-wrapper">
                                                        <ul class="nav nav-pills nav-fill mb-3 bg-body-secondary rounded-3 p-2"
                                                            id="categoryTabs" role="tablist">
                                                            @foreach ($groupTypes as $groupType)
                                                                <li class="nav-item" role="presentation">
                                                                    <button
                                                                        class="nav-link {{ $groupType->group_type_id == $transaction->category->group_type_id ? 'active' : '' }}"
                                                                        id="tab-{{ $groupType->group_type_id }}"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#content-{{ $groupType->group_type_id }}"
                                                                        type="button" role="tab">
                                                                        {{ $groupType->name }}
                                                                    </button>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <!-- Tab Contents -->
                                                    <div class="tab-content">
                                                        @foreach ($groupTypes as $groupType)
                                                            <div class="tab-pane fade {{ $groupType->group_type_id == $transaction->category->group_type_id ? 'show active' : '' }}"
                                                                id="content-{{ $groupType->group_type_id }}"
                                                                role="tabpanel">
                                                                <div class="row g-3">
                                                                    @foreach ($categories->where('group_type_id', $groupType->group_type_id) as $category)
                                                                        <div class="col-md-6">
                                                                            <button type="button"
                                                                                class="category-item btn btn-outline-primary-color w-100 text-start p-3 {{ $category->id == $transaction->category->id ? 'active' : '' }}"
                                                                                data-category-id="{{ $category->id }}"
                                                                                data-category-name="{{ $category->name }}"
                                                                                data-bs-target="#editTransaction-{{ $transaction->id }}"
                                                                                data-bs-toggle="modal">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-3">
                                                                                    <i
                                                                                        class="text-dark fas fa-envelope fs-4"></i>
                                                                                    <span>{{ $category->name }}</span>
                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /. category selection modal --}}
                                </div>
                                @if (!$loop->last)
                                    <div class="my-2"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- /.recent transaction -->

        <x-transaction-modal :user="$user" :group-types="$groupTypes" :categories="$categories" />
    </div>
@endsection

@push('js')
    <script>
        // Wait for DOM to be fully loaded
        $(document).ready(() => {
            // Constants and Helper Functions
            const SELECTORS = {
                tabItem: '.tab-item',
                weeklyChart: '#weekly-expense-chart',
                monthlyChart: '#monthly-expense-chart',
                tabContentTitle: '#tab-content-title',
                reportPillsTab: '#report-pills-tab button',
                categoryPillsTab: '#category-pills-tab button'
            };

            const TAB_MAPPINGS = {
                '#report-pills-week': {
                    show: '#category-pills-week-tab',
                    title: 'Báo cáo tuần này'
                },
                '#report-pills-month': {
                    show: '#category-pills-month-tab',
                    title: 'Báo cáo tháng này'
                },
                '#category-pills-week': {
                    show: '#report-pills-week-tab',
                    title: 'Báo cáo tuần này'
                },
                '#category-pills-month': {
                    show: '#report-pills-month-tab',
                    title: 'Báo cáo tháng này'
                }
            };

            // Initialize Charts
            const initializeChart = (selector, data, label) => {
                const ctx = document.createElement('canvas');
                $(selector).append(ctx);

                return new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data),
                        datasets: [{
                            label,
                            data: Object.values(data),
                            backgroundColor: '#6f42c1'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            };

            // Tab Management
            const updateTabContentTitle = (targetId) => {
                const mapping = TAB_MAPPINGS[targetId];
                if (mapping) {
                    $(mapping.show).tab('show');
                    $(SELECTORS.tabContentTitle).text(mapping.title);
                }
            };

            // Category Management
            const handleCategorySelection = function() {
                const $this = $(this);
                const $modal = $this.closest('.modal');
                const $tabContent = $this.closest('.tab-content');

                $tabContent.find('.category-item').removeClass('active');
                $this.addClass('active');

                const categoryId = $this.data('category-id');
                const categoryName = $this.data('category-name');
                const transactionId = $modal.attr('id').split('-')[1];

                $(`#category_id-${transactionId}`).val(categoryId);
                $(`#selectedCategoryText-${transactionId}`).text(categoryName);
                $modal.modal('hide');
            };

            // Event Listeners
            $('[id^=updateBtn-]').on('click', function(e) {
                const transactionId = $(this).attr('id').split('-')[1];
                const $form = $(`#formTransaction-update-${transactionId}`);

                // Thêm event listeners để xóa validation errors
                $form.find('input[name="amount"]').on('input', function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().next('.invalid-feedback').remove();
                });

                $form.find('input[name="date"]').on('change', function() {
                    $(this).removeClass('is-invalid');
                    $(this).parent().next('.invalid-feedback').remove();
                });

                function validateEditForm() {
                    const amountElement = $form.find('input[name="amount"]');
                    const dateElement = $form.find('input[name="date"]');

                    // Reset validation messages
                    $('.invalid-feedback').remove();
                    $('.is-invalid').removeClass('is-invalid');

                    let isValid = true;

                    // Validate amount
                    if (Number(amountElement.val()) <= 0) {
                        amountElement.addClass('is-invalid');
                        amountElement.parent().after(
                            '<div class="invalid-feedback d-block text-lg" style="margin-left: calc(80px + 1rem);">Số tiền phải lớn hơn 0</div>'
                        );
                        isValid = false;
                    }

                    // Validate date
                    const inputDate = new Date(dateElement.val());
                    const today = new Date();

                    // Reset time parts for both dates to compare only dates
                    inputDate.setHours(0, 0, 0, 0);
                    today.setHours(0, 0, 0, 0);

                    // Convert both to timestamps for reliable comparison
                    if (inputDate.getTime() > today.getTime()) {
                        dateElement.addClass('is-invalid');
                        dateElement.parent().after(
                            '<div class="invalid-feedback d-block text-lg" style="margin-left: calc(80px + 1rem);">Ngày không được lớn hơn ngày hiện tại</div>'
                        );
                        isValid = false;
                    }

                    return isValid;
                }

                if (validateEditForm()) {
                    $form.submit();
                }
            });

            $(SELECTORS.tabItem).on('click', function() {
                $(SELECTORS.tabItem).removeClass('active');
                $(this).addClass('active');
            });

            [SELECTORS.reportPillsTab, SELECTORS.categoryPillsTab].forEach(selector => {
                $(selector).on('shown.bs.tab', (e) => {
                    updateTabContentTitle($(e.target).attr('data-bs-target'));
                });
            });

            $('.category-item').on('click', handleCategorySelection);

            $('[id^=selectCategory-]').on('show.bs.modal', function() {
                const transactionId = $(this).attr('id').split('-')[1];
                const selectedCategoryId = $(`#category_id-${transactionId}`).val();

                $(this).find('.category-item').removeClass('active');

                if (selectedCategoryId) {
                    $(this).find(`.category-item[data-category-id="${selectedCategoryId}"]`).addClass(
                        'active');
                }
            });

            // Get data from Controller
            const weeklyExpenses = @json($user->getWeeklyExpenses());
            const monthlyExpenses = @json($user->getMonthlyExpenses());

            // Initialize Charts
            initializeChart(SELECTORS.weeklyChart, weeklyExpenses, 'Chi tiêu hàng tuần');
            initializeChart(SELECTORS.monthlyChart, monthlyExpenses, 'Chi tiêu hàng tháng');

            const originalValues = {};

            $('[id^=editTransaction-]').each(function() {
                const transactionId = $(this).attr('id').split('-')[1];
                const $form = $(`#formTransaction-update-${transactionId}`);

                // Store original values when modal opens
                $(this).on('show.bs.modal', function() {
                    originalValues[transactionId] = {
                        amount: $form.find('input[name="amount"]').val(),
                        categoryId: $form.find('input[name="category_id"]').val(),
                        categoryName: $(`#selectedCategoryText-${transactionId}`).text(),
                        note: $form.find('textarea[name="note"]').val(),
                        date: $form.find('input[name="date"]').val(),
                        walletId: $form.find('select[name="wallet_id"]').val()
                    };
                });

                // Reset form on close/cancel
                function resetEditForm() {
                    const values = originalValues[transactionId];

                    // Reset all form values
                    $form.find('input[name="amount"]').val(values.amount);
                    $form.find('input[name="category_id"]').val(values.categoryId);
                    $(`#selectedCategoryText-${transactionId}`).text(values.categoryName);
                    $form.find('textarea[name="note"]').val(values.note);
                    $form.find('input[name="date"]').val(values.date);
                    $form.find('select[name="wallet_id"]').val(values.walletId);

                    // Reset validation states
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                }

                // Bind reset to modal hidden event
                $(this).on('hidden.bs.modal', resetEditForm);

                // Bind reset to cancel button
                $(this).find('.btn-outline-secondary, .btn-close').on('click', resetEditForm);
            });
        });
    </script>
@endpush
