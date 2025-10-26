@extends('layouts.master')

@section('title', 'Thống kê người dùng')

@section('content')
    <h3 class="mb-3">Thống kê biểu đồ</h3>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-4 text-center">
                <iframe seamless scrolling="no"
                    src="https://flamingo-fresh-verbally.ngrok-free.app/explore/?slice_id=211&form_data=%7B%22slice_id%22%3A%20211%7D&standalone=true"
                    class="w-100" height="400" frameborder="0"></iframe>
                <h6>Người dùng có chi tiêu nhiều nhất</h6>
            </div>
            <div class="col-md-6 mb-4 text-center">
                <iframe seamless scrolling="no"
                    src="https://flamingo-fresh-verbally.ngrok-free.app/explore/?slice_id=212&form_data=%7B%22slice_id%22%3A%20212%7D&standalone=true"
                    class="w-100" height="400" frameborder="0"></iframe>
                <h6>Số lượng người dùng đăng ký mới theo thời gian</h6>
            </div>
            <div class="col-md-6 mb-4 text-center">
                <iframe seamless scrolling="no"
                    src="https://flamingo-fresh-verbally.ngrok-free.app/explore/?slice_id=214&form_data=%7B%22slice_id%22%3A%20214%7D&standalone=true"
                    class="w-100" height="400" frameborder="0"></iframe>
                <h6>Biểu đồ hiển thị top người dùng có số dư dương lớn nhất.</h6>
            </div>
            <div class="col-md-6 mb-4 text-center">
                <iframe seamless scrolling="no"
                    src="https://flamingo-fresh-verbally.ngrok-free.app/explore/?slice_id=216&form_data=%7B%22slice_id%22%3A%20216%7D&standalone=true"
                    class="w-100" height="400" frameborder="0"></iframe>
                <h6>Danh sách các giao dịch vượt ngưỡng quy định</h6>
            </div>
        </div>
    </div>
@endsection


<!-- https://flamingo-fresh-verbally.ngrok-free.app//explore/?slice_id=212&form_data=%7B%22slice_id%22%3A%20212%7D&&standalone=true -->
