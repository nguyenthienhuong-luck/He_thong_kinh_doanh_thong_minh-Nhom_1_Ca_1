<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Đăng nhập tài khoản</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Notyf -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #6c63ff;
        }

        body {
            background-color: #f9f9f9;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Logo */
        .logo-container {
            position: fixed;
            top: 10px;
            left: 10px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            z-index: 1000;
        }

        .logo-container img {
            width: 60px;
            height: 60px;
        }

        .logo-container span {
            font-size: 1.2rem;
        }

        /* Login Container */
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border: 1px solid var(--primary-color);
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-header h2 {
            color: var(--primary-color);
            font-weight: bold;
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #5a55e0;
        }

        .form-text {
            color: var(--primary-color);
            text-align: center;
        }

        .form-text a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }

        .form-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: none;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Logo -->
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h5>Money Mate</h5>
    </div>

    <!-- Login Form -->
    <div class="login-container">
        <div class="login-header">
            <h2>Đăng Nhập</h2>
        </div>
        <form novalidate id="frm-login" method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email"
                    value="{{ old('email') }}">
            </div>

            <!-- Mật khẩu -->
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check mb-0">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                    </div>
                    <a href="#" class="d-blocktext-end" style="color: #6c63ff;">Quên mật khẩu</a>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">ĐĂNG NHẬP</button>
            </div>
            <p class="form-text mt-3">
                Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a>
            </p>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/toast.js') }}"></script>
    <script>
        $(document).ready(function() {
            let message = localStorage.getItem('message');
            let type = localStorage.getItem('type');

            if (!message || !type) {
                message = '{{ session('message') }}';
                type = '{{ session('type') }}';
            }

            if (message && type) {
                showToast(message, type);
                localStorage.removeItem('message');
                localStorage.removeItem('type');
            }

            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/;

            $('#email').on('input', function() {
                hideError($(this));
            });

            $('#password').on('input', function() {
                hideError($(this));
            });

            $(document).on('keypress', function(e) {
                if (e.which == 13) { // Enter key
                    $('#frm-login').submit();
                }
            });

            $('#frm-login').on('submit', function(e) {
                const isEmailValid = validateEmail($('#email'));
                const isPasswordValid = validatePassword($('#password'));

                if (!isEmailValid || !isPasswordValid) {
                    e.preventDefault();
                }
            });

            function validateEmail(input) {
                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                const email = $('#email').val();

                if (!email) {
                    showError(input, 'Vui lòng nhập email');
                    return false;
                }

                if (!emailPattern.test(email)) {
                    showError(input, 'Email không hợp lệ. Vui lòng nhập đúng định dạng email');
                    return false;
                }

                hideError(input);
                return true;
            }

            function validatePassword(input) {
                const password = $('#password').val();

                if (!password) {
                    showError(input, 'Vui lòng nhập mật khẩu');
                    return false;
                }

                if (!passwordPattern.test(password)) {
                    showError(input, 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm cả chữ cái và số');
                    return false;
                }

                hideError(input);
                return true;
            }

            function showError(input, message) {
                let errorDiv = input.next('.error-message');
                if (errorDiv.length === 0) {
                    errorDiv = $('<div class="error-message"></div>').insertAfter(input);
                }
                input.addClass('is-invalid');
                errorDiv.text(message).show();
            }

            function hideError(input) {
                input.removeClass('is-invalid');
                input.next('.error-message').hide();
            }
        });
    </script>
</body>

</html>
