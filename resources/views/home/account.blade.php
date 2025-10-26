@extends('layouts.master')

@section('title', 'Tài khoản')

@section('content')
    <div class="container-fluid">
        <div class="user-panel d-flex align-items-center justify-content-start gap-3 mb-3">
            <img src="{{ Auth::user()->gender == 0 ? asset('images/default-avatar-male.svg') : asset('images/default-avatar-female.svg') }}"
                class="img-circle object-fit-cover" style="width: 150px !important;" alt="User Image">
            <div class="user-info">
                <h4 class="h2 mb-1 text-dark">{{ Auth::user()->name }}</h4>
                <h5 class="h3 mb-0 text-muted">{{ Auth::user()->email }}</h5>
            </div>
        </div>
        <nav class="list-feature-account px-5">
            <ul class="list-group flex-column gap-3">
                <a class="list-group-item text-dark text-lg text-medium" href="{{ route('accounts.index') }}">
                    <i style="width: 25px;" class="mr-1 fas fa-user-cog"></i>
                    Quản lý tài khoản
                </a>
                <a href="#" type="button" class="list-group-item text-dark text-lg text-medium"
                    data-bs-toggle="modal" data-bs-target="#walletsModal">
                    <i style="width: 25px;" class="mr-1 fas fa-wallet"></i>
                    Ví của tôi
                </a>

                <x-wallet-modal :user="$user" />

                <a class="list-group-item text-dark text-lg text-medium" href="{{ route('bank-branches.index') }}">
                    <i style="width: 25px;" class="mr-1 fas fa-location-crosshairs"></i>
                    Tìm kiếm ngân hàng
                </a>

                @if(Auth::user()->isPremium == 1)
                @else
                <a href="#" type="button" class="list-group-item text-dark text-lg text-medium"
                    data-bs-toggle="modal" data-bs-target="#upgradeAccount">
                    <i style="width: 25px;" class="mr-1 fas fa-star"></i>
                    Nâng cấp tài khoản
                </a>

                <!-- Modal Nâng Cấp Tài Khoản -->
                <div class="modal fade" id="upgradeAccount" tabindex="-1" aria-labelledby="upgradeAccountLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Header của Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="upgradeAccountLabel">Nâng Cấp Tài Khoản</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Nội dung của Modal -->
                            <div class="modal-body">
                                <p>
                                    Bạn đang sử dụng tài khoản <strong>thường</strong>.
                                    Hãy nâng cấp lên tài khoản <strong>Premium</strong> để sử dụng các tính năng đặc biệt:
                                </p>
                                <ul>
                                    <li><strong>Chatbot thông minh:</strong> Giải đáp nhanh chóng và chính xác.</li>
                                    <li><strong>Tìm kiếm ngân hàng:</strong> Xem thông tin và vị trí ngân hàng gần nhất.
                                    </li>
                                </ul>

                                <p class="text-warning">
                                    <strong>Lưu ý:</strong> Nếu bạn là sinh viên, bạn sẽ được giảm giá 20%.
                                    Để nhận được ưu đãi này, hãy xác minh trạng thái sinh viên của bạn tại mục <a
                                        href="/account-settings" class="text-primary"><strong>Quản lý tài
                                            khoản</strong></a>.
                                </p>
                                <p class="text-danger">
                                    <strong>Giá: 60,000 VND/tháng</strong>
                                </p>
                                <p class="text-success">
                                    Giá sau khi giảm cho sinh viên: <strong>48,000 VND/tháng</strong>.
                                </p>
                            </div>

                            <!-- Footer của Modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Để sau</button>
                                <button class="btn btn-primary-color" type="submit" id="btnCreatePayment">
                                    Nâng cấp ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-calendar-check"></i>
                    Giao dịch định kỳ
                </a>
                 <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-university"></i>
                    Liên kết ngân hàng
                </a> 
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-bell"></i>
                    Sự kiện
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-file-invoice"></i>
                    Hóa đơn
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-hand-holding-usd"></i>
                    Sổ nợ
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-tools"></i>
                    Công cụ
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-plane"></i>
                    Chế độ du lịch
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-store"></i>
                    Cửa hàng
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-cog"></i>
                    Cài đặt
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-headset"></i>
                    Hỗ trợ
                </a>
                <a class="list-group-item text-dark text-lg text-medium" href="#">
                    <i style="width: 25px;" class="mr-1 fas fa-info-circle"></i>
                    Giới thiệu
                </a>
            </ul>
        </nav>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#btnCreatePayment").on("click", function() {
                const $btn = $(this);
                $btn.prop('disabled', true).html('Đang xử lý...');

                $.ajax({
                    url: "{{ route('accounts.createPaymentLink') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#upgradeAccount').modal('hide');
                            window.location.href = response.checkoutUrl;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Có lỗi xảy ra, vui lòng thử lại sau');
                    },
                    complete: function() {
                        $btn.prop('disabled', false).html('Nâng cấp ngay');
                    }
                });
            });
        });
    </script>
@endpush
