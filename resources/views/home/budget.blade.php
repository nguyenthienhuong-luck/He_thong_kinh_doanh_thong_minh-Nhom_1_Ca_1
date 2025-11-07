@extends('layouts.master')

@section('title', 'Ngân sách')

@push('css')
    <style>
        /* Custom styles for the switch */
        .custom-switch .form-check-input {
            width: 3em;
            height: 1.5em;
            background-color: #ccc;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
        }

        .custom-switch .form-check-input:checked {
            background-color: #6c63ff;
            /* Màu tím khi được chọn */
        }

        .custom-switch .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
            /* Hiệu ứng khi focus */
        }
    </style>
@endpush

@section('content')
    <section class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ngân sách đang áp dụng</h1>
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
    @foreach ($currentBudgets as $budget)
        <div class="card rounded-3 border-primary-color">
            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2" width="60"
                                alt="User Image">
                            <h5 class="h5 mb-0">{{ $budget->category->name }}</h5>
                        </div>
                        <div class="d-flex align-items-end justify-content-center flex-column gap-1">
                            <h5 class="h5 mb-0 text-danger">{{ $budget->formatted_amount }}</h5>
                            <h6 class="h6 mb-0 text-muted fw-normal">
                                Còn lại {{ $budget->formatted_remaining_value }}
                            </h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="progress rounded-5 w-50 border-primary-color" role="progressbar"
                            aria-label="Budget progress" aria-valuenow="{{ $budget->progress }}" aria-valuemin="0"
                            aria-valuemax="100">
                            <div class="progress-bar bg-primary-color" style="width: {{ $budget->progress }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Button trigger modal -->
    <button type="button"
        class="btn btn-primary-color text-white rounded-circle d-flex align-items-center justify-content-center"
        data-bs-toggle="modal" data-bs-target="#addBudget"
        style="position: fixed; bottom: 30px; right: 30px; z-index: 999; width: 60px; height: 60px;">
        <i class="fa-solid fa-plus" style="font-size: 24px;"></i>
    </button>

    <!-- Add budget -->
    <div class="modal fade" id="addBudget" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addBudgetLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom-color: var(--primary-color) !important">
                    <button type="button" class="btn p-0 m-0 text-muted" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ</button>
                    <h1 class="text-primary-color fw-bold fs-5 m-0" id="addBudgetLabel">Thêm ngân sách</h1>
                    <div></div>
                </div>
                <div class="modal-body">
                    <div class="card rounded-3 border-primary-color shadow-none">
                        <div class="card-body">
                            <form id="formTransaction" method="POST" action="{{ route('budgets.store') }}">
                                @csrf
                                <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2" width="60"
                                        alt="User Image" style="min-width: 80px;">
                                    <input type="hidden" name="category_id" id="category_id" value="default">
                                    <button type="button" id="categorySelector"
                                        class="form-control form-control-lg text-start shadow-none" data-bs-toggle="modal"
                                        data-bs-target="#selectCategory">
                                        <span id="selectedCategoryText">Chọn nhóm</span>
                                    </button>
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <div class="p-1 rounded-2 border border-secondary" style="min-width: 80px;">
                                        <h5 class="h5 text-center m-0">{{ Auth::user()->currency }}</h5>
                                    </div>
                                    <input type="number" name="amount" id="amount" class="form-control form-control-lg"
                                        shadow-none value="0" min="0"
                                        onfocus="if(this.value=='0'){this.value=''}"
                                        onblur="if(this.value==''){this.value='0'}">
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <div class="p-1" style="min-width: 80px;">
                                        <div class="h4 text-center m-0"><i class="fa-solid fa-calendar"></i></div>
                                    </div>
                                    <input type="hidden" name="start_date" id="start_date">
                                    <input type="hidden" name="end_date" id="end_date">
                                    <select name="date" id="date" class="form-select form-select-lg shadow-none">
                                        <option value="" disabled selected>Chọn khoảng thời gian</option>
                                        <option value="week"
                                            data-start="{{ Carbon\Carbon::now()->startOfWeek()->format('Y-m-d') }}"
                                            data-end="{{ Carbon\Carbon::now()->endOfWeek()->format('Y-m-d') }}">
                                            Tuần này ({{ Carbon\Carbon::now()->startOfWeek()->format('d/m') }} -
                                            {{ Carbon\Carbon::now()->endOfWeek()->format('d/m') }})
                                        </option>
                                        <option value="month"
                                            data-start="{{ Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}"
                                            data-end="{{ Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}">
                                            Tháng này ({{ Carbon\Carbon::now()->startOfMonth()->format('d/m') }} -
                                            {{ Carbon\Carbon::now()->endOfMonth()->format('d/m') }})
                                        </option>
                                        <option value="quarter"
                                            data-start="{{ Carbon\Carbon::now()->startOfQuarter()->format('Y-m-d') }}"
                                            data-end="{{ Carbon\Carbon::now()->endOfQuarter()->format('Y-m-d') }}">
                                            Quý này ({{ Carbon\Carbon::now()->startOfQuarter()->format('d/m') }} -
                                            {{ Carbon\Carbon::now()->endOfQuarter()->format('d/m') }})
                                        </option>
                                        <option value="year"
                                            data-start="{{ Carbon\Carbon::now()->startOfYear()->format('Y-m-d') }}"
                                            data-end="{{ Carbon\Carbon::now()->endOfYear()->format('Y-m-d') }}">
                                            Năm nay ({{ Carbon\Carbon::now()->startOfYear()->format('d/m') }} -
                                            {{ Carbon\Carbon::now()->endOfYear()->format('d/m') }})
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                                    <div class="p-1" style="min-width: 80px;">
                                        <div class="h4 text-center m-0"><i class="fa-solid fa-wallet"></i></div>
                                    </div>
                                    <select name="wallet_id" id="wallet_id"
                                        class="form-select form-select-lg shadow-none">
                                        <option default selected value="default">Chọn ví</option>
                                        @foreach ($user->wallets as $wallet)
                                            <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card rounded-3 border-primary-color shadow-none">
                        <div class="d-flex align-items-center justify-content-between p-3">
                            <div>
                                <h5 class="h5 m-0 text-primary-color">Lặp lại ngân sách này</h5>
                                <h5 class="h5 m-0 text-muted">Ngân sách được tự động lặp lại ở kỳ hạn tiếp theo</h5>
                            </div>
                            <div class="form-check form-switch custom-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" id="saveBudgetBtn" class="btn btn-primary-color">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /. add budget -->

    <!-- Second modal - Category selection -->
    <div class="modal fade" id="selectCategory" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="selectCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- Category selection content -->
                <div class="modal-header">
                    <h1 class="text-primary-color fw-bold fs-5 m-0" id="addBudgetLabel">Chọn nhóm</h1>
                    <button type="button" class="btn-close" data-bs-target="#addBudget" data-bs-toggle="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tabs -->
                    <div class="tab-navigation-wrapper">
                        <ul class="nav nav-pills nav-fill mb-3 bg-body-secondary rounded-3 p-2" id="categoryTabs"
                            role="tablist">
                <ul class="nav nav-pills nav-fill mb-3 bg-body-secondary rounded-3 p-2" id="categoryTabs" role="tablist">
                    @foreach ($groupTypes->where('name', 'Khoản chi') as $groupType)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
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
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="content-{{ $groupType->group_type_id }}" role="tabpanel">
                                <div class="row g-3">
                                    @foreach ($categories->where('group_type_id', $groupType->group_type_id) as $category)
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="category-item btn btn-outline-primary-color w-100 text-start p-3"
                                                data-category-id="{{ $category->id }}"
                                                data-category-name="{{ $category->name }}" data-bs-target="#addBudget"
                                                data-bs-toggle="modal">
                                                <div class="d-flex align-items-center gap-3">
                                                    @if ($category->icon)
                                                        {!! \App\Helpers\IconHelper::addClasses($category->icon, 'text-dark fs-4') !!}
                                                    @else
                                                        <i class="text-dark fas fa-envelope fs-4"></i>
                                                    @endif
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
    <!-- /. category selection modal -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const $form = $('#formTransaction');
            const $saveBtn = $('#saveBudgetBtn');
            const $repeatSwitch = $('#flexSwitchCheckDefault');

            // Handle date change
            $('#date').on('change', function() {
                const selectedOption = $(this).find('option:selected');
                $('#start_date').val(selectedOption.data('start'));
                $('#end_date').val(selectedOption.data('end'));
            });

            $saveBtn.on('click', function() {
                // Reset validation states
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Get form values
                const category = $('#category_id').val();
                const amount = $('#amount').val();
                const date = $('#date').val();
                const wallet = $('#wallet').val();

                let isValid = true;

                // Validate category
                if (category === 'default') {
                    $('#categorySelector').addClass('is-invalid');
                    $('#categorySelector').parent().addClass("mb-0").removeClass("mb-3");
                    $('#categorySelector').parent().after(
                        '<div class="invalid-feedback d-block text-lg mb-3" style="margin-left: calc(80px + 1rem); margin-top: -16px;">Vui lòng chọn nhóm</div>'
                    );
                    isValid = false;
                }

                // Validate amount
                if (!amount || Number(amount) <= 0) {
                    $('#amount').addClass('is-invalid');
                    $('#amount').parent().addClass("mb-0").removeClass("mb-3");
                    $('#amount').parent().after(
                        '<div class="invalid-feedback d-block text-lg mb-3" style="margin-left: calc(80px + 1rem)">Số tiền phải lớn hơn 0</div>'
                    );
                    isValid = false;
                }

                // Validate date
                if (!date) {
                    $('#date').addClass('is-invalid');
                    $('#date').parent().addClass("mb-0").removeClass("mb-3");
                    $('#date').parent().after(
                        '<div class="invalid-feedback d-block text-lg mb-3" style="margin-left: calc(80px + 1rem)">Vui lòng chọn khoảng thời gian</div>'
                    );
                    isValid = false;
                }

                // Validate wallet
                if (wallet === 'default') {
                    $('#wallet').addClass('is-invalid');
                    $('#wallet').parent().addClass("mb-0").removeClass("mb-3");
                    $('#wallet').parent().after(
                        '<div class="invalid-feedback d-block text-lg" style="margin-left: calc(80px + 1rem)">Vui lòng chọn ví</div>'
                    );
                    isValid = false;
                }

                if (isValid) {
                    // Add repeat flag to form
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'repeat_budget',
                        value: $repeatSwitch.is(':checked') ? '1' :
                            '0' // Convert to string '1' or '0'
                    }).appendTo($form);

                    // Submit form
                    $form.submit();
                }
            });

            // Clear validation on input change
            $('input, select').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).parent().next('.invalid-feedback').remove();
            });
            $('.category-item').click(function() {
                $('.category-item').removeClass('active');
                $(this).addClass('active');

                const categoryId = $(this).data('category-id');
                const categoryName = $(this).data('category-name');

                $('#category_id').val(categoryId);
                $('#selectedCategoryText').text(categoryName);

                $('#selectCategory').modal('hide');
            });

            // When opening category modal
            $('#selectCategory').on('show.bs.modal', function() {
                const selectedCategoryId = $('#category_id').val();
                $('.category-item').removeClass('active');
                if (selectedCategoryId && selectedCategoryId !== 'default') {
                    $(`.category-item[data-category-id="${selectedCategoryId}"]`).addClass('active');
                }
            });
        });
    </script>
@endpush
