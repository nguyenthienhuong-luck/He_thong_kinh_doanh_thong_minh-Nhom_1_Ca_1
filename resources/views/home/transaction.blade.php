@extends('layouts.master')

@section('title', 'SmartBudget - Sổ Giao Dịch')

@section('content')
<style>
    :root {
        --primary: #6C63FF;
        --gradient: linear-gradient(135deg, #6C63FF, #9A8BFF);
        --light-bg: #F8F9FF;
        --card-bg: #fff;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Poppins', sans-serif;
    }

    .page-header {
        background: var(--gradient);
        color: #fff;
        border-radius: 16px;
        padding: 20px 30px;
        box-shadow: 0 6px 20px rgba(108, 99, 255, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h2 {
        font-weight: 700;
        margin: 0;
    }

    .filter-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--card-bg);
        border-radius: 18px;
        padding: 20px 25px;
        box-shadow: 0 4px 12px rgba(108, 99, 255, 0.08);
        margin-bottom: 25px;
    }

    .filter-section select {
        border-radius: 10px;
        border: 1.5px solid var(--primary);
        padding: 8px 14px;
        font-size: 0.95rem;
        color: var(--primary);
        font-weight: 500;
        background-color: #f9f8ff;
    }

    .balance-card {
        border: none;
        border-radius: 18px;
        background: var(--card-bg);
        padding: 30px 35px;
        box-shadow: 0 6px 16px rgba(108, 99, 255, 0.12);
        margin-bottom: 30px;
    }

    .balance-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dashed #d7d3ff;
    }

    .balance-item:last-child {
        border-bottom: none;
    }

    .balance-label {
        font-weight: 600;
        color: #555;
    }

    .balance-value {
        font-weight: 700;
        color: var(--primary);
    }

    .report-link {
        text-align: right;
        margin-top: 10px;
    }

    .report-link a {
        color: var(--primary);
        font-weight: 500;
        text-decoration: none;
    }

    .report-link a:hover {
        text-decoration: underline;
    }

    .btn-floating {
        position: fixed;
        bottom: 40px;
        right: 35px;
        background: var(--gradient);
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        cursor: pointer;
        box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        transition: all 0.25s ease-in-out;
        z-index: 999;
    }

    .btn-floating:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 28px rgba(108, 99, 255, 0.4);
    }
</style>

<div class="container-fluid py-3">

    <!-- Header -->
    <div class="page-header">
        <h2>Ví của tôi</h2>
        <span class="fw-semibold"> {{ Auth::user()->total_balance }}</span>
    </div>

    <!-- Bộ lọc -->
    <div class="filter-section">
        <select class="form-select w-auto">
            <option selected>Tất cả ví</option>
            <option>Tiền mặt</option>
            <option>Ngân hàng</option>
        </select>

        <div class="text-muted d-flex align-items-center gap-3 fw-medium">
            <span>Tháng trước</span>
            <span>|</span>
            <span>Tháng này</span>
        </div>
    </div>

    <!-- Bảng số dư -->
    <div class="balance-card">
        <div class="balance-item">
            <span class="balance-label">Số dư đầu kỳ</span>
            <span class="balance-value">0 VND</span>
        </div>
        <div class="balance-item">
            <span class="balance-label">Số dư cuối kỳ</span>
            <span class="balance-value">0 VND</span>
        </div>
        <div class="balance-item">
            <span class="balance-label">Chênh lệch</span>
            <span class="balance-value">0 VND</span>
        </div>

        <div class="report-link">
            <a href="#">Xem báo cáo cho giai đoạn này</a>
        </div>
    </div>
</div>
   


<div class="card mt-4">
  <div class="card-body">
    <h4 class="fw-bold mb-3">Phân tích chi tiêu</h4>

    <p>Tổng chi tháng này: <b id="expenseThis"></b></p>
    <p>So với tháng trước: <b id="expenseDiff"></b></p>
    <p id="suggestionText" class="text-primary"></p>

    <canvas id="expenseChart" height="150"></canvas>

    <h5 class="mt-4">Danh mục chi tiêu hàng đầu</h5>
    <ul id="topCats"></ul>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  fetch("/analysis")
    .then(r => r.json())
    .then(data => {
      document.getElementById('expenseThis').innerText = new Intl.NumberFormat('vi-VN').format(data.this_month_expense) + ' VND';
      document.getElementById('expenseDiff').innerText = data.pct_change !== null ? data.pct_change + '%' : 'N/A';
      document.getElementById('suggestionText').innerText = data.suggestions.join(' ');

      let html = '';
      data.by_category.forEach(c => {
        html += `<li>${c.category}: ${new Intl.NumberFormat('vi-VN').format(c.total)} VND</li>`;
      });
      document.getElementById('topCats').innerHTML = html;

      new Chart(document.getElementById('expenseChart'), {
        type: 'bar',
        data: {
          labels: data.months,
          datasets: [
            { label: 'Khoản chi', data: data.expenses },
            { label: 'Khoản thu', data: data.incomes }
          ]
        },
        options: {
          responsive: true,
          scales: { y: { beginAtZero: true } },
          plugins: { legend: { position: 'bottom' } }
        }
      });
    });
});
</script>



@endsection
