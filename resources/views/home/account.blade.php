@extends('layouts.master')

@section('title', 'Tài khoản')

@section('content')
<style>
:root {
    --primary: #6C63FF;
    --secondary: #9A8BFF;
    --gradient: linear-gradient(135deg, #6C63FF, #9A8BFF);
    --light-bg: #F8F9FF;
}

/* Tổng thể */
body {
    background: var(--light-bg);
    font-family: 'Poppins', sans-serif;
}

/* Container */
.account-wrapper {
    max-width: 900px;
    margin: 50px auto;
    background: #fff;
    border-radius: 22px;
    box-shadow: 0 10px 25px rgba(108,99,255,0.1);
    padding: 40px 30px;
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Avatar + Info */
.user-panel {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-bottom: 35px;
}

.user-panel img {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 4px solid transparent;
    background: linear-gradient(white, white) padding-box,
                var(--gradient) border-box;
    box-shadow: 0 4px 15px rgba(108,99,255,0.2);
}

.user-info h4 {
    font-weight: 700;
    color: #333;
}

.user-info h5 {
    color: #666;
    font-size: 1rem;
}

/* Danh sách tính năng */
.list-feature-account .list-group-item {
    border-radius: 15px !important;
    border: 1.8px solid rgba(108,99,255,0.3);
    background: #fff;
    padding: 14px 20px;
    font-weight: 600;
    transition: 0.25s ease;
    display: flex;
    align-items: center;
    gap: 10px;
}

.list-feature-account .list-group-item i {
    color: var(--primary);
    font-size: 1.2rem;
}

.list-feature-account .list-group-item:hover {
    background: rgba(108,99,255,0.1);
    border-color: var(--primary);
    transform: translateX(4px);
    box-shadow: 0 4px 12px rgba(108,99,255,0.1);
}

/* Modal Nâng Cấp */
.modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 8px 25px rgba(108,99,255,0.2);
}

.modal-header {
    background: var(--gradient);
    color: #fff;
    border-radius: 20px 20px 0 0;
}

.modal-footer .btn {
    border-radius: 10px;
    font-weight: 600;
}

.btn-primary-color {
    background: var(--gradient);
    border: none;
    color: #fff;
}

.btn-primary-color:hover {
    box-shadow: 0 4px 15px rgba(108,99,255,0.3);
}

.btn-secondary:hover {
    background-color: #eee;
}

/* Responsive */
@media (max-width: 768px) {
    .account-wrapper {
        padding: 25px 15px;
    }

    .user-panel {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<div class="account-wrapper">
    <!-- Thông tin người dùng -->
    <div class="user-panel">
        <img src="{{ Auth::user()->gender == 0 ? asset('images/default-avatar-male.jpg') : asset('images/default-avatar-female.jpg') }}" alt="User Image">
        <div class="user-info">
            <h4>{{ Auth::user()->name }}</h4>
            <h5>{{ Auth::user()->email }}</h5>
        </div>
    </div>

    <!-- Danh sách tính năng -->
    <nav class="list-feature-account px-2">
        <ul class="list-group flex-column gap-3">

            <a class="list-group-item" href="{{ route('accounts.index') }}">
                <i class="fas fa-user-cog"></i> Quản lý tài khoản
            </a>

            <a href="#" class="list-group-item" data-bs-toggle="modal" data-bs-target="#walletsModal">
                <i class="fas fa-wallet"></i> Ví của tôi
            </a>
            <x-wallet-modal :user="$user" />

            <a class="list-group-item" href="{{ route('bank-branches.index') }}">
                <i class="fas fa-location-crosshairs"></i> Tìm kiếm ngân hàng
            </a>

            @if(Auth::user()->isPremium != 1)
            <a href="#" class="list-group-item" data-bs-toggle="modal" data-bs-target="#upgradeAccount">
                <i class="fas fa-star"></i> Nâng cấp tài khoản
            </a>
            @endif

            <a class="list-group-item" href="#"><i class="fas fa-calendar-check"></i> Giao dịch định kỳ</a>
            <a class="list-group-item" href="#"><i class="fas fa-university"></i> Liên kết ngân hàng</a>
            <a class="list-group-item" href="#"><i class="fas fa-bell"></i> Sự kiện</a>
            <a class="list-group-item" href="#"><i class="fas fa-file-invoice"></i> Hóa đơn</a>
            <a class="list-group-item" href="#"><i class="fas fa-hand-holding-usd"></i> Sổ nợ</a>
            <a class="list-group-item" href="#"><i class="fas fa-tools"></i> Công cụ</a>
            <a class="list-group-item" href="#"><i class="fas fa-plane"></i> Chế độ du lịch</a>
            <a class="list-group-item" href="#"><i class="fas fa-store"></i> Cửa hàng</a>
            <a class="list-group-item" href="#"><i class="fas fa-cog"></i> Cài đặt</a>
            <a class="list-group-item" href="#"><i class="fas fa-headset"></i> Hỗ trợ</a>
            <a class="list-group-item" href="#"><i class="fas fa-info-circle"></i> Giới thiệu</a>
        </ul>
    </nav>
</div>

<!-- Modal Nâng Cấp -->
@if(Auth::user()->isPremium != 1)
<div class="modal fade" id="upgradeAccount" tabindex="-1" aria-labelledby="upgradeAccountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="upgradeAccountLabel">Nâng cấp tài khoản Premium</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Bạn đang sử dụng tài khoản <strong>thường</strong>. Hãy nâng cấp lên <strong>Premium</strong> để nhận các đặc quyền sau:</p>
                <ul>
                    <li>Chatbot thông minh: giải đáp, gợi ý và thống kê chi tiêu.</li>
                    <li>Tìm kiếm ngân hàng gần nhất.</li>
                    <li>Biểu đồ chi tiết nâng cao.</li>
                </ul>
                <p class="text-warning"><strong>Lưu ý:</strong> Sinh viên được giảm 20% khi xác minh tại <a href="/account-settings" class="text-primary">Quản lý tài khoản</a>.</p>
                <p class="text-danger fw-bold mb-1">Giá: 60,000 VND/tháng</p>
                <p class="text-success fw-bold">Giá sinh viên: 48,000 VND/tháng</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Để sau</button>
                <button class="btn btn-primary-color px-4" type="submit" id="btnCreatePayment">Nâng cấp ngay</button>
            </div>
        </div>
    </div>
</div>
@endif
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
            data: { _token: "{{ csrf_token() }}" },
            success: function(response) {
                if (response.success) {
                    $('#upgradeAccount').modal('hide');
                    window.location.href = response.checkoutUrl;
                }
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại sau.');
            },
            complete: function() {
                $btn.prop('disabled', false).html('Nâng cấp ngay');
            }
        });
    });
});
</script>
@endpush
