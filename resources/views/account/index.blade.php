@extends('layouts.master')

@section('title', 'Quản lý tài khoản')

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

.account-container {
    max-width: 700px;
    margin: 60px auto;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(108, 99, 255, 0.1);
    padding: 40px 30px;
    text-align: center;
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Avatar */
.account-avatar {
    position: relative;
    width: 140px;
    height: 140px;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: linear-gradient(white, white) padding-box,
                var(--gradient) border-box;
    border: 4px solid transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(108, 99, 255, 0.25);
}

.account-avatar img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
}

/* Tên và email */
.account-info h4 {
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
}

.account-info h5 {
    color: #777;
    font-size: 1rem;
    margin-bottom: 30px;
}

/* Nút chức năng */
.account-btn {
    display: block;
    width: 100%;
    padding: 14px 0;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.05rem;
    text-decoration: none;
    transition: 0.3s ease;
    margin-bottom: 15px;
}

.account-btn-primary {
    background: var(--gradient);
    color: white;
    box-shadow: 0 3px 10px rgba(108, 99, 255, 0.2);
}

.account-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
}

.account-btn-outline {
    background: white;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.account-btn-outline:hover {
    background: var(--gradient);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(108,99,255,0.3);
}

.account-btn-danger {
    background: white;
    color: #dc3545;
    border: 2px solid #dc3545;
}

.account-btn-danger:hover {
    background: #dc3545;
    color: #fff;
    transform: translateY(-2px);
}

/* Modal */
.modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 10px 30px rgba(108,99,255,0.15);
}

.modal-header {
    background: var(--gradient);
    color: white;
    border-radius: 20px 20px 0 0;
}

.modal-title {
    font-weight: 600;
}

.btn-gradient {
    background: var(--gradient);
    color: white;
    border: none;
    font-weight: 600;
    border-radius: 10px;
}

.btn-gradient:hover {
    box-shadow: 0 5px 15px rgba(108,99,255,0.3);
}
</style>

<div class="account-container">
    <!-- Avatar + Thông tin -->
    <div class="account-avatar">
        <img src="{{ Auth::user()->gender == 0 
            ? asset('images/default-avatar-male.jpg') 
            : asset('images/default-avatar-female.jpg') }}" 
            alt="User Image">
    </div>

    <div class="account-info">
        <h4>{{ Auth::user()->name }}</h4>
        <h5>{{ Auth::user()->email }}</h5>
    </div>

    <!-- Các nút chức năng -->
    <a href="{{ route('accounts.edit') }}" class="account-btn account-btn-primary">
        <i class="fa-solid fa-pen-to-square me-2"></i> Cập nhật thông tin
    </a>

    <a href="#" class="account-btn account-btn-outline">
        <i class="fa-solid fa-key me-2"></i> Thay đổi mật khẩu
    </a>

    <hr class="my-4">

    <a href="#" class="account-btn account-btn-danger" data-bs-toggle="modal" data-bs-target="#logOutConfirm">
        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Đăng xuất
    </a>

    <a href="#" class="account-btn account-btn-danger">
        <i class="fa-solid fa-trash-can me-2"></i> Xóa tài khoản
    </a>
</div>

<!-- Modal xác nhận đăng xuất -->
<div class="modal fade" id="logOutConfirm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận đăng xuất</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="fs-5 text-muted mb-0">Bạn có chắc chắn muốn đăng xuất khỏi tài khoản này không?</p>
            </div>
            <div class="modal-footer d-flex justify-content-center gap-3 pb-4">
                <a href="{{ route('logout') }}" class="btn btn-gradient px-4">Xác nhận</a>
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
@endsection
