<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng ký tài khoản</title>

    <!-- Bootstrap + Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6c63ff;
            --gradient: linear-gradient(135deg, #6c63ff, #9a8cff, #c8b8ff);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9ff;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-wrapper {
            width: 100%;
            max-width: 950px;
            display: flex;
            border-radius: 25px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        /* ==== Left Side (Form) ==== */
        .register-left {
            flex: 1;
            padding: 50px 60px;
        }

        .register-left h2 {
            font-weight: 700;
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .register-left p {
            color: #666;
            margin-bottom: 30px;
        }

        label {
            font-weight: 500;
            color: #444;
        }

        .form-control, .form-select {
            border-radius: 14px;
            border: 1px solid #ddd;
            padding: 10px 12px;
            transition: 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(108,99,255,0.15);
        }

        .btn-register {
            background: var(--gradient);
            border: none;
            color: white;
            width: 100%;
            padding: 12px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(108,99,255,0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* ==== Right Side (Image) ==== */
        .register-right {
            flex: 1;
            background: var(--gradient);
            color: #fff;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 50px;
        }

        .register-right img {
            width: 260px;
            margin-bottom: 25px;
            filter: drop-shadow(0 8px 20px rgba(0,0,0,0.2));
        }

        .register-right h3 {
            font-weight: 600;
            font-size: 1.6rem;
            line-height: 1.4;
        }

        .register-right p {
            color: rgba(255,255,255,0.85);
            font-size: 0.95rem;
            margin-top: 10px;
        }

        /* ==== Responsive ==== */
        @media (max-width: 820px) {
            .register-wrapper {
                flex-direction: column-reverse;
                max-width: 500px;
            }
            .register-right {
                padding: 30px;
            }
            .register-left {
                padding: 35px 25px;
            }
            .register-right img { width: 180px; }
        }
    </style>
</head>

<body>
    <div class="register-wrapper">
        <!-- Left -->
        <div class="register-left">
            <h2>Tạo tài khoản</h2>
            <p>Bắt đầu hành trình quản lý tài chính thông minh cùng <strong>SmartBudget</strong></p>

            <form id="registerForm">
                <div class="mb-3">
                    <label>Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" placeholder="Nhập họ và tên">
                </div>

                <div class="mb-3">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" class="form-control" placeholder="Nhập email">
                </div>

                <div class="mb-3">
                    <label>Giới tính <span class="text-danger">*</span></label>
                    <select id="gender" class="form-select">
                        <option disabled selected>Chọn giới tính</option>
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Ngày sinh <span class="text-danger">*</span></label>
                    <input type="date" id="birthday" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" id="password" class="form-control" placeholder="Tạo mật khẩu">
                </div>

                <div class="mb-3">
                    <label>Xác nhận mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" id="confirm-password" class="form-control" placeholder="Nhập lại mật khẩu">
                </div>

                <button type="submit" class="btn-register">
                    <i class="fa-solid fa-user-plus me-2"></i> Đăng ký ngay
                </button>

                <div class="login-link">
                    Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
                </div>
            </form>
        </div>

        <!-- Right -->
        <div class="register-right">
            <img src="{{ asset('images/pigmoney.png') }}" alt="Money Love Logo">
            <h3>Quản lý chi tiêu –  
                <br>Tiết kiệm hiệu quả –  
                <br>Yêu tài chính của bạn
            </h3>
            <p>Ứng dụng giúp bạn hiểu rõ hơn về cách mình tiêu tiền,  
               hướng đến cuộc sống cân bằng và hạnh phúc hơn.</p>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(function(){
            $('#registerForm').on('submit', function(e){
                e.preventDefault();
                const data = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    gender: $('#gender').val(),
                    birthday: $('#birthday').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#confirm-password').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                $.post('/register', data)
                .done(res => {
                    if(res.status === 'success'){
                        alert('Đăng ký thành công!');
                        window.location.href = res.url || '/';
                    } else {
                        alert(res.message);
                    }
                })
                .fail(() => alert('Có lỗi xảy ra, vui lòng thử lại.'));
            });
        });
    </script>
</body>
</html>
