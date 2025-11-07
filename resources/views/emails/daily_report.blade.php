@component('mail::message')
# Báo cáo thu/chi ngày {{ $report['date'] }}

Xin chào **{{ $user->name ?? 'bạn' }}**,

Dưới đây là tóm tắt **số lượng giao dịch** của bạn hôm nay:

---

**Số giao dịch thu:** {{ $report['income_count'] ?? 0 }}  
**Số giao dịch chi:** {{ $report['expense_count'] ?? 0 }}  
**Tổng số giao dịch:** {{ $report['total_count'] ?? 0 }}

---

### Chi tiết theo danh mục:
@foreach ($report['byCategory'] ?? [] as $name => $item)
- **{{ $name }}:** ({{ $item['count'] }} giao dịch)
@endforeach

---

Cảm ơn bạn đã sử dụng **SmartBudget**  
Hẹn gặp lại vào ngày mai với những con số tích cực hơn nhé!

@component('mail::button', ['url' => url('/dashboard')])
Xem trên Dashboard
@endcomponent

Trân trọng,  
**Đội ngũ SmartBudget**
@endcomponent
