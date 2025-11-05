<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SmartBudget – Đăng nhập</title>

  <!-- Bootstrap + Fontawesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #6c63ff;
      --gradient: linear-gradient(135deg, #6c63ff, #8e7dff, #b4a7ff);
    }

    * { box-sizing: border-box; }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f9f9ff 0%, #ffffff 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
    }

    .login-wrapper {
      display: flex;
      width: 100%;
      max-width: 900px;
      background: #fff;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: 0 10px 35px rgba(0,0,0,0.1);
    }

    /* ==== Left Panel ==== */
    .login-left {
      flex: 1;
      padding: 50px 60px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-left h2 {
      color: var(--primary);
      font-weight: 700;
      margin-bottom: 8px;
    }

    .login-left p {
      color: #777;
      margin-bottom: 25px;
      font-size: 0.95rem;
    }

    .form-label {
      font-weight: 500;
      margin-bottom: 5px;
      color: #333;
    }

    .form-control {
      border-radius: 14px;
      padding: 10px 12px;
      border: 1px solid #ddd;
      transition: 0.2s;
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(108,99,255,0.15);
    }

    .btn-login {
      background: var(--gradient);
      color: #fff;
      border: none;
      width: 100%;
      padding: 12px;
      font-weight: 600;
      border-radius: 14px;
      font-size: 1rem;
      transition: 0.3s;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(108,99,255,0.3);
    }

    .forgot-link {
      color: var(--primary);
      font-weight: 500;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .forgot-link:hover { text-decoration: underline; }

    .login-text {
      text-align: center;
      margin-top: 20px;
      color: #666;
      font-size: 0.95rem;
    }

    .login-text a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    .login-text a:hover { text-decoration: underline; }

    /* ==== Right Panel ==== */
    .login-right {
      flex: 1;
      background: var(--gradient);
      color: #fff;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 50px 30px;
    }

    .login-right img {
      width: 200px;
      margin-bottom: 25px;
      filter: drop-shadow(0 8px 20px rgba(0,0,0,0.2));
    }

    .login-right h3 {
      font-weight: 600;
      font-size: 1.6rem;
      margin-bottom: 10px;
    }

    .login-right p {
      font-size: 0.95rem;
      color: rgba(255,255,255,0.9);
    }

    /* ==== Responsive ==== */
    @media (max-width: 820px) {
      .login-wrapper { flex-direction: column-reverse; max-width: 480px; }
      .login-left { padding: 35px 25px; }
      .login-right img { width: 150px; }
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <!-- Left -->
    <div class="login-left">
      <h2>Đăng nhập SmartBudget</h2>
      <p>Chào mừng bạn quay lại</p>

      <form id="frm-login" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Mật khẩu</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
          </div>
          <a href="#" class="forgot-link">Quên mật khẩu?</a>
        </div>

        <button type="submit" class="btn-login">
          <i class="fa-solid fa-right-to-bracket me-2"></i> Đăng nhập
        </button>

        <p class="login-text">
          Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
        </p>
      </form>
    </div>

    <!-- Right -->
    <div class="login-right">
      <img src="{{ asset('images/pigmoney.png') }}" alt="SmartBudget Logo">
      <h3>SmartBudget</h3>
      <p>Giúp bạn kiểm soát chi tiêu, tiết kiệm hiệu quả và đầu tư thông minh hơn mỗi ngày.</p>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(function(){
      $('#frm-login').on('submit', function(e){
        const email = $('#email').val();
        const pass = $('#password').val();
        if(!email || !pass){
          e.preventDefault();
          alert('Vui lòng nhập đầy đủ Email và Mật khẩu.');
        }
      });
    });
  </script>
</body>
</html>
