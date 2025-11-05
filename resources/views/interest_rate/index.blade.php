@include('layouts.sidebar')
@extends('layouts.master')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính Lãi Suất</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .calculator-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
        }

        .input-group-text {
            background: #f8f9fa;
        }

        .result-card {
            display: none;
            margin-top: 20px;
            padding: 20px;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            padding: 15px;
        }

        .period-select {
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .period-select:hover {
            background: #e9ecef;
        }

        .period-select.active {
            background: #007bff;
            color: white;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="nav-buttons">
                <button class="btn btn-outline-secondary" onclick="history.back()">Hủy</button>
                <h4 class="mb-0">Lãi Suất</h4>
                <button class="btn btn-primary" onclick="calculateInterest()">Tính</button>
            </div>

            <div class="calculator-container">
                <form id="interestForm">
                    <div class="form-group">
                        <label>Số tiền</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="amount" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text">VND</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Lãi suất</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="rate" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Khoảng thời gian</label>
                        <input type="number" class="form-control" id="period" placeholder="Nhập thời gian">
                    </div>

                    <div class="form-group">
                        <label>Loại lãi</label>
                        <select class="form-control" id="interestType">
                            <option value="simple">Lãi đơn</option>
                            <option value="compound">Lãi kép</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Loại thời gian</label>
                        <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                            <label class="btn btn-outline-primary active flex-fill">
                                <input type="radio" name="periodType" value="day" checked> Ngày
                            </label>
                            <label class="btn btn-outline-primary flex-fill">
                                <input type="radio" name="periodType" value="month"> Tháng
                            </label>
                            <label class="btn btn-outline-primary flex-fill">
                                <input type="radio" name="periodType" value="year"> Năm
                            </label>
                        </div>
                    </div>
                </form>

                <div class="result-card card" id="resultCard">
                    <div class="card-body">
                        <h5 class="card-title">Kết quả tính toán</h5>
                        <div class="row">
                            <div class="col-6">
                                <p>Tiền gốc:</p>
                                <p>Tiền lãi:</p>
                                <p>Tổng tiền:</p>
                            </div>
                            <div class="col-6 text-right">
                                <p id="principalResult">0 VND</p>
                                <p id="interestResult">0 VND</p>
                                <p id="totalResult">0 VND</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function calculateInterest() {
            const amount = parseFloat($('#amount').val()) || 0;
            const rate = parseFloat($('#rate').val()) || 0;
            const period = parseInt($('#period').val()) || 0;
            const interestType = $('#interestType').val();
            const periodType = $('input[name="periodType"]:checked').val();

            let periodInYears;
            switch (periodType) {
                case 'day':
                    periodInYears = period / 365;
                    break;
                case 'month':
                    periodInYears = period / 12;
                    break;
                default:
                    periodInYears = period;
            }

            let interest = 0;
            if (interestType === 'simple') {
                interest = amount * (rate / 100) * periodInYears;
            } else {
                interest = amount * Math.pow(1 + rate / 100, periodInYears) - amount;
            }

            $('#principalResult').text(formatCurrency(amount));
            $('#interestResult').text(formatCurrency(interest));
            $('#totalResult').text(formatCurrency(amount + interest));
            $('#resultCard').slideDown();
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        }

        $(document).ready(function() {
            $('#interestForm input').on('input', function() {
                $('#resultCard').slideUp();
            });
        });
    </script>
</body>

</html>
