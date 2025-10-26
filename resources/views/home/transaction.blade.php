@extends('layouts.master')

@section('title', 'Sổ giao dịch')

@section('content')
    <section class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sổ Giao Dịch</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form id="filterForm" method="GET" action="{{ route('home.transaction') }}">
                    <select class="form-select form-select-lg border-primary-color" name="wallet_id" id="wallet_id"
                        style="width: 250px;" aria-label="Default select example">
                        <option value="total" selected>Tất cả</option>
                        @foreach ($user->wallets as $wallet)
                            <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                        @endforeach
                    </select>
                </form>
                <ul class="nav nav-underline list-transaction nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark active" id="pills-previous-month-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-previous-month" type="button" role="tab"
                            aria-controls="pills-previous-month" aria-selected="false">Tháng trước</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="pills-current-month-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-current-month" type="button" role="tab"
                            aria-controls="pills-current-month" aria-selected="false">Tháng này</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-previous-month" role="tabpanel"
                        aria-labelledby="pills-previous-month-tab" tabindex="0">
                        {{-- Opening Balance and Closing Balance --}}
                        <div class="card rounded-3 border-primary-color">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư đầu</h5>
                                    <h5 id="previousMonthOpeningBalance">
                                        {{ $previousMonthBalance->formatted_opening_balance }}</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư cuối cùng</h5>
                                    <h5 id="previousMonthClosingBalance">
                                        {{ $previousMonthBalance->formatted_closing_balance }}</h5>
                                </div>
                                <div class="d-flex justify-content-center align-items-end flex-column">
                                    <div class="line mb-2" style="width: 200px; height: 2px;"></div>
                                    <h5 id="previousMonthTotalBalance">{{ $previousMonthBalance->balance }}</h5>
                                </div>
                                <div class="text-center">
                                    <a href="#" class="text-primary-color fw-bold">Xem báo cáo cho giai đoạn này</a>
                                </div>
                            </div>
                        </div>
                        {{-- /. opening balance and closing balance --}}

                        {{-- List transaction for previous month --}}
                        <div id="previousMonthTransactionsContainer">
                            @foreach ($previousMonthTransactions as $each)
                                <div class="card rounded-3 border-primary-color">
                                    <div class="card-header border-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-end justify-content-center gap-2">
                                                <h5 class="h5 mb-0">{{ $each->day }}</h5>
                                                <span class="text-muted text-sm fw-medium">{{ $each->detailDate }}</span>
                                            </div>
                                            <h5
                                                class="h5 mb-0 {{ $each->totalAmount < 0 ? 'text-danger' : 'text-success' }}">
                                                {{ $each->formatted_total_amount }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-column gap-2">
                                            @foreach ($each->listTransactions as $transaction)
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                                        <img src="{{ asset('images/icon.jpg') }}"
                                                            class="img-circle elevation-2" width="60" alt="User Image">
                                                        <h5 class="h5 mb-0">{{ $transaction->category->name }}</h5>
                                                    </div>
                                                    <h5
                                                        class="h5 mb-0 {{ $transaction->groupType->name === 'Khoản chi' ? 'text-danger' : 'text-success' }}">
                                                        {{ $transaction->formatted_amount }}
                                                    </h5>
                                                </div>
                                                @if (!$loop->last)
                                                    <div class="line"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- /.list transaction --}}
                    </div>
                    <div class="tab-pane fade" id="pills-current-month" role="tabpanel"
                        aria-labelledby="pills-current-month-tab" tabindex="0">
                        {{-- Opening Balance and Closing Balance --}}
                        <div class="card rounded-3 border-primary-color">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư đầu</h5>
                                    <h5 id="currentMonthOpeningBalance">
                                        {{ $currentMonthBalance->formatted_opening_balance }}</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Số dư cuối cùng</h5>
                                    <h5 id="currentMonthClosingBalance">
                                        {{ $currentMonthBalance->formatted_closing_balance }}</h5>
                                </div>
                                <div class="d-flex justify-content-center align-items-end flex-column">
                                    <div class="line mb-2" style="width: 200px; height: 2px;"></div>
                                    <h5 id="currentMonthTotalBalance">{{ $currentMonthBalance->balance }}</h5>
                                </div>
                                <div class="text-center">
                                    <a href="#" class="text-primary-color fw-bold">Xem báo cáo cho giai đoạn này</a>
                                </div>
                            </div>
                        </div>
                        {{-- /. opening balance and closing balance --}}

                        {{-- List transaction for current month --}}
                        <div id="currentMonthTransactionsContainer">
                            @foreach ($currentMonthTransactions as $each)
                                <div class="card rounded-3 border-primary-color">
                                    <div class="card-header border-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-end justify-content-center gap-2">
                                                <h5 class="h5 mb-0">{{ $each->day }}</h5>
                                                <span class="text-muted text-sm fw-medium">{{ $each->detailDate }}</span>
                                            </div>
                                            <h5
                                                class="h5 mb-0 {{ $each->totalAmount < 0 ? 'text-danger' : 'text-success' }}">
                                                {{ $each->formatted_total_amount }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-column gap-2">
                                            @foreach ($each->listTransactions as $transaction)
                                                <button class="btn d-flex align-items-center justify-content-between"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#showTransaction-{{ $transaction->id }}">
                                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                                        <img src="{{ asset('images/icon.jpg') }}"
                                                            class="img-circle elevation-2" width="60"
                                                            alt="User Image">
                                                        <h5 class="h5 mb-0">{{ $transaction->category->name }}</h5>
                                                    </div>
                                                    <h5
                                                        class="h5 mb-0 {{ $transaction->groupType->name === 'Khoản chi' ? 'text-danger' : 'text-success' }}">
                                                        {{ $transaction->formatted_amount }}
                                                    </h5>
                                                </button>
                                                @if (!$loop->last)
                                                    <div class="line"></div>
                                                @endif


                                                <!-- Detail transaction modal -->
                                                <div class="modal fade" id="showTransaction-{{ $transaction->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="showTransaction-{{ $transaction->id }}Label"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button"
                                                                    class="btn btn-link text-primary-color p-0 text-decoration-none"
                                                                    data-bs-="modal" data-bs-toggle="modal">
                                                                    <i class="fa-solid fa-arrow-left me-2"></i>
                                                                    <span class="fw-bold">Thông tin giao dịch</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Transaction form content -->
                                                                <div
                                                                    class="card rounded-3 border-primary-color shadow-none">
                                                                    <div class="card-body">
                                                                        <div class="transaction-details">
                                                                            <div class="d-flex justify-content-start gap-3 pb-3 border-bottom"
                                                                                style="border-bottom-color: var(--primary-color) !important">
                                                                                <img src="{{ asset('images/icon.jpg') }}"
                                                                                    class="img-circle elevation-2"
                                                                                    width="60" alt="User Image"
                                                                                    style="min-width: 80px;">
                                                                                <div>
                                                                                    <h4 class="m-0">
                                                                                        {{ $transaction->category->name }}
                                                                                    </h4>
                                                                                    <h6
                                                                                        class="m-0 {{ $transaction->groupType->name === 'Khoản chi' ? 'text-danger' : 'text-success' }}">
                                                                                        {{ $transaction->formatted_amount }}
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-start align-items-center gap-3">
                                                                                <div class="p-1"
                                                                                    style="min-width: 80px;">
                                                                                    <div class="h4 text-center m-0"><i
                                                                                            class="fa-solid fa-note-sticky"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="m-0 text-lg">
                                                                                    {{ $transaction->note }}
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-start align-items-center gap-3">
                                                                                <div class="p-1"
                                                                                    style="min-width: 80px;">
                                                                                    <div class="h4 text-center m-0"><i
                                                                                            class="fa-solid fa-calendar"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="m-0 text-lg">
                                                                                    {{ $transaction->formatted_date }}
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-start align-items-center gap-3">
                                                                                <div class="p-1"
                                                                                    style="min-width: 80px;">
                                                                                    <div class="h4 text-center m-0"><i
                                                                                            class="fa-solid fa-wallet"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="m-0 text-lg">
                                                                                    {{ $transaction->wallet->name }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- /. detail transaction modal --}}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- /.list transaction --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-transaction-modal :user="$user" :group-types="$groupTypes" :categories="$categories" />
    <!-- /.second modal -->
@endsection

@push('js')
    <script>
        // Constants
        const CONFIG = {
            DEFAULT_USER_IMAGE: '{{ asset('images/icon.jpg') }}',
            EXPENSE_TYPE: 'Khoản chi',
            ENDPOINTS: {
                TRANSACTIONS: '{{ route('home.transaction') }}'
            },
            SELECTORS: {
                WALLET: '#wallet_id',
                LOADER: '#loader',
                CONTAINERS: {
                    PREV_MONTH: '#previousMonthTransactionsContainer',
                    CURR_MONTH: '#currentMonthTransactionsContainer'
                },
                BALANCES: {
                    PREV_MONTH: {
                        OPENING: '#previousMonthOpeningBalance',
                        CLOSING: '#previousMonthClosingBalance',
                        TOTAL: '#previousMonthTotalBalance'
                    },
                    CURR_MONTH: {
                        OPENING: '#currentMonthOpeningBalance',
                        CLOSING: '#currentMonthClosingBalance',
                        TOTAL: '#currentMonthTotalBalance'
                    }
                }
            }
        };
        // HTML Template generators
        class TransactionTemplates {
            static createTransactionCard(transaction, index, array) {
                const isLastItem = index === array.length - 1;
                const colorClass = transaction.category.group_type.name === CONFIG.EXPENSE_TYPE ?
                    'text-danger' : 'text-success';

                return `
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <img src="${CONFIG.DEFAULT_USER_IMAGE}" class="img-circle elevation-2" width="60" alt="User Image">
                    <h5 class="h5 mb-0">${transaction.category.name}</h5>
                </div>
                <h5 class="h5 mb-0 ${colorClass}">${transaction.formatted_balance}</h5>
            </div>
            ${isLastItem ? '' : '<div class="line"></div>'}`;
            }

            static createDayCard(dayData) {
                const colorClass = dayData.totalAmount < 0 ? 'text-danger' : 'text-success';
                const transactionCards = dayData.listTransactions
                    .map((t, i, arr) => TransactionTemplates.createTransactionCard(t, i, arr))
                    .join('');

                return `
            <div class="card rounded-3 border-primary-color">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-end justify-content-center gap-2">
                            <h5 class="h5 mb-0">${dayData.day}</h5>
                            <span class="text-muted text-sm fw-medium">${dayData.detailDate}</span>
                        </div>
                        <h5 class="h5 mb-0 ${colorClass}">${dayData.formatted_total_amount}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-2">
                        ${transactionCards}
                    </div>
                </div>
            </div>`;
            }
        }

        // Transaction data manager
        class TransactionManager {
            static async fetchTransactions(walletId) {
                const loader = $(CONFIG.SELECTORS.LOADER);
                loader.show();

                try {
                    const response = await $.ajax({
                        url: CONFIG.ENDPOINTS.TRANSACTIONS,
                        type: 'GET',
                        data: {
                            wallet_id: walletId
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                    this.updateUI(response);
                } catch (error) {
                    console.error('Transaction fetch failed:', error);
                    showToast("Đã có lỗi xảy ra, xin vui lòng thử lại", "danger");
                } finally {
                    loader.hide();
                }
            }

            static updateUI(response) {
                // Update transactions
                this.renderTransactions(CONFIG.SELECTORS.CONTAINERS.PREV_MONTH, response.previousMonthTransactions);
                this.renderTransactions(CONFIG.SELECTORS.CONTAINERS.CURR_MONTH, response.currentMonthTransactions);

                // Update balances
                this.updateBalances('PREV_MONTH', response.previousMonthBalance);
                this.updateBalances('CURR_MONTH', response.currentMonthBalance);
            }

            static renderTransactions(containerId, transactions) {
                const container = $(containerId);
                const html = transactions
                    .map(data => TransactionTemplates.createDayCard(data))
                    .join('');
                container.html(html);
            }


            static updateBalances(period, balanceData) {
                const selectors = CONFIG.SELECTORS.BALANCES[period];
                $(selectors.OPENING).text(balanceData.formatted_opening_balance);
                $(selectors.CLOSING).text(balanceData.formatted_closing_balance);
                $(selectors.TOTAL).text(balanceData.balance);
            }
        }

        // Initialize application
        $(document).ready(function() {
            // Check for session messages
            const message = '{{ session('message') }}';
            const type = '{{ session('type') }}';

            if (message && type) {
                showToast(message, type);
            }

            $('.category-item').click(function() {
                // Remove highlight from all categories
                $('.category-item').removeClass('active');

                // Add highlight to selected category
                $(this).addClass('active');

                const categoryId = $(this).data('category-id');
                const categoryName = $(this).data('category-name');

                // Update hidden input and button text in first modal
                $('#category_id').val(categoryId);
                $('#selectedCategoryText').text(categoryName);

                // Close category selection modal
                $('#selectCategory').modal('hide');
            });

            // When opening category modal
            $('#selectCategory').on('show.bs.modal', function() {
                const selectedCategoryId = $('#category_id').val();

                // Remove all highlights first
                $('.category-item').removeClass('active');

                // Add highlight to previously selected category if exists
                if (selectedCategoryId) {
                    $(`.category-item[data-category-id="${selectedCategoryId}"]`).addClass('active');
                }
            });

            $(CONFIG.SELECTORS.WALLET).change(function() {
                TransactionManager.fetchTransactions($(this).val());
            });
        });
    </script>
@endpush
