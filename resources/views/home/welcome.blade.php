<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartBudget – Quản lý tài chính cá nhân</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Fontawesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f9f9ff 0%, #ffffff 100%);
      color: #222;
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ===== HEADER ===== */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 25px 60px;
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(15px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 10;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 1.4rem;
      font-weight: 700;
      color: #6c63ff;
    }

    .logo img {
      width: 45px;
    }

    .btn-lang {
      background-color: #6c63ff;
      border: none;
      border-radius: 25px;
      color: white;
      font-weight: 600;
      padding: 10px 22px;
      transition: 0.3s;
    }

    .btn-lang:hover {
      background-color: #524af5;
    }

    /* ===== HERO SECTION ===== */
    .hero {
      text-align: center;
      margin-top: 140px;
      padding: 0 20px;
    }

    .hero h1 {
      font-weight: 700;
      font-size: 2.4rem;
      background: linear-gradient(90deg, #6c63ff, #a389ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero p {
      color: #666;
      font-size: 1.1rem;
      max-width: 600px;
      margin: 15px auto 30px;
    }

    /* ===== FEATURES ===== */
    .features {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
      margin-top: 40px;
    }

    .feature-card {
      background: #fff;
      border-radius: 20px;
      padding: 35px 25px;
      width: 280px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .feature-card i {
      font-size: 2.5rem;
      color: #6c63ff;
      margin-bottom: 15px;
    }

    .feature-card h5 {
      font-weight: 600;
      margin-bottom: 10px;
    }

    .feature-card p {
      color: #777;
      font-size: 0.95rem;
    }

    /* ===== CTA BUTTONS ===== */
    .btn-group-custom {
      margin-top: 60px;
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .btn-custom {
      text-decoration: none;
      font-weight: 600;
      padding: 14px 32px;
      border-radius: 14px;
      transition: all 0.3s;
      font-size: 1rem;
    }

    .btn-register {
      background-color: #6c63ff;
      color: #fff;
    }

    .btn-register:hover {
      background-color: #524af5;
    }

    .btn-login {
      background-color: #f1f1f1;
      color: #6c63ff;
    }

    .btn-login:hover {
      background-color: #e2e2e2;
    }

    /* ===== FOOTER ===== */
    footer {
      margin-top: auto;
      text-align: center;
      padding: 40px 20px 25px;
      font-size: 0.9rem;
      color: #888;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      header {
        padding: 20px 25px;
      }

      .hero h1 {
        font-size: 1.8rem;
      }

      .features {
        flex-direction: column;
        align-items: center;
      }

      .feature-card {
        width: 85%;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="logo">
    <img src="{{ asset('images/pigmoney.png') }}" alt="Logo">
    SmartBudget
    </div>

    <button class="btn-lang">TIẾNG VIỆT</button>
  </header>

  <section class="hero">
    <h1>Kiểm soát tài chính dễ dàng và thông minh</h1>
    <p>Bạn xứng đáng có một công cụ quản lý chi tiêu đơn giản, hiệu quả và đầy cảm hứng.  
    SmartBudget giúp bạn theo dõi, tiết kiệm và đạt mục tiêu tài chính.</p>

    <div class="features">
      <div class="feature-card">
        <i class="fa-solid fa-scissors"></i>
        <h5>Cắt giảm chi tiêu</h5>
        <p>Phân tích tự động giúp nhận diện những khoản chi chưa cần thiết.</p>
      </div>
      <div class="feature-card">
        <i class="fa-solid fa-piggy-bank"></i>
        <h5>Tiết kiệm thông minh</h5>
        <p>Tạo kế hoạch tiết kiệm cá nhân hoá theo từng mục tiêu.</p>
      </div>
      <div class="feature-card">
        <i class="fa-solid fa-chart-line"></i>
        <h5>Thống kê trực quan</h5>
        <p>Xem biểu đồ thu chi rõ ràng, dễ hiểu chỉ với một chạm.</p>
      </div>
    </div>

    <div class="btn-group-custom">
      <a href="{{ route('register') }}" class="btn-custom btn-register">Bắt đầu miễn phí</a>
      <a href="{{ route('login') }}" class="btn-custom btn-login">Đăng nhập</a>
    </div>
  </section>

  <footer>
  © 2025 SmartBudget – Quản lý thông minh, sống an toàn 
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
