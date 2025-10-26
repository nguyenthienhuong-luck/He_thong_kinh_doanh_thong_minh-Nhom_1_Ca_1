@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin người dùng')

@section('content')
    <div class="container-fluid">
        <x-header-tab text="Chỉnh sửa thông tin người dùng" />
        <div class="card">
            <div class="card-body py-0">
                <div class="row">
                    <div
                        class="col-md-3 d-flex align-items-center justify-content-center flex-column border-end border-2 py-3">
                        <img src="{{ Auth::user()->gender == 0 ? asset('images/default-avatar-male.svg') : asset('images/default-avatar-female.svg') }}"
                            class="img-circle object-fit-cover" style="width: 150px !important;" alt="User Image">
                        <h4 class="h2 mb-1 text-dark">{{ Auth::user()->name }}</h4>
                    </div>
                    <div class="col-md-9 py-3 ps-3">
                        <h4 class="h4 mb-3 text-medium">Thông tin người dùng</h4>
                        <form method="POST" action="{{ route('accounts.update', Auth::user()->user_id) }}" enctype='multipart/form-data'>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Họ và tên</label>
                                        <input type="text" name="name" id="name" disabled
                                            class="form-control form-control-lg" value="{{ $user->name }}">
                                        <input type="hidden" name="name" value="{{ $user->name }}">
                                        <span class="text-danger">
                                            @if ($errors->has('name'))
                                                {{ $errors->first('name') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday" class="form-label">Ngày sinh</label>
                                        <input type="date" name="birthday" id="birthday"
                                            class="form-control form-control-lg"
                                            value="{{ \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') }}">
                                        <span class="text-danger">
                                            @if ($errors->has('birthday'))
                                                {{ $errors->first('birthday') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
    <div class="form-group">
        @if($user->isStudent)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" checked disabled>
                <label class="form-check-label">
                    Đã xác nhận sinh viên
                </label>
            </div>
        @else
            <label for="isStudent" class="form-label">Xác nhận sinh viên (Chọn thẻ sinh viên)</label>
            <input type="file" name="isStudent" id="isStudent" class="form-control form-control-lg">
            <span class="text-danger">
                @if ($errors->has('isStudent'))
                    {{ $errors->first('isStudent') }}
                @endif
            </span>
        @endif
    </div>
</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender" class="form-label">Giới tính</label>
                                        <select class="form-select form-select-lg" id="gender" name="gender" required>
                                            <option disabled>Chọn giới tính</option>
                                            <option {{ $user->gender == 1 ? 'selected' : '' }} value="1">Nữ</option>
                                            <option {{ $user->gender == 0 ? 'selected' : '' }} value="0">Nam</option>
                                        </select>
                                        <span class="text-danger">
                                            @if ($errors->has('gender'))
                                                {{ $errors->first('gender') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" id="email"
                                            class="form-control form-control-lg" disabled value="{{ $user->email }}">
                                        <input type="hidden" name="email" value="{{ $user->email }}">
                                        <span class="text-danger">
                                            @if ($errors->has('email'))
                                                {{ $errors->first('email') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="identify_card" class="form-label">Căn cước công dân</label>
                                        <input type="text" name="identify_card" id="identify_card"
                                            class="form-control form-control-lg"
                                            value="{{ $user->identify_card ?? 'Chưa có thông tin' }}"
                                            {{ $user->identify_card ? 'disabled' : '' }}>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <button class="btn btn-primary-color btn-lg" type="submit">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
