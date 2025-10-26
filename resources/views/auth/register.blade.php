<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Đăng ký tài khoản</title>

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
            font-family: "Inter", "Roboto", serif !important;
            font-optical-sizing: auto;
            font-style: normal;
        }

        /* Logo */
        .logo-container {
            position: fixed;
            top: 10px;
            left: 10px;
            gap: 10px;
            z-index: 1000;

            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        .logo-container img {
            width: 60px;
            height: 60px;
        }

        .logo-container span {
            font-size: 1.2rem;
        }

        /* Registration Container */
        .registration-container {
            max-width: 800px;
            margin: 80px auto 50px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border: 1px solid var(--primary-color);
        }

        .registration-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .registration-header h2 {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.8rem;
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
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #5a55e0;
        }

        .form-text {
            color: var(--primary-color);
            text-align: center;
            font-weight: 500;
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

    <!-- Registration Form -->
    <div class="registration-container">
        <div class="registration-header">
            <h2>Đăng Ký Tài Khoản</h2>
        </div>
        <div>
            <!-- Họ và tên -->
            <div class="mb-3">
                <label for="name" class="form-label">Họ và tên<span class="text-danger ms-2">(*)</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên"
                    required>
            </div>

            <!-- Email cá nhân -->
            <div class="mb-3">
                <label for="email" class="form-label">Email<span class="text-danger ms-2">(*)</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                    required>
            </div>
            <!-- Giới tính -->
            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính<span class="text-danger ms-2">(*)</span></label>
                <select class="form-select" id="gender" name="gender" required>
                    <option disabled selected>Chọn giới tính</option>
                    <option value="0">Nam</option>
                    <option value="1">Nữ</option>
                </select>
            </div>
            <!-- Ngày tháng năm sinh -->
            <div class="mb-3">
                <label for="birthday" class="form-label">Ngày sinh<span class="text-danger ms-2">(*)</span></label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>


            <!-- Mật khẩu -->
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu<span class="text-danger ms-2">(*)</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu"
                    required>
            </div>
            <!-- Nhập lại mật khẩu -->
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Nhập lại mật khẩu
                    <span class="text-danger ms-2">(*)</span></label>
                <input type="password" class="form-control" id="confirm-password" name="password_confirmation"
                    placeholder="Nhập lại mật khẩu" required>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
                <button class="btn btn-primary" id="btnSubmit">Đăng ký</button>
            </div>
            <p class="form-text mt-3">
                Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
            </p>
        </div>
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

            const namePattern = /^[\p{L}\s]{2,50}$/u;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/;

            function showError(input, message) {
                const errorDiv = input.next('.error-message');
                if (errorDiv.length === 0) {
                    $('<div class="error-message"></div>').insertAfter(input);
                }
                input.addClass('is-invalid');
                input.next('.error-message').text(message).show();
            }

            function hideError(input) {
                input.removeClass('is-invalid');
                input.next('.error-message').hide();
            }

            function validateInput(input, validationFn) {
                if (input.data('touched')) {
                    validationFn(input);
                }
            }

            function validateName(input) {
                const name = input.val();
                if (!name) {
                    showError(input, 'Họ và tên không được để trống');
                } else if (!namePattern.test(name)) {
                    showError(input, 'Họ và tên chỉ được chứa chữ cái và khoảng trắng, độ dài 2-50 ký tự');
                } else {
                    hideError(input);
                }
            }

            function validateBirthday(input) {
                const birthdayValue = input.val();
                const birthday = birthdayValue ? new Date(birthdayValue) : null;
                const today = new Date();
                const minAge = new Date();
                const maxDate = new Date('2100-12-31');
                const minDate = new Date('1900-01-01');

                minAge.setFullYear(today.getFullYear() - 18);

                if (!birthdayValue || birthdayValue === "mm/dd/yyyy") {
                    showError(input, 'Ngày sinh không được để trống hoặc là giá trị mặc định');
                } else if (isNaN(birthday.getTime())) {
                    showError(input, 'Ngày sinh không hợp lệ');
                } else if (birthday > maxDate || birthday < minDate) {
                    showError(input, 'Ngày sinh phải nằm trong khoảng 1900-2100');
                } else if (birthday > today) {
                    showError(input, 'Ngày sinh không thể là ngày trong tương lai');
                } else if (birthday > minAge) {
                    showError(input, 'Bạn phải đủ 18 tuổi');
                } else {
                    hideError(input);
                }
            }

            function validateEmail(input) {
                const email = input.val();
                if (!email) {
                    showError(input, 'Email không được để trống');
                } else if (!emailPattern.test(email)) {
                    showError(input, 'Email không hợp lệ');
                } else {
                    hideError(input);
                }
            }

            function validatePassword(input) {
                const password = input.val();
                if (!password) {
                    showError(input, 'Mật khẩu không được để trống');
                } else if (!passwordPattern.test(password)) {
                    showError(input, 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ và số');
                } else {
                    hideError(input);
                }
            }

            function validateConfirmPassword(input) {
                const confirmPassword = input.val();
                const password = $('#password').val();
                if (!confirmPassword) {
                    showError(input, 'Vui lòng xác nhận mật khẩu');
                } else if (confirmPassword !== password) {
                    showError(input, 'Mật khẩu xác nhận không khớp');
                } else {
                    hideError(input);
                }
            }

            // Mark fields as touched on blur
            $('input').on('blur', function() {
                $(this).data('touched', true);
            });

            // Validate on input only if field has been touched
            $('#name').on('input', function() {
                validateInput($(this), validateName);
            });

            $('#birthday').on('change', function() {
                validateInput($(this), validateBirthday);
            });

            $('#email').on('input', function() {
                validateInput($(this), validateEmail);
            });

            $('#password').on('input', function() {
                validateInput($(this), validatePassword);
            });

            $('#confirm-password').on('input', function() {
                validateInput($(this), validateConfirmPassword);
            });
            $('#btnSubmit').on('click', function(e) {
                e.preventDefault();
                const inputs = ['name', 'birthday', 'gender', 'email', 'password', 'confirm-password'];
                let isValid = true;
                let formData = {};

                inputs.forEach(id => {
                    const input = $(`#${id}`);
                    input.data('touched', true);
                    input.trigger('input');
                    if (input.hasClass('is-invalid')) {
                        isValid = false;
                    }
                    formData[id] = input.val();
                });

                if (isValid) {
                    $("#cover-spin").show();
                    $.ajax({
                        url: '/register',
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                setTimeout(() => {
                                    window.location.href = response.url;
                                }, 500);
                            } else {
                                showToast(response.message, response.status);
                            }
                        },
                        error: function(xhr) {
                            alert("Có lỗi xảy ra, xin vui lòng thử lại!");
                            console.log(xhr.responseText);
                        },
                        complete: function() {
                            $("#cover-spin").hide();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
