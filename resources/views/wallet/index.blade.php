<div class="card mt-4">
  <div class="card-body">
    <h4 class="fw-bold mb-3">Phân tích chi tiêu tháng này</h4>

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

      // Top category list
      let html = '';
      data.by_category.forEach(c => {
        html += `<li>${c.category}: ${new Intl.NumberFormat('vi-VN').format(c.total)} VND</li>`;
      });
      document.getElementById('topCats').innerHTML = html;

      // Chart
      new Chart(document.getElementById('expenseChart'), {
        type: 'bar',
        data: {
          labels: data.months,
          datasets: [
            { label: 'Chi tiêu', data: data.expenses },
            { label: 'Thu nhập', data: data.incomes }
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
