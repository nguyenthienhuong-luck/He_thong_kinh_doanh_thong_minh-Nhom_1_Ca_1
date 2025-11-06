@component('mail::message')
# Báo cáo thu/chi ngày {{ $report['date'] ?? now()->toDateString() }}

Xin chào **{{ $user->name }}**,  
Dưới đây là tóm tắt tình hình chi tiêu của bạn hôm nay:

---

**Tổng thu:** {{ number_format($report['income'], 0, ',', '.') }} VND  
**Tổng chi:** {{ number_format($report['expense'], 0, ',', '.') }} VND  
**Cân đối:** {{ number_format($report['net'], 0, ',', '.') }} VND  

---

###Chi tiết theo danh mục
@foreach($report['byCategory'] as $category => $info)
- **{{ $category }}**: ({{ $info['count'] }} giao dịch)
@endforeach

---

Cảm ơn bạn đã sử dụng **SmartBudget**
Hẹn gặp lại vào ngày mai với những con số đẹp hơn nhé!

@component('mail::button', ['url' => route('home.dashboard')])
Xem trên Dashboard
@endcomponent

_Trân trọng,_  
**Đội ngũ SmartBudget**
@endcomponent
