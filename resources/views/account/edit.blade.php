@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin người dùng')

@section('content')
<style>
:root {
    --primary: #6C63FF;
    --secondary: #9A8BFF;
    --gradient: linear-gradient(135deg, #6C63FF, #9A8BFF);
    --light-bg: #F8F9FF;
}

body {
    background: var(--light-bg);
    font-family: 'Poppins', sans-serif;
}

/* Khung tổng thể */
.profile-container {
    max-width: 950px;
    margin: 60px auto;
    background: #fff;
    border-radius: 22px;
    box-shadow: 0 10px 25px rgba(108, 99, 255, 0.1);
    overflow: hidden;
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Cột avatar bên trái */
.profile-left {
    background: var(--gradient);
    color: white;
    text-align: center;
    padding: 40px 20px;
}

.profile-left img {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    margin-bottom: 15px;
}

.profile-left h4 {
    font-weight: 700;
    margin-bottom: 5px;
}

.profile-left p {
    font-size: 0.95rem;
    opacity: 0.9;
}

/* Form bên phải */
.profile-right {
    padding: 40px 50px;
}

.profile-right h4 {
    font-weight: 700;
    color: #333;
    border-left: 5px solid var(--primary);
    padding-left: 10px;
    margin-bottom: 30px;
}

/* Input style */
.form-control, .form-select {
    border-radius: 12px !important;
    border: 1px solid #ccc;
    transition: 0.25s;
    padding: 10px 14px !important;
    font-size: 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.25rem rgba(108,99,255,0.15);
}

label.form-label {
    font-weight: 600;
    color: #444;
}

/* Nút cập nhật */
.btn-update {
    background: var(--gradient);
    color: white;
    border: none;
    padding: 12px 40px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: 0.3s ease;
}

.btn-update:hover {
    box-shadow: 0 6px 15px rgba(108,99,255,0.3);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 992px) {
    .profile-container {
        margin: 30px 15px;
    }

    .profile-right {
        padding: 30px 20px;
    }
}
</style>

<div class="profile-container">
    <div class="row g-0">
        <!-- Cột trái: Avatar -->
        <div class="col-md-4 profile-left d-flex flex-column justify-content-center align-items-center">
            <img src="{{ Auth::user()->gender == 0 
                ? asset('images/default-avatar-male.jpg') 
                : asset('images/default-avatar-female.jpg') }}" alt="User Image">

            <h4>{{ Auth::user()->name }}</h4>
            <p>{{ Auth::user()->email }}</p>
        </div>

        <!-- Cột phải: Form -->
        <div class="col-md-8 profile-right">
            <h4>Thông tin người dùng</h4>
            <form method="POST" action="{{ route('accounts.update', Auth::user()->user_id) }}" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" name="name" id="name" class="form-control shadow-sm" value="{{ $user->name }}" disabled>
                        <input type="hidden" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="col-md-6">
                        <label for="birthday" class="form-label">Ngày sinh</label>
                        <input type="date" name="birthday" id="birthday" class="form-control shadow-sm" value="{{ \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="gender" class="form-label">Giới tính</label>
                        <select class="form-select shadow-sm" id="gender" name="gender" required>
                            <option disabled>Chọn giới tính</option>
                            <option {{ $user->gender == 1 ? 'selected' : '' }} value="1">Nữ</option>
                            <option {{ $user->gender == 0 ? 'selected' : '' }} value="0">Nam</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="identify_card" class="form-label">Căn cước công dân</label>
                        <input type="text" name="identify_card" id="identify_card" class="form-control shadow-sm" value="{{ $user->identify_card ?? '' }}" {{ $user->identify_card ? 'disabled' : '' }}>
                    </div>

                    <div class="col-md-6">
                        @if($user->isStudent)
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" checked disabled>
                                <label class="form-check-label fw-semibold">Đã xác nhận sinh viên</label>
                            </div>
                        @else
                            <label for="isStudent" class="form-label">Xác nhận sinh viên (Chọn thẻ sinh viên)</label>
                            <input type="file" name="isStudent" id="isStudent" class="form-control shadow-sm">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control shadow-sm" disabled value="{{ $user->email }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn-update">Cập nhật thông tin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
