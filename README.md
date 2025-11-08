# SmartBudget

## Giới thiệu
SmartBudget là một ứng dụng quản lý tài chính cá nhân được thiết kế để giúp bạn theo dõi, kiểm soát và tối ưu hóa việc quản lý chi tiêu. Với giao diện thân thiện và các tính năng thông minh, SmartBudget trở thành trợ thủ đắc lực trong việc quản lý tài chính hàng ngày của bạn.

## Tính năng chính
- **Quản lý tài khoản và ví tiền**: Hỗ trợ nhiều loại ví và tài khoản khác nhau.
- **Ghi chép giao dịch**: Dễ dàng ghi lại thu nhập và chi tiêu hàng ngày.
- **Phân loại giao dịch**: Tự động hoặc thủ công gán danh mục cho các giao dịch.
- **Báo cáo và thống kê**: Hiển thị báo cáo chi tiết về thu chi, tiết kiệm và nợ theo ngày, tuần, tháng.
- **Hỗ trợ sinh viên**: Giảm giá 20% cho tài khoản nâng cấp khi xác minh là sinh viên.
- **Tích hợp chatbot**: Chatbot hỗ trợ tư vấn tài chính và gợi ý tiết kiệm.
- **Tìm kiếm giao dịch**: Tìm kiếm thông minh theo thời gian, danh mục hoặc từ khóa.
- **Bảo mật**: Đăng nhập an toàn và bảo vệ thông tin người dùng.

## Công nghệ sử dụng
- **Frontend**: HTML, CSS, AdminLTE, Bootstrap, JQuery.
- **Backend**: Laravel Framework.
- **Cơ sở dữ liệu**: MySQL.
- **Tích hợp thanh toán**: PayOS.

## Hướng dẫn cài đặt

### Yêu cầu hệ thống
- PHP >= 8.0
- Composer
- MySQL >= 5.7
- Node.js & npm

### Các bước cài đặt
1. Clone dự án về máy:
   ```bash
   git clone 
   cd moneylove
   ```
2. Cài đặt các package thông qua Composer:
   ```bash
   composer install
   ```
3. Cài đặt các package frontend:
   ```bash
   npm install && npm run dev
   ```
4. Cấu hình file `.env`:
   - Sao chép file `.env.example` thành `.env`.
   - Cập nhật thông tin kết nối cơ sở dữ liệu.
5. Tạo database và chạy migration:
   ```bash
   php artisan migrate --seed
   ```
6. Khởi động ứng dụng:
   ```bash
   php artisan serve
   ```
7. Truy cập ứng dụng tại: [http://localhost:8000](http://localhost:8000)

## Hướng dẫn sử dụng
1. Đăng ký tài khoản.
2. Xác minh tài khoản sinh viên (nếu có).
3. Thêm ví và giao dịch của bạn.
4. Sử dụng các biểu đồ thống kê để theo dõi tài chính.
5. Tích hợp chatbot để được gợi ý hoặc hỗ trợ.
