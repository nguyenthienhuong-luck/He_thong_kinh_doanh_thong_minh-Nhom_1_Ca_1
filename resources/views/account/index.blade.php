@extends('layouts.master')

@section('title', 'Quản lý tài khoản')

@section('content')
    <div class="container-fluid">
        <x-header-tab text="Quản lý tài khoản" />

        <div class="d-flex align-items-center justify-content-center flex-column mb-4">
            <img src="{{ Auth::user()->gender == 0 ? asset('images/default-avatar-male.svg') : asset('images/default-avatar-female.svg') }}"
                class="img-circle object-fit-cover" style="width: 150px !important;" alt="User Image">
            <h4 class="h2 mb-1 text-dark">{{ Auth::user()->name }}</h4>
            <h5 class="h3 mb-0 text-muted">{{ Auth::user()->email }}</h5>
        </div>

        <ul class="list-group flex-column gap-3">
            <a href="{{ route('accounts.edit') }}"
                class="list-group-item fw-bold text-primary-color text-lg text-medium text-center border-primary-color"
                style="border: 1px solid">
                Cập nhật thông tin
            </a>
            <a href="#"
                class="list-group-item fw-bold text-primary-color text-lg text-medium text-center border-primary-color"
                style="border: 1px solid">
                Thay đổi mật khẩu
            </a>

            <div class="my-4"></div>

            <a href="#"
                class="list-group-item fw-bold text-danger text-lg text-medium text-center border-primary-color"
                style="border: 1px solid" data-bs-toggle="modal" data-bs-target="#logOutConfirm">
                Đăng xuất
            </a>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="logOutConfirm" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary-color fw-bold">Xác nhận đăng xuất tài khoản</h5>
                            <button type="button" class="btn-close" data-bs-target="#showTransaction"
                                data-bs-toggle="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer d-flex justify-content-center gap-3">
                            <a href="{{ route('logout') }}" class="btn btn-lg btn-primary-color text-white">
                                Xác nhận
                            </a>
                            <button type="button" class="btn btn-lg btn-outline-secondary"
                                data-bs-toggle="modal">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /. delete confirmation modal --}}

            <a href="#"
                class="list-group-item fw-bold text-danger text-lg text-medium text-center border-primary-color"
                style="border: 1px solid">
                Xóa tài khoản
            </a>
        </ul>
    </div>
@endsection
